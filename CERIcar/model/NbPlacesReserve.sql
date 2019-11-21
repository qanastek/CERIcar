DROP FUNCTION IF EXISTS NbPlacesReserve(idVoyage integer);

CREATE OR REPLACE FUNCTION NbPlacesReserve(idVoyage integer)
RETURNS integer
AS
$$
	DECLARE
        counter INTEGER;
	BEGIN
        SELECT COUNT(*) INTO counter FROM jabaianb.reservation WHERE voyage = idVoyage;
        return counter;
	END;
$$
LANGUAGE plpgsql;

select  NbPlacesReserve(2);