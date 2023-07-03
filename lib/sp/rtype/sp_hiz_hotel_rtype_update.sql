CREATE OR REPLACE PROCEDURE sp_hiz_hotel_rtype_update
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_id                       IN  hiz_hotel_rtype.id%TYPE,
    in_name                     IN  hiz_hotel_rtype.name%TYPE,
    in_facility_id              IN  hiz_hotel_rtype.facility_id%TYPE,
    in_facility_name            IN  hiz_hotel_rtype.facility_name%TYPE,
    in_admin_id                 IN  hiz_hotel_rtype.create_by%TYPE
)
AS
    t_count NUMBER;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    SELECT 
        COUNT(*) 
    INTO 
        t_count 
    FROM 
        HIZ_HOTEL_RTYPE
    WHERE 
        UPPER(name) = UPPER(in_name)
        AND id != in_id
        AND status = 1;

    IF t_count > 0 THEN 
        out_code := 1;
	    out_msg := 'ROOM TYPE ALREADY REGISTERED';
        RETURN;
    END IF;

    UPDATE
        HIZ_HOTEL_RTYPE
    SET
        name = in_name,
        facility_id = in_facility_id,
        facility_name = in_facility_name,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        id = in_id
    ;
END;
/
SHOW ERROR