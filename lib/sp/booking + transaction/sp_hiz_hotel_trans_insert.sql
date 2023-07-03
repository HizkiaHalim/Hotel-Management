CREATE OR REPLACE PROCEDURE sp_hiz_hotel_trans_insert
(
    out_code			        OUT	NUMBER,
    out_id			            OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_transaction_date         IN  hiz_hotel_transaction.transaction_date%TYPE,
    in_payment_id               IN  hiz_hotel_transaction.payment_id%TYPE,
    in_total_price              IN  hiz_hotel_transaction.total_price%TYPE,
    in_create_by                IN  hiz_hotel_transaction.create_by%TYPE
)
AS
BEGIN
    out_code := 0;
	out_msg := 'OK';
	out_id := seq_hiz_hotel_transaction_id.nextval;

    INSERT INTO HIZ_HOTEL_TRANSACTION
    (
        id,
        transaction_date,
        payment_id,
        total_price,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        out_id,
        in_transaction_date,
        in_payment_id,
        in_total_price,
        in_create_by,
        SYSDATE,
        1
    );
END;
/
SHOW ERROR