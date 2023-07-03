CREATE OR REPLACE PROCEDURE sp_hiz_meeting_rtype_delete
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_id                       IN  hiz_meeting_rtype.id%TYPE,
    in_admin_id                 IN  hiz_meeting_rtype.update_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';

    UPDATE 
        HIZ_MEETING_RTYPE
    SET
        status = 0,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        id = in_id
    ;

    UPDATE 
        HIZ_MEETING_PRICE
    SET
        status = 0,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        rtype_id = in_id
        AND status = 1
    ;

    UPDATE 
        HIZ_MEETING_ROOM
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