CREATE OR REPLACE PROCEDURE sp_hiz_hotel_user_update
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
	in_id				        IN	hiz_hotel_user.id%TYPE,
    in_f_name                   IN  hiz_hotel_user.f_name%TYPE,
    in_l_name                   IN  hiz_hotel_user.l_name%TYPE,
    in_identity_num             IN  hiz_hotel_user.identity_num%TYPE,
    in_email                    IN  hiz_hotel_user.email%TYPE,
    in_password                 IN  hiz_hotel_user.password%TYPE,
    in_phone_num                IN  hiz_hotel_user.phone_num%TYPE,
    in_address                  IN  hiz_hotel_user.address%TYPE,
    in_admin_level              IN  hiz_hotel_user.admin_level%TYPE,
    in_admin_id                 IN  hiz_hotel_user.create_by%TYPE
)
AS
    e_count NUMBER;
    i_count NUMBER;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    SELECT 
        COUNT(*) 
    INTO 
        e_count 
    FROM 
        HIZ_HOTEL_USER
    WHERE 
        UPPER(email) = UPPER(in_email)
        AND id != in_id
        AND status = 1;

    IF e_count > 0 THEN 
        out_code := 1;
	    out_msg := 'EMAIL ALREADY REGISTERED';
        RETURN;
    END IF;

    
    SELECT 
        COUNT(*) 
    INTO 
        i_count 
    FROM 
        HIZ_HOTEL_USER
    WHERE 
        identity_num = in_identity_num
        AND id != in_id
        AND status = 1;

    IF i_count > 0 THEN 
        out_code := 1;
	    out_msg := 'IDENTITY NUMBER ALREADY REGISTERED';
        RETURN;
    END IF;

    UPDATE
        HIZ_HOTEL_USER
    SET
        f_name = in_f_name,
        l_name = in_l_name,
        identity_num = in_identity_num,
        email = in_email,
        password = in_password,
        phone_num = in_phone_num,
        address = in_address,
        admin_level = in_admin_level,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        id = in_id
    ;
END;
/

DECLARE
    outCode NUMBER;
    outMsg VARCHAR2(4000);
BEGIN
    sp_hiz_memory_achieve_insert
    (
        out_code		            => outCode,
        out_msg			            => outMsg,
        in_id                       => '4',
        in_f_name                   => 'Hizkia',
        in_l_name                   => 'Halim',
        in_identity_num             => '1234567890123456',
        in_email                    => 'hizkia.halim@sqiva.com',
        in_password                 => '$2y$10$1CCeiFeAQUL3A5hNwvtBX.lFdS.CHO8O5C6WYM439HsR2AqhBg.16',
        in_phone_num                => '1234567890',
        in_address                  => 'di+rumah+tempat+saya+tinggal',
        in_admin_level              => 'SuperAdmin',
        in_admin_id 	            => '3'
    );
    dbms_output.put_line(outCode);
    dbms_output.put_line(outMsg);
END;
/