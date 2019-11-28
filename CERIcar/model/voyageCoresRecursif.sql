DROP FUNCTION IF EXISTS voyageCoresRecursif(d_depart varchar, a_arrivee varchar);

CREATE OR REPLACE FUNCTION voyageCoresRecursif(d_depart varchar, a_arrivee varchar)
RETURNS TABLE (
    voyage_list varchar(500)
)
AS
$$
	DECLARE
        my_record record;
        voyage_id varchar(500);
	BEGIN
        
        FOR my_record in select *
            FROM jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id
            WHERE jabaianb.trajet.depart=d_depart 
        LOOP
            voyage_list:='';
            voyage_id:='';
            voyage_id:=voyage_id||my_record.id;
            voyage_list:=voyageCoresRecursif(voyage_id,my_record.arrivee,a_arrivee,my_record.distance);
            RETURN NEXT;
        END LOOP;  
	END;
$$
LANGUAGE plpgsql;

DROP FUNCTION IF EXISTS voyageCoresRecursif(voyage_list varchar(500),d_depart varchar, a_arrivee varchar,distance integer);

CREATE OR REPLACE FUNCTION voyageCoresRecursif(voyage_list varchar(500),d_depart varchar, a_arrivee varchar,distance integer)
RETURNS varchar(500)
AS
$$
	DECLARE
		my_record record;
        my_dep record;
        heure float;
        text varchar(500);

	BEGIN
        FOR my_dep in select *
            FROM jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id
            WHERE jabaianb.trajet.depart=d_depart
        LOOP

            if (my_dep.arrivee = a_arrivee) Then
                voyage_list:=voyage_list||',';
                voyage_list:=voyage_list||my_dep.id;
                return voyage_list;
            ELSE
                voyage_list:='';
                return voyage_list;
            END IF;
            -- heure = my_dep.heuredepart+(my_dep.distance/60);

            -- if heure <= my_record.heuredepart Then
            --     voyage_id :='';
            --     voyage_id := voyage_id || my_dep.id;
            --     voyage_id := voyage_id || '|';
            --     voyage_id := voyage_id || my_record.id;

            --     return NEXT;
                    
                
            -- END IF;
        END LOOP;

	END;
$$
LANGUAGE plpgsql;






select voyageCoresRecursif('Paris','Nice');


DROP FUNCTION IF EXISTS testCte();

CREATE OR REPLACE FUNCTION testCte()
RETURNS TABLE
as 
$$
    declare 
        my_record record;
    begin 
        WITH RECURSIVE cte_numbers 
        AS (
           SELECT 
                empno,
                ename, 
                mgr
            from 
                emp 
            where mgr is null   
            UNION ALL
            SELECT    
                c.empno,
                c.ename,
                c.mgr 
            FROM
                emp c
                INNER JOIN cte_numbers o
                    on o.empno = c.mgr
        ) select * from cte_numbers;
    end;
$$
LANGUAGE plpgsql;

select * from testCte();


WITH RECURSIVE cte_voyage 
        AS (  
            select trajet.id,depart,arrivee
            FROM jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id 
            WHERE jabaianb.trajet.depart='Paris'
            UNION ALL
            select 
                c.id,
                c.depart,
                c.arrivee
            FROM jabaianb.trajet c,cte_voyage o
            where c.arrivee = o.depart
                
        ) select * from cte_voyage where arrivee='Nice';






-- La vrai requête
-- Contraintes:
    -- Durée totale du voyage: MAX 24H
-- Ordre de présentation:
    -- Distance les plus courte en premier
    -- Nombre d'escale le plus faible en premier si la distance est la même
WITH RECURSIVE current (arrivee,step,distance_totale,chemin,chemin_id,heure,prix_total,heure_arrive) 
AS
   (SELECT depart,0,0, CAST('Paris' AS VARCHAR) ,CAST('0' AS VARCHAR),0,0,heuredepart
    FROM (jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id) 
    WHERE jabaianb.trajet.depart='Paris'
    UNION  ALL
    SELECT next.arrivee,
           recur.step + 1,
           recur.distance_totale + next.distance,
           recur.chemin || ', ' || next.arrivee,
           recur.chemin_id || ',' || next.id,
           next.heuredepart,
           recur.prix_total +tarif,
           next.heuredepart + (next.distance/60)
           
    FROM (select depart,arrivee,distance,heuredepart,voyage.id,tarif from jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id) AS next
           INNER JOIN current AS recur
                 ON recur.arrivee = next.depart
    WHERE 
        recur.chemin NOT LIKE '%' || next.arrivee || '%'
        AND
        recur.step < 7
        AND
        recur.heure_arrive <= next.heuredepart
        AND
        (recur.distance_totale / 60 ) < 24
    )
SELECT DISTINCT *
FROM   current
WHERE
    chemin LIKE '%Nice'
ORDER BY
    distance_totale ASC,
    step ASC,
    prix_total ASC,
    heure_arrive ASC;

select * FROM jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id order by voyage.id ASC;


recur.chemin_id || ',' || next.voyage.id



-- En cours


DROP FUNCTION IF EXISTS correspondances(from_city VARCHAR, to_city VARCHAR)

CREATE OR REPLACE FUNCTION correspondances(from_city VARCHAR, to_city VARCHAR)
RETURNS TABLE (
    arrivee VARCHAR,
    step INTEGER,
    distance_totale INTEGER,
    chemin VARCHAR,
    chemin_id VARCHAR,
    heure INTEGER,
    prix_total INTEGER,
    heure_arrive INTEGER
)
AS $$
BEGIN
    RETURN QUERY
    WITH RECURSIVE current (arrivee,step,distance_totale,chemin,chemin_id,heure,prix_total,heure_arrive) 
    AS
    (
        SELECT depart,0,0, CAST(from_city AS VARCHAR) ,CAST('0' AS VARCHAR),0,0,heuredepart
        FROM (jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id) 
        WHERE jabaianb.trajet.depart = from_city
        UNION  ALL
        SELECT next.arrivee,
            recur.step + 1,
            recur.distance_totale + next.distance,
            recur.chemin || ', ' || next.arrivee,
            recur.chemin_id || ',' || next.id,
            next.heuredepart,
            recur.prix_total +tarif,
            next.heuredepart + (next.distance/60)
            
        FROM (select depart,trajet.arrivee,distance,heuredepart,voyage.id,tarif from jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id) AS next
            INNER JOIN current AS recur
                    ON recur.arrivee = next.depart
        WHERE 
            recur.chemin NOT LIKE '%' || next.arrivee || '%'
            AND
            recur.step < 7
            AND
            recur.heure_arrive <= next.heuredepart
            AND
            (recur.distance_totale / 60 ) < 24
    )
    SELECT DISTINCT *
    FROM   current
    WHERE
        current.chemin LIKE '%' || to_city
    ORDER BY
        distance_totale ASC,
        step ASC,
        prix_total ASC,
        heure_arrive ASC;
END;
$$ LANGUAGE plpgsql;

select correspondances('Paris','Marseille');



CREATE FUNCTION GetDistributionTable 
(
    @IntID int,
    @TestID int,
    @DateFrom datetime,
    @DateTo datetime
)
RETURNS 
@Table_Var TABLE 
(
    [Count] int, 
    Result float
)
AS
BEGIN
  WITH T 
    AS (    
        select Ticket_Id,COUNT(1) Result from 
        Customer_Survey
        group by MemberID,SiteId,Ticket_Id
   )
  INSERT INTO @Table_Var ([Count], Result)
  SELECT COUNT(*) AS [Count],
       Result
  FROM   T
  GROUP  BY Result
  RETURN 
END
GO







WITH journey (TO_TOWN, STEPS, DISTANCE, WAY) 
AS
   (SELECT DISTINCT JNY_FROM_TOWN, 0, 0, CAST('PARIS' AS VARCHAR(MAX)) 
    FROM   T_JOURNEY
    WHERE  JNY_FROM_TOWN = 'PARIS'
    UNION  ALL
    SELECT JNY_TO_TOWN, departure.STEPS + 1
           , departure.DISTANCE + arrival.JNY_KM
           , departure.WAY + ', ' + arrival.JNY_TO_TOWN
    FROM   T_JOURNEY AS arrival
           INNER JOIN journey AS departure
                 ON departure.TO_TOWN = arrival.JNY_FROM_TOWN)
SELECT *
FROM   journey
WHERE  TO_TOWN = 'TOULOUSE'