CREATE OR REPLACE PROCEDURE sp_hiz_hotel_paymethod_delete
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_id                       IN  hiz_hotel_paymethod.id%TYPE,
    in_admin_id                 IN  hiz_hotel_paymethod.update_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';

    UPDATE 
        HIZ_HOTEL_PAYMETHOD
    SET
        status = 0,
        update_by = 1,
        update_time = SYSDATE
    WHERE
        id = in_id
    ;
END;
/