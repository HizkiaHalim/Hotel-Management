CREATE SEQUENCE seq_hiz_meeting_room_id
    START WITH 1 
	INCREMENT BY 1
;

CREATE TABLE hiz_meeting_room
(
	id 							NUMBER,
	floor_id                    NUMBER,
	rtype_id                    NUMBER,
	capacity                    NUMBER,
	table_qty                   NUMBER,
	chair_qty                   NUMBER,
	room_map					VARCHAR2(512),
	room_name					VARCHAR2(256),
	room_status				    VARCHAR2(256),
	rtype_name				    VARCHAR2(256),
	--------------------		--------------------
	create_by					NUMBER,
	create_time					DATE DEFAULT SYSDATE,
	update_by					NUMBER,
	update_time					DATE DEFAULT SYSDATE,
	status						NUMBER DEFAULT 1
);
