CREATE OR REPLACE PROCEDURE sp_hiz_hotel_room_updateBooked
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_id                       IN  hiz_hotel_room.id%TYPE,
    in_room_status              IN  hiz_hotel_room.room_status%TYPE,
    in_admin_id                 IN  hiz_hotel_room.create_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';

    UPDATE 
        HIZ_HOTEL_ROOM
    SET
        room_status = in_room_status,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        id = in_id
    ;

END;
/
SHOW ERROR

CREATE OR REPLACE PROCEDURE sp_hiz_hotel_room_update
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_id                       IN  hiz_hotel_floor.id%TYPE,
    in_floor_id                 IN  hiz_hotel_room.floor_id%TYPE,
    in_rtype_id                 IN  hiz_hotel_room.rtype_id%TYPE,
    in_room_name                IN  hiz_hotel_room.room_name%TYPE,
    in_room_status              IN  hiz_hotel_room.room_status%TYPE,
    in_rtype_name               IN  hiz_hotel_room.rtype_name%TYPE,
    in_admin_id                 IN  hiz_hotel_room.create_by%TYPE
)
AS
    r_count NUMBER;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    SELECT 
        COUNT(*) 
    INTO 
        r_count 
    FROM 
        HIZ_HOTEL_ROOM
    WHERE 
        UPPER(room_name) = UPPER(in_room_name)
        AND floor_id = in_floor_id
        AND id != in_id
        AND status = 1;

    IF r_count > 0 THEN 
        out_code := 1;
	    out_msg := 'ROOM ALREADY REGISTERED';
        RETURN;
    END IF;

    UPDATE 
        HIZ_HOTEL_ROOM
    SET
        rtype_name = in_rtype_name,
        rtype_id = in_rtype_id,
        floor_id = in_floor_id,
        room_name = in_room_name,
        room_status = in_room_status,
        update_by = in_admin_id,
        update_time = SYSDATE,
        status = 1
    WHERE
        id = in_id
    ;

END;
/
SHOW ERROR