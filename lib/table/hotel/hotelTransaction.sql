CREATE SEQUENCE seq_hiz_hotel_transaction_id
    START WITH 1 
	INCREMENT BY 1
;

CREATE TABLE hiz_hotel_transaction
(
	id 							NUMBER,
	payment_id 					NUMBER,
	transaction_date            DATE,
	total_price                 NUMBER,
	--------------------		--------------------
	create_by					NUMBER,
	create_time					DATE DEFAULT SYSDATE,
	update_by					NUMBER,
	update_time					DATE DEFAULT SYSDATE,
	status						NUMBER DEFAULT 1
);