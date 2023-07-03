CREATE OR REPLACE PROCEDURE sp_hiz_hotel_floor_insert
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_name                     IN  hiz_hotel_floor.name%TYPE,
    in_floor_level              IN  hiz_hotel_floor.floor_level%TYPE,
    in_qty                      IN  hiz_hotel_floor.qty%TYPE,
    in_rtype_id                 IN  hiz_hotel_floor.rtype_id%TYPE,
    in_rtype_name               IN  hiz_hotel_floor.rtype_name%TYPE,
    in_floor_row                IN  hiz_hotel_floor.floor_row%TYPE,
    in_floor_column             IN  hiz_hotel_floor.floor_column%TYPE,
    in_admin_id                 IN  hiz_hotel_floor.update_by%TYPE
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
        HIZ_HOTEL_FLOOR
    WHERE 
        UPPER(name) = UPPER(in_name)
        AND status = 1;

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
        HIZ_HOTEL_FLOOR
    WHERE 
        floor_level = in_floor_level
        AND status = 1;

    IF l_count > 0 THEN 
        out_code := 1;
	    out_msg := 'FLOOR LEVEL ALREADY REGISTERED';
        RETURN;
    END IF;

    INSERT INTO HIZ_HOTEL_FLOOR
    (
        id,
        name,
        floor_level,
        floor_row,
        floor_column,
        rtype_id,
        rtype_name,
        qty,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        seq_hiz_hotel_floor_id.nextval,
        in_name,
        in_floor_level,
        in_floor_row,
        in_floor_column,
        in_rtype_id,
        in_rtype_name,
        in_qty,
        in_admin_id,
        SYSDATE,
        1
    );
END;
/
SHOW ERRORS