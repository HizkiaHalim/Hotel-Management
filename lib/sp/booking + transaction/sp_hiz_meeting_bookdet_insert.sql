CREATE OR REPLACE PROCEDURE sp_hiz_meeting_bookdet_insert
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_book_id                  IN  hiz_meeting_bookdetail.book_id%TYPE,
    in_room_id                  IN  hiz_meeting_bookdetail.room_id%TYPE,
    in_book_break               IN  hiz_meeting_bookdetail.book_break%TYPE,
    in_book_breakfast           IN  hiz_meeting_bookdetail.book_breakfast%TYPE,
    in_book_lunch               IN  hiz_meeting_bookdetail.book_lunch%TYPE,
    in_book_dinner              IN  hiz_meeting_bookdetail.book_dinner%TYPE,
    in_price                    IN  hiz_meeting_bookdetail.price%TYPE,
    in_create_by                IN  hiz_meeting_bookdetail.create_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';

    INSERT INTO HIZ_MEETING_BOOKDETAIL
    (
        id,
        book_id,
        room_id,
        book_break,
        book_lunch,
        book_dinner,
        book_breakfast,
        price,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        seq_hiz_hotel_bookdetail_id.nextval,
        in_book_id,
        in_room_id,
        in_book_break,
        in_book_lunch,
        in_book_dinner,
        in_book_breakfast,
        in_price,
        in_create_by,
        SYSDATE,
        1
    );
END;
/
SHOW ERROR