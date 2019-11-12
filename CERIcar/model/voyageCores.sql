DROP FUNCTION IF EXISTS voyageCores(d_depart varchar, a_arrivee varchar);

CREATE OR REPLACE FUNCTION voyageCores(d_depart varchar, a_arrivee varchar)
RETURNS TABLE (
    voyage_id varchar(500)
)
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

            FOR my_record in select *
            FROM  jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet = jabaianb.trajet.id
            WHERE jabaianb.trajet.arrivee=a_arrivee

            loop
                IF my_dep.arrivee = my_record.depart Then

                    
                    heure = my_dep.heuredepart+(my_dep.distance/60);

                    if heure <= my_record.heuredepart Then
                        voyage_id :='';
                        voyage_id := voyage_id || my_dep.id;
                        voyage_id := voyage_id || '|';
                        voyage_id := voyage_id || my_record.id;

                        return NEXT;
                    end if;
                
                END IF;
            end loop;
        END LOOP;

	END;
$$
LANGUAGE plpgsql;

select voyageCores('Paris','Nice');