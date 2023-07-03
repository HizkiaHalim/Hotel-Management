CREATE OR REPLACE PROCEDURE sp_hiz_meeting_facility_insert
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_name                     IN  hiz_meeting_facility.name%TYPE,
    in_create_by                IN  hiz_meeting_facility.create_by%TYPE
)
AS
    p_count NUMBER;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    SELECT 
        COUNT(*) 
    INTO 
        p_count 
    FROM 
        HIZ_MEETING_FACILITY
    WHERE 
        UPPER(name) = UPPER(in_name)
        AND status = 1;

    IF p_count > 0 THEN 
        out_code := 1;
	    out_msg := 'FACILITY ALREADY REGISTERED';
        RETURN;
    END IF;

    INSERT INTO HIZ_MEETING_FACILITY
    (
        id,
        name,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        seq_hiz_meeting_facility_id.nextval,
        in_name,
        in_create_by,
        SYSDATE,
        1
    );
END;
/
SHOW ERROR