CREATE OR REPLACE PROCEDURE sp_hiz_meeting_floor_update
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_id                       IN  hiz_meeting_floor.id%TYPE,
    in_name                     IN  hiz_meeting_floor.name%TYPE,
    in_floor_level              IN  hiz_meeting_floor.floor_level%TYPE,
    in_qty                      IN  hiz_meeting_floor.qty%TYPE,
    in_rtype_id                 IN  hiz_hotel_floor.rtype_id%TYPE,
    in_rtype_name               IN  hiz_hotel_floor.rtype_name%TYPE,
    in_floor_row                IN  hiz_meeting_floor.floor_row%TYPE,
    in_floor_column             IN  hiz_meeting_floor.floor_column%TYPE,
    in_admin_id                 IN  hiz_meeting_floor.update_by%TYPE
)
AS
    n_count NUMBER;
    l_count NUMBER;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    SELECT 
        COUNT(*) 
    INTO 
        n_count 
    FROM 
        HIZ_MEETING_FLOOR
    WHERE 
        UPPER(name) = UPPER(in_name)
        AND status = 1
        AND id != in_id;

    IF n_count > 0 THEN 
        out_code := 1;
	    out_msg := 'FLOOR NAME ALREADY REGISTERED';
        RETURN;
    END IF;

    SELECT 
        COUNT(*) 
    INTO 
        l_count 
    FROM 
        HIZ_MEETING_FLOOR
    WHERE 
        floor_level = in_floor_level
        AND status = 1
        AND id != in_id;

    IF l_count > 0 THEN 
        out_code := 1;
	    out_msg := 'FLOOR LEVEL ALREADY REGISTERED';
        RETURN;
    END IF;

    UPDATE
        HIZ_MEETING_FLOOR
    SET
        id = in_id,
        name = in_name,
        floor_level = in_floor_level,
        floor_row = in_floor_row,
        floor_column = in_floor_column,
        rtype_id = in_rtype_id,
        rtype_name = in_rtype_name,
        qty = in_qty,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        id = in_id
    ;
END;
/
SHOW ERRORS