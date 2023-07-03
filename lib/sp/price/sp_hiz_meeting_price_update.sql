CREATE OR REPLACE PROCEDURE sp_hiz_meeting_price_update
(
    out_code			        OUT	NUMBER,
	out_msg				        OUT	VARCHAR2,
    in_id                       IN  hiz_meeting_price.id%TYPE,
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
        rtype_id = in_rtype_id
        AND id != in_id
        AND status = 1;

    IF p_count > 0 THEN 
        out_code := 1;
	    out_msg := 'PRICE ALREADY REGISTERED';
        RETURN;
    END IF;

    UPDATE
        HIZ_MEETING_PRICE
    SET
        rtype_id = in_rtype_id,
        regular_price = in_regular_price,
        holiday_price = in_holiday_price,
        break_price = in_break_price,
        breakfast_price = in_breakfast_price,
        lunch_price = in_lunch_price,
        dinner_price = in_dinner_price,
        update_by = in_admin_id,
        update_time = SYSDATE
    WHERE
        id = in_id
    ;
END;
/