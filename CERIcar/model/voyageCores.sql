DROP FUNCTION IF EXISTS voyageCores(depart varchar, arrivee varchar);

CREATE OR REPLACE FUNCTION voyageCores(depart varchar, arrivee varchar)
RETURNS VOID
AS
$$
	DECLARE
		my_record record;
        my_dep record;
	BEGIN
        FOR my_dep in select *
            FROM jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id
            WHERE jabaianb.trajet.depart=depart
        LOOP
            raise notice 'test:%',my_dep;

        END LOOP;

	END;
$$
LANGUAGE plpgsql;

select voyageCOres('Paris','Lyon');