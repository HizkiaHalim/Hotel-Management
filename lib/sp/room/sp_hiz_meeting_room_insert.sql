CREATE OR REPLACE PROCEDURE sp_hiz_meeting_room_insert
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_floor_id                 IN  hiz_meeting_room.floor_id%TYPE,
    in_rtype_id                 IN  hiz_meeting_room.rtype_id%TYPE,
    in_room_name                IN  hiz_meeting_room.room_name%TYPE,
    in_capacity                 IN  hiz_meeting_room.capacity%TYPE,
    in_table_qty                IN  hiz_meeting_room.table_qty%TYPE,
    in_chair_qty                IN  hiz_meeting_room.chair_qty%TYPE,
    in_room_map                 IN  hiz_meeting_room.room_map%TYPE,
    in_room_status              IN  hiz_meeting_room.room_status%TYPE,
    in_rtype_name               IN  hiz_meeting_room.rtype_name%TYPE,
    in_create_by                IN  hiz_meeting_room.create_by%TYPE
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
        HIZ_MEETING_ROOM
    WHERE 
        UPPER(room_name) = UPPER(in_room_name)
        AND floor_id = in_floor_id
        AND status = 1;

    IF r_count > 0 THEN 
        out_code := 1;
	    out_msg := 'ROOM ALREADY REGISTERED';
        RETURN;
    END IF;

    INSERT INTO HIZ_MEETING_ROOM
    (
        id,
        floor_id,
        rtype_id,
        room_name,
        capacity,
        table_qty,
        chair_qty,
        room_map,	
        room_status,
        rtype_name,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        seq_hiz_meeting_room_id.nextval,
        in_floor_id,
        in_rtype_id,
        in_room_name,
        in_capacity,
        in_table_qty,
        in_chair_qty,
        in_room_map,	
        in_room_status,
        in_rtype_name,
        in_create_by,
        SYSDATE,
        1
    );
END;
/
SHOW ERROR