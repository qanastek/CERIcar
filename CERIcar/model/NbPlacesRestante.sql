DROP FUNCTION IF EXISTS NbPlacesRestante(idVoyage integer);

CREATE OR REPLACE FUNCTION NbPlacesRestante(idVoyage integer)
RETURNS integer
AS
$$
	DECLARE
        counter INTEGER;
	BEGIN
        SELECT nbplace - NbPlacesReserve(idVoyage) INTO counter FROM jabaianb.voyage WHERE id = idVoyage;
        return counter;
	END;
$$
LANGUAGE plpgsql;

select NbPlacesRestante(2);