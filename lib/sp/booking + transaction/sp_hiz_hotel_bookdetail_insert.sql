CREATE OR REPLACE PROCEDURE sp_hiz_hotel_bookdetail_insert
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_book_id                  IN  hiz_hotel_bookdetail.book_id%TYPE,
    in_room_id                  IN  hiz_hotel_bookdetail.room_id%TYPE,
    in_book_extrabed            IN  hiz_hotel_bookdetail.book_extrabed%TYPE,
    in_book_breakfast           IN  hiz_hotel_bookdetail.book_breakfast%TYPE,
    in_price                    IN  hiz_hotel_bookdetail.price%TYPE,
    in_create_by                IN  hiz_hotel_bookdetail.create_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';

    INSERT INTO HIZ_HOTEL_BOOKDETAIL
    (
        id,
        book_id,
        room_id,
        book_extrabed,
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
        in_book_extrabed,
        in_book_breakfast,
        in_price,
        in_create_by,
        SYSDATE,
        1
    );
END;
/
SHOW ERROR