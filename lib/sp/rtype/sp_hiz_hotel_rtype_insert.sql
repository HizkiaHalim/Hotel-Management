CREATE OR REPLACE PROCEDURE sp_hiz_hotel_rtype_insert
(
    out_code			        OUT	NUMBER,
    out_rtype_id			    OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_name                     IN  hiz_hotel_rtype.name%TYPE,
    in_facility_id              IN  hiz_hotel_rtype.facility_id%TYPE,
    in_facility_name            IN  hiz_hotel_rtype.facility_name%TYPE,
    in_create_by                IN  hiz_hotel_rtype.create_by%TYPE
)
AS
    t_count NUMBER;
BEGIN
    out_code := 0;
	out_msg := 'OK';
    out_rtype_id := seq_hiz_hotel_rtype_id.nextval;

    SELECT 
        COUNT(*) 
    INTO 
        t_count 
    FROM 
        HIZ_HOTEL_RTYPE
    WHERE 
        UPPER(name) = UPPER(in_name)
        AND status = 1;

    IF t_count > 0 THEN 
        out_code := 1;
	    out_msg := 'ROOM TYPE ALREADY REGISTERED';
        RETURN;
    END IF;

    INSERT INTO HIZ_HOTEL_RTYPE
    (
        id,
        name,
        facility_id,
        facility_name,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        out_rtype_id,
        in_name,
        in_facility_id,
        in_facility_name,
        in_create_by,
        SYSDATE,
        1
    );
END;
/
SHOW ERROR