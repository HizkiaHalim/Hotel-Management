CREATE SEQUENCE seq_hiz_hotel_price_id
    START WITH 1 
	INCREMENT BY 1
;

CREATE TABLE hiz_hotel_price
(
	id 							NUMBER,
	rtype_id 					NUMBER,
	regular_price 				NUMBER,
	holiday_price 				NUMBER,
	extrabed_price 				NUMBER,
	breakfast_price 		    NUMBER,
	--------------------		--------------------
	create_by					NUMBER,
	create_time					DATE DEFAULT SYSDATE,
	update_by					NUMBER,
	update_time					DATE DEFAULT SYSDATE,
	status						NUMBER DEFAULT 1
);

