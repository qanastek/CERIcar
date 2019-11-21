CREATE OR REPLACE FUNCTION NbVoyagesTrajet(idTrajet INTEGER)
RETURNS INTEGER
AS $$
    DECLARE
        counter INTEGER;
    BEGIN
        Select count(DISTINCT jabaianb.voyage.id) INTO counter from jabaianb.voyage where NbPlacesRestante(id) > 0 AND jabaianb.voyage.trajet = idTrajet;
        return counter;
    END;
$$ LANGUAGE plpgsql;

SELECT NbVoyagesTrajet(2);