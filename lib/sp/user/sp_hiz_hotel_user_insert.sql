CREATE OR REPLACE PROCEDURE sp_hiz_hotel_user_insert
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
	out_id				        OUT	NUMBER,
    in_f_name                   IN  hiz_hotel_user.f_name%TYPE,
    in_l_name                   IN  hiz_hotel_user.l_name%TYPE,
    in_identity_num             IN  hiz_hotel_user.identity_num%TYPE,
    in_email                    IN  hiz_hotel_user.email%TYPE,
    in_password                 IN  hiz_hotel_user.password%TYPE,
    in_phone_num                IN  hiz_hotel_user.phone_num%TYPE,
    in_address                  IN  hiz_hotel_user.address%TYPE,
    in_admin_level              IN  hiz_hotel_user.admin_level%TYPE,
    in_create_by                IN  hiz_hotel_user.create_by%TYPE
)
AS
    e_count NUMBER;
    i_count NUMBER;
BEGIN
    out_code := 0;
	out_msg := 'OK';
	out_id := seq_hiz_hotel_user_id.nextval;

    SELECT 
        COUNT(*) 
    INTO 
        e_count 
    FROM 
        HIZ_HOTEL_USER
    WHERE 
        UPPER(email) = UPPER(in_email)
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
        AND status = 1;

    IF i_count > 0 THEN 
        out_code := 1;
	    out_msg := 'IDENTITY NUMBER ALREADY REGISTERED';
        RETURN;
    END IF;

    INSERT INTO HIZ_HOTEL_USER
    (
        id,
        f_name,
        l_name,
        identity_num,
        email,
        password,
        phone_num,
        address,
        admin_level,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        out_id,
        in_f_name,
        in_l_name,
        in_identity_num,
        in_email,
        in_password,
        in_phone_num,
        in_address,
        in_admin_level,
        in_create_by,
        SYSDATE,
        1
    );
END;
/
SHOW ERROR