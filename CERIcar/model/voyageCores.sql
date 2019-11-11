DROP FUNCTION IF EXISTS voyageCores(d_depart varchar, a_arrivee varchar);

CREATE OR REPLACE FUNCTION voyageCores(d_depart varchar, a_arrivee varchar)
RETURNS VOID
AS
$$
	DECLARE
		my_record record;
        my_dep record;
        heure numeric;

	BEGIN
        FOR my_dep in select *
            FROM jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id
            WHERE jabaianb.trajet.depart=d_depart
        LOOP
            raise notice 'test:%',my_dep;

            FOR my_record in select *
            FROM jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id
            WHERE jabaianb.trajet.arrivee=a_arrivee

            loop
                IF my_dep.arrivee = my_record.depart Then

                    
                    heure = my_dep.heuredepart + (trunc(my_dep.distance/60)+1);

                    if heure <= my_record.heuredepart Then

                    raise notice 'corespondance: % > %',my_dep,my_record;
                    end if;
                
                END IF;
            end loop;
        END LOOP;

	END;
$$
LANGUAGE plpgsql;

select voyageCores('Paris','Nice');
