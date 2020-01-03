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
    heureArrivee VARCHAR,
    placeRestante INTEGER
)
AS $$
BEGIN
    RETURN QUERY
    WITH RECURSIVE current (arrivee,step,distance_totale,chemin,chemin_id,heure,prix_total,heure_arrive,heureArrivee,placeRestante) 
    AS
    (
        SELECT depart,0,0, CAST(from_city AS VARCHAR) ,CAST('0' AS VARCHAR),0,0,heuredepart,CAST('' AS VARCHAR),NbPlacesRestante(voyage.id)
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
            next.heuredepart + (next.distance / 60) || ':' || next.heuredepart + (next.distance % 60),
            LEAST(recur.placeRestante,NbPlacesRestante(next.id))
            
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
            AND
            recur.placeRestante >= nbrPlaces
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
        placeRestante ASC,
        prix_total ASC,
        heure_arrive ASC;
END;
$$ LANGUAGE plpgsql;

select * from correspondances('Paris','Nice',2);