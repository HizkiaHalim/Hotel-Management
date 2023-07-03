CREATE SEQUENCE seq_hiz_hotel_book_id
    START WITH 1 
	INCREMENT BY 1
;

CREATE TABLE hiz_hotel_book
(
	id 							NUMBER,
	transaction_id 			    NUMBER,
	book_by                     VARCHAR2(256),
	booker_phone                VARCHAR2(256),
	check_in                    DATE,
	check_out                   DATE,
	book_qty                    NUMBER,
	--------------------		--------------------
	create_by					NUMBER,
	create_time					DATE DEFAULT SYSDATE,
	update_by					NUMBER,
	update_time					DATE DEFAULT SYSDATE,
	status						NUMBER DEFAULT 1
);