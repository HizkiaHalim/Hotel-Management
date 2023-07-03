CREATE OR REPLACE PROCEDURE sp_hiz_meeting_price_insert
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_rtype_id                 IN  hiz_meeting_price.rtype_id%TYPE,
    in_regular_price            IN  hiz_meeting_price.regular_price%TYPE,
    in_holiday_price            IN  hiz_meeting_price.holiday_price%TYPE,
    in_break_price              IN  hiz_meeting_price.break_price%TYPE,
    in_breakfast_price          IN  hiz_meeting_price.breakfast_price%TYPE,
    in_lunch_price              IN  hiz_meeting_price.lunch_price%TYPE,
    in_dinner_price             IN  hiz_meeting_price.dinner_price%TYPE,
    in_admin_id                 IN  hiz_meeting_price.create_by%TYPE
)
AS
    p_count NUMBER;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    SELECT 
        COUNT(*) 
    INTO 
        p_count
    FROM 
        HIZ_MEETING_PRICE
    WHERE 
        UPPER(rtype_id) = UPPER(in_rtype_id)
        AND status = 1;

    IF p_count > 0 THEN 
        out_code := 1;
	    out_msg := 'PRICE ALREADY REGISTERED';
        RETURN;
    END IF;

    INSERT INTO HIZ_MEETING_PRICE
    (
        id,
        rtype_id,
        regular_price,
        holiday_price,
        break_price,
        breakfast_price,
        lunch_price,
        dinner_price,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        seq_hiz_hotel_price_id.nextval,
        in_rtype_id,
        in_regular_price,
        in_holiday_price,
        in_break_price,
        in_breakfast_price,
        in_lunch_price,
        in_dinner_price,
        in_admin_id,
        SYSDATE,
        1
    );
END;
/
SHOW ERROR