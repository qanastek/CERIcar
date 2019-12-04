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



-- Fini
-- Fonction contenant la requête
DROP FUNCTION IF EXISTS correspondances(from_city VARCHAR, to_city VARCHAR, nbrPlaces INTEGER);

CREATE OR REPLACE FUNCTION correspondances(from_city VARCHAR, to_city VARCHAR, nbrPlaces INTEGER)
RETURNS TABLE (
    arrivee VARCHAR,
    step INTEGER,
    distance_totale INTEGER,
    chemin VARCHAR,
    chemin_id VARCHAR,
    heure INTEGER,
    prix_total INTEGER,
    heure_arrive INTEGER,
    heureArrivee VARCHAR
)
AS $$
BEGIN
    RETURN QUERY
    WITH RECURSIVE current (arrivee,step,distance_totale,chemin,chemin_id,heure,prix_total,heure_arrive,heureArrivee) 
    AS
    (
        SELECT depart,0,0, CAST(from_city AS VARCHAR) ,CAST('0' AS VARCHAR),0,0,heuredepart,CAST('' AS VARCHAR)
        FROM (jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id) 
        WHERE jabaianb.trajet.depart = from_city
        UNION  ALL
        SELECT next.arrivee,
            recur.step + 1,
            recur.distance_totale + next.distance,
            recur.chemin || ',' || next.arrivee,
            recur.chemin_id || ',' || next.id,
            next.heuredepart,
            recur.prix_total +tarif,
            next.heuredepart + (next.distance / 60),
            next.heuredepart + (next.distance / 60) || ':' || next.heuredepart + (next.distance % 60)
            
        FROM (select depart,trajet.arrivee,distance,heuredepart,voyage.id,tarif from jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id) AS next
            INNER JOIN current AS recur
                    ON recur.arrivee = next.depart
        WHERE 
            recur.chemin NOT LIKE '%' || next.arrivee || '%'
            AND
            recur.heure_arrive <= next.heuredepart
            AND
            (recur.distance_totale / 60 ) < 24
            AND
            NbPlacesRestante(next.id) >= nbrPlaces
    )
    SELECT DISTINCT *
    FROM   current
    WHERE
        current.chemin LIKE '%' || to_city
        AND
        current.step > 1
    ORDER BY
        distance_totale ASC,
        step ASC,
        prix_total ASC,
        heure_arrive ASC;
END;
$$ LANGUAGE plpgsql;

select * from correspondances('Paris','Nice',2);