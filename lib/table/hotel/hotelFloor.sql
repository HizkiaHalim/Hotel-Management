CREATE SEQUENCE seq_hiz_hotel_floor_id
    START WITH 1 
	INCREMENT BY 1
;

CREATE TABLE hiz_hotel_floor
(
	id 							NUMBER,
	name                        VARCHAR2(256),
	floor_level                 NUMBER,
	qty                         NUMBER,
	floor_row					NUMBER,
	floor_column				NUMBER,
	--------------------		--------------------
	create_by					NUMBER,
	create_time					DATE DEFAULT SYSDATE,
	update_by					NUMBER,
	update_time					DATE DEFAULT SYSDATE,
	status						NUMBER DEFAULT 1
);


