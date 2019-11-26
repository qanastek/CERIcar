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


WITH RECURSIVE current (arrivee,step,distance,chemin) 
AS
   (SELECT depart,0,0, CAST('Paris' AS VARCHAR) 
    FROM (jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id) 
    WHERE jabaianb.trajet.depart='Paris'
    UNION  ALL
    SELECT next.arrivee,
           recur.step+1,
           recur.distance + next.distance,
           recur.chemin || ', ' || next.arrivee
    FROM (jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id) AS next
           INNER JOIN current AS recur
                 ON recur.arrivee = next.depart
    WHERE 
        recur.chemin NOT LIKE '%' || next.arrivee || '%'
        AND
        recur.step < 7)
SELECT DISTINCT *
FROM   current
WHERE
    chemin LIKE '%Nice'
ORDER BY distance ASC;
--     AND
--     (distance / 60) < 24
-- ORDER BY distance ASC;

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