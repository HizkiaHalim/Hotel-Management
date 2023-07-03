CREATE OR REPLACE PROCEDURE sp_hiz_hotel_booking_delete
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
	in_id				        IN	hiz_hotel_book.id%TYPE,
    in_transaction_id           IN  hiz_hotel_book.transaction_Id%TYPE,
    in_admin_id                 IN  hiz_hotel_book.create_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';

    UPDATE
        HIZ_HOTEL_BOOK
    SET
        status = 0,
        book_status = 'not booked',
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        id = in_id 
        AND transaction_Id = in_transaction_id
    ;

    UPDATE
        HIZ_HOTEL_TRANSACTION
    SET
        status = 0,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        id = in_transaction_id
    ;
END;
/
SHOW ERRORS