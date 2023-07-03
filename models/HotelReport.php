<?php

namespace app\models;

use Yii;
use yii\base\Model;
use PDO;

class HotelReport extends Model
{
    public $errNum = 0;
    public $errStr = '';
    public $rtypeId, $regularPrice, $holidayPrice, $extrabedPrice, $breakfastPrice, $adminId, $id;


//  ---------------------------------------- GET ----------------------------------------

    public function getTransaction()
    {
        $db = Yii::$app->db;
        $sql = "     
                SELECT 
                    T.ID, 
                    T.TRANSACTION_DATE, 
                    T.TOTAL_PRICE, 
                    T.PAYMENT_ID, 
                    P.NAME AS PAYMENT_NAME,
                    B.ID AS BOOK_ID, 
                    B.BOOK_BY, 
                    B.BOOKER_PHONE, 
                    B.BOOK_STATUS, 
                    B.CHECK_IN, 
                    B.CHECK_OUT, 
                    B.BOOK_QTY,
                    LISTAGG ( D.ROOM_ID, ',' ) WITHIN GROUP (ORDER BY D.ROOM_ID ) AS ROOM_ID,
                    LISTAGG ( RT.ID, ',' ) WITHIN GROUP (ORDER BY D.ROOM_ID ) AS RTYPE_ID,
                    LISTAGG ( RT.NAME, ',' ) WITHIN GROUP (ORDER BY D.ROOM_ID ) AS RTYPE_NAME,
                    LISTAGG ( F.NAME, ',' ) WITHIN GROUP (ORDER BY D.ROOM_ID ) AS FLOOR_NAME,
                    LISTAGG ( R.ROOM_NAME, ',' ) WITHIN GROUP (ORDER BY R.ID ) AS ROOM_NAME,
                    LISTAGG ( D.BOOK_EXTRABED , ',' ) WITHIN GROUP (ORDER BY D.ROOM_ID ) AS EXTRABED_QTY,
                    LISTAGG ( D.BOOK_BREAKFAST, ',' ) WITHIN GROUP (ORDER BY D.ROOM_ID ) AS BREAKFAST_QTY,
                    LISTAGG ( D.PRICE, ',' ) WITHIN GROUP (ORDER BY D.ROOM_ID ) AS ROOM_PRICE
                FROM
                    HIZ_HOTEL_TRANSACTION T
                    LEFT JOIN HIZ_HOTEL_BOOK B ON T.ID = B.TRANSACTION_ID
                    LEFT JOIN HIZ_HOTEL_BOOKDETAIL D ON B.ID = D.BOOK_ID
                    LEFT JOIN HIZ_HOTEL_ROOM R ON D.ROOM_ID = R.ID
                    LEFT JOIN HIZ_HOTEL_FLOOR F ON R.FLOOR_ID = F.ID
                    LEFT JOIN HIZ_HOTEL_RTYPE RT ON R.RTYPE_ID = RT.ID
                    LEFT JOIN HIZ_HOTEL_PAYMETHOD P ON T.PAYMENT_ID = P.ID
                WHERE 
                    T.STATUS = 1
                    AND ROWNUM <= 100
                GROUP BY 
                    T.ID, 
                    T.TRANSACTION_DATE, 
                    T.TOTAL_PRICE, 
                    T.PAYMENT_ID,
                    P.NAME,
                    B.ID, 
                    B.BOOK_BY, 
                    B.BOOKER_PHONE,  
                    B.BOOK_STATUS, 
                    B.CHECK_IN, 
                    B.CHECK_OUT, 
                    B.BOOK_QTY
                ORDER BY 
                    T.ID DESC";
        $st = $db->createCommand($sql);
        $method = $st->queryAll();

        return $method;
    }

    public function getPaymentMethod()
    {
        $db = Yii::$app->db;
        $sql = "
                SELECT 
                    ID,
                    NAME
                FROM 
                    HIZ_HOTEL_PAYMETHOD
                WHERE
                    STATUS = 1";
        $st = $db->createCommand($sql);
        $method = $st->queryAll();

        return $method;
    }
}