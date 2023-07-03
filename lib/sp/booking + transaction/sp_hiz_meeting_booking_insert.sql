CREATE OR REPLACE PROCEDURE sp_hiz_meeting_booking_insert
(
    out_code			        OUT	NUMBER,
    out_id			            OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_transaction_id           IN  hiz_meeting_book.transaction_id%TYPE,
    in_book_by                  IN  hiz_meeting_book.book_by%TYPE,
    in_booker_phone             IN  hiz_meeting_book.booker_phone%TYPE,
    in_check_in                 IN  hiz_meeting_book.check_in%TYPE,
    in_check_out                IN  hiz_meeting_book.check_out%TYPE,
    in_book_qty                 IN  hiz_meeting_book.book_qty%TYPE,
    in_create_by                IN  hiz_meeting_book.create_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';
	out_id := seq_hiz_meeting_book_id.nextval;

    INSERT INTO HIZ_MEETING_BOOK
    (
        id,
        transaction_id,
        book_by,
        booker_phone,
        book_status,
        check_in,
        check_out,
        book_qty,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        out_id,
        in_transaction_id,
        in_book_by,
        in_booker_phone,
        'booked',
        in_check_in,
        in_check_out,
        in_book_qty,
        in_create_by,
        SYSDATE,
        1
    );
END;
/
SHOW ERROR