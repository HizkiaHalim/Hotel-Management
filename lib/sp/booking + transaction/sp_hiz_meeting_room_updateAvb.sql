CREATE OR REPLACE PROCEDURE sp_hiz_meeting_room_updateAvb
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
	in_id				        IN	hiz_meeting_room.id%TYPE,
    in_admin_id                 IN  hiz_meeting_room.create_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';

    UPDATE
        HIZ_MEETING_ROOM
    SET
        room_status = 'available',
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        id = in_id 
    ;
END;
/
SHOW ERRORS