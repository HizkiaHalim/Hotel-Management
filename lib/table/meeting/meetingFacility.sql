CREATE SEQUENCE seq_hiz_meeting_facility_id
    START WITH 1 
	INCREMENT BY 1
;

CREATE TABLE hiz_meeting_facility
(
	id 							NUMBER,
	name                        VARCHAR2(256),
	--------------------		--------------------
	create_by					NUMBER,
	create_time					DATE DEFAULT SYSDATE,
	update_by					NUMBER,
	update_time					DATE DEFAULT SYSDATE,
	status						NUMBER DEFAULT 1
);