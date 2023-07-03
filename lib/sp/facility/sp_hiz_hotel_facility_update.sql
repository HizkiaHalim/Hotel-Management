CREATE OR REPLACE PROCEDURE sp_hiz_hotel_facility_update
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
	in_id				        IN	hiz_hotel_facility.id%TYPE,
    in_name                     IN  hiz_hotel_facility.name%TYPE,
    in_admin_id                 IN  hiz_hotel_facility.create_by%TYPE
)
AS
    e_count NUMBER;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    SELECT 
        COUNT(*) 
    INTO 
        e_count 
    FROM 
        HIZ_HOTEL_FACILITY
    WHERE 
        UPPER(name) = UPPER(in_name)
        AND id != in_id
        AND status = 1;

    IF e_count > 0 THEN 
        out_code := 1;
	    out_msg := 'FACILITY ALREADY REGISTERED';
        RETURN;
    END IF;

    UPDATE
        HIZ_HOTEL_FACILITY
    SET
        name = in_name,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        id = in_id
    ;
END;
/