CREATE OR REPLACE PROCEDURE sp_hiz_hotel_rtype_delete
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_id                       IN  hiz_hotel_rtype.id%TYPE,
    in_admin_id                 IN  hiz_hotel_rtype.update_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';

    UPDATE 
        HIZ_HOTEL_RTYPE
    SET
        status = 0,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        id = in_id
    ;

    UPDATE 
        HIZ_HOTEL_PRICE
    SET
        status = 0,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        rtype_id = in_id
        AND status = 1
    ;

    UPDATE 
        HIZ_HOTEL_ROOM
    SET
        rtype_name = '-',
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        rtype_id = in_id
        AND status = 1
    ;
END;
/
SHOW ERROR