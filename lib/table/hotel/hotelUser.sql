CREATE SEQUENCE seq_hiz_hotel_user_id
    START WITH 1 
	INCREMENT BY 1
;

CREATE TABLE hiz_hotel_user
(
	id 							NUMBER,
	f_name                      VARCHAR2(256),
    l_name                      VARCHAR2(256),
    identity_num                NUMBER,
    email                       VARCHAR2(256),
    password                    VARCHAR2(256),
    phone_num                   VARCHAR2(256),
    address                     VARCHAR2(256),
    admin_level                 VARCHAR2(256),
	--------------------		--------------------
	create_by					NUMBER,
	create_time					DATE DEFAULT SYSDATE,
	update_by					NUMBER,
	update_time					DATE DEFAULT SYSDATE,
	status						NUMBER DEFAULT 1
);