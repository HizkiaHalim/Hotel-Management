CREATE OR REPLACE PROCEDURE sp_hiz_hotel_room_delete
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_id                       IN  hiz_hotel_room.id%TYPE,
    in_admin_id                 IN  hiz_hotel_room.update_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';

    UPDATE 
        HIZ_HOTEL_ROOM
    SET
        status = 0,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        id = in_id
    ;
END;
/
SHOW ERROR

CREATE OR REPLACE PROCEDURE sp_hiz_hotel_room_clear
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_floor_id                 IN  hiz_hotel_room.floor_id%TYPE,
    in_admin_id                 IN  hiz_hotel_room.update_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';

    UPDATE 
        HIZ_HOTEL_ROOM
    SET
        status = 0,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        floor_id = in_floor_id
    ;
END;
/
SHOW ERROR