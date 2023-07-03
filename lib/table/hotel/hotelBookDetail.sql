CREATE SEQUENCE seq_hiz_hotel_bookdetail_id
    START WITH 1 
	INCREMENT BY 1
;

CREATE TABLE hiz_hotel_bookdetail
(
	id 							NUMBER,
	book_id 			        NUMBER,
	room_id                     NUMBER,
	book_extrabed               NUMBER,
	book_breakfast              NUMBER,
	price                       NUMBER,
	--------------------		--------------------
	create_by					NUMBER,
	create_time					DATE DEFAULT SYSDATE,
	update_by					NUMBER,
	update_time					DATE DEFAULT SYSDATE,
	status						NUMBER DEFAULT 1
);