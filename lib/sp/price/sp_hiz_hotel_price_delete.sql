CREATE OR REPLACE PROCEDURE sp_hiz_hotel_price_delete
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_id                       IN  hiz_hotel_price.id%TYPE,
    in_admin_id                 IN  hiz_hotel_price.update_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';

    UPDATE 
        HIZ_HOTEL_PRICE
    SET
        status = 0,
        rtype_id = 0,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        id = in_id
    ;
END;
/
SHOW ERROR