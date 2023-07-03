CREATE OR REPLACE PROCEDURE sp_hiz_hotel_facility_delete
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_id                       IN  hiz_hotel_facility.id%TYPE,
    in_admin_id                 IN  hiz_hotel_facility.update_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';

    UPDATE 
        HIZ_HOTEL_FACILITY
    SET
        status = 0,
        update_by = 1,
        update_time = SYSDATE
    WHERE
        id = in_id
    ;
END;
/