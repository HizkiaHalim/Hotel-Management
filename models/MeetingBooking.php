<?php

namespace app\models;

use Yii;
use yii\base\Model;
use PDO;

class MeetingBooking extends Model
{
    public $errNum = 0;
    public $errStr = '';
    public $transactionId = 0;
    public $bookingId = 0;
    public $name, $adminId, $id, $totalPrice, $transactionDate, $bookBy, $bookerPhone, $checkIn, $checkOut, $bookQty, $roomIdArr, $priceArr, $breakfastArr, $dinnerArr, $lunchArr, $breakArr, $roomStatus, $paymentId;

//-----------------------------------------GET--------------------------------------

    public function getRtypeWithCount()
    {
        $db = Yii::$app->db;
        $sql = "
                SELECT 
                    R.NAME,
                    COUNT(R.NAME) AS AVB 
                FROM 
                    HIZ_MEETING_RTYPE R 
                LEFT JOIN 
                    HIZ_MEETING_ROOM H ON R.ID = H.RTYPE_ID 
                WHERE 
                    R.STATUS = 1 
                    AND H.STATUS = 1
                    AND H.ROOM_STATUS = 'available' 
                GROUP BY 
                    NAME";
        $st = $db->createCommand($sql);
        $method = $st->queryAll();

        return $method;
    }

    public function getRtypeAvbInFloor()
    {
        $db = Yii::$app->db;
        $sql = "
                SELECT 
                    F.NAME AS FLOOR_NAME, 
                    R.NAME AS NAME, 
                    COUNT(R.NAME) AS ROOM_AVB,
                    R.FACILITY_NAME,
                    R.FACILITY_ID,
                    P.ID AS PRICE_ID,
                    P.REGULAR_PRICE,
                    P.HOLIDAY_PRICE,
                    P.BREAK_PRICE,
                    P.BREAKFAST_PRICE,
                    P.LUNCH_PRICE,
                    P.DINNER_PRICE
                FROM 
                    HIZ_MEETING_FLOOR F 
                LEFT JOIN 
                    HIZ_MEETING_ROOM H ON F.ID = H.FLOOR_ID 
                LEFT JOIN 
                    HIZ_MEETING_RTYPE R ON H.RTYPE_ID = R.ID
                LEFT JOIN
                    HIZ_MEETING_PRICE P ON R.ID = P.RTYPE_ID 
                WHERE 
                    F.STATUS = 1 
                    AND H.STATUS = 1 
                    AND H.ROOM_STATUS = 'available'
                GROUP BY 
                    F.NAME, 
                    R.NAME,
                    F.FLOOR_LEVEL,
                    R.FACILITY_NAME,
                    R.FACILITY_ID,
                    P.ID,
                    P.REGULAR_PRICE,
                    P.HOLIDAY_PRICE,
                    P.BREAK_PRICE,
                    P.BREAKFAST_PRICE,
                    P.LUNCH_PRICE,
                    P.DINNER_PRICE
                ORDER BY 
                    F.FLOOR_LEVEL";
        $st = $db->createCommand($sql);
        $method = $st->queryAll();

        return $method;
    }

    public function getRoomInFloorWithStatus()
    {
        $db = Yii::$app->db;
        $sql = "
                SELECT 
                    F.ID, 
                    F.NAME,
                    F.FLOOR_LEVEL, 
                    F.FLOOR_ROW, 
                    F.FLOOR_COLUMN, 
                    F.QTY,
                    LISTAGG ( H.ID, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS ROOM_ID,
                    LISTAGG ( H.ROOM_NAME, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS ROOM,
                    LISTAGG ( H.RTYPE_NAME, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS RTYPE_SELECT,
                    LISTAGG ( H.ROOM_MAP, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS ROOM_MAP,
                    LISTAGG ( H.ROOM_STATUS, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS ROOM_STATUS,
                    LISTAGG ( H.RTYPE_ID, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS RTYPE_SELECT_ID
                FROM 
                    HIZ_MEETING_FLOOR F
                LEFT JOIN
                    HIZ_MEETING_ROOM H ON F.ID = H.FLOOR_ID
                WHERE 
                    F.STATUS = 1 
                    AND H.STATUS = 1
                GROUP BY
                    F.ID, 
                    F.NAME,
                    F.FLOOR_LEVEL, 
                    F.FLOOR_ROW, 
                    F.FLOOR_COLUMN, 
                    F.QTY
                ORDER BY
                    F.FLOOR_LEVEL";
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

    public function getRtypeFacility()
    {
        $db = Yii::$app->db;
        $sql = "     
                SELECT 
                    ID, 
                    NAME, 
                    FACILITY_NAME 
                FROM 
                    HIZ_MEETING_RTYPE 
                WHERE 
                    STATUS = 1
                ORDER BY 
                    NAME";
        $st = $db->createCommand($sql);
        $method = $st->queryAll();

        return $method;
    }

    public function getTransactionFullDetailed()
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
                    LISTAGG ( D.BOOK_BREAK , ',' ) WITHIN GROUP (ORDER BY D.ROOM_ID ) AS BREAK_QTY,
                    LISTAGG ( D.BOOK_BREAKFAST, ',' ) WITHIN GROUP (ORDER BY D.ROOM_ID ) AS BREAKFAST_QTY,
                    LISTAGG ( D.BOOK_LUNCH, ',' ) WITHIN GROUP (ORDER BY D.ROOM_ID ) AS LUNCH_QTY,
                    LISTAGG ( D.BOOK_DINNER, ',' ) WITHIN GROUP (ORDER BY D.ROOM_ID ) AS DINNER_QTY,
                    LISTAGG ( D.PRICE, ',' ) WITHIN GROUP (ORDER BY D.ROOM_ID ) AS ROOM_PRICE
                FROM
                    HIZ_MEETING_TRANSACTION T
                    LEFT JOIN HIZ_MEETING_BOOK B ON T.ID = B.TRANSACTION_ID
                    LEFT JOIN HIZ_MEETING_BOOKDETAIL D ON B.ID = D.BOOK_ID
                    LEFT JOIN HIZ_MEETING_ROOM R ON D.ROOM_ID = R.ID
                    LEFT JOIN HIZ_HOTEL_FLOOR F ON R.FLOOR_ID = F.ID
                    LEFT JOIN HIZ_MEETING_RTYPE RT ON R.RTYPE_ID = RT.ID
                    LEFT JOIN HIZ_HOTEL_PAYMETHOD P ON T.PAYMENT_ID = P.ID
                WHERE 
                    T.STATUS = 1
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

//-----------------------------------------ADD--------------------------------------
  
    public function addBooking()
    {
        //transaction
            $db = Yii::$app->db;
            $sql = "
                    BEGIN
                        sp_hiz_meeting_trans_insert
                        (
                            out_code		            => :outCode,
                            out_msg			            => :outMsg,
                            out_id			            => :transactionId,
                            in_transaction_date         => :transactionDate,
                            in_payment_id               => :paymentId,
                            in_total_price              => :totalPrice,
                            in_create_by 	            => :adminId
                        );
                    END;    
            ";
            $st = $db->createCommand($sql);
            $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
            $st->bindParam(':transactionId', $this->transactionId, PDO::PARAM_INT, 3);
            $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
            $st->bindParam(':transactionDate', $this->transactionDate);
            $st->bindParam(':paymentId', $this->paymentId);
            $st->bindParam(':totalPrice', $this->totalPrice);
            $st->bindParam(':adminId', $this->adminId);
            // die($st->getRawSql());
            $tr = $db->beginTransaction();
            $st->execute();
            if ($this->errNum == '0') 
            {
                $tr->commit();// bisa ganti rollback()
            }
            else
            {
                $tr->rollback();// bisa ganti rollback()
                return [
                    'errNum' => $this->errNum,
                    'errStr' => $this->errStr
                ];
            }
        
        //booking
            $db = Yii::$app->db;
            $sql = "
                    BEGIN
                        sp_hiz_meeting_booking_insert
                        (
                            out_code		            => :outCode,
                            out_msg			            => :outMsg,
                            out_id			            => :bookingId,
                            in_transaction_id			=> :transactionId,
                            in_book_by                  => :bookBy,
                            in_booker_phone             => :bookerPhone,
                            in_check_in                 => :checkIn,
                            in_check_out                => :checkOut,
                            in_book_qty                 => :bookQty,
                            in_create_by 	            => :adminId
                        );
                    END;    
            ";
            $st = $db->createCommand($sql);
            $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
            $st->bindParam(':bookingId', $this->bookingId, PDO::PARAM_INT, 3);
            $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
            $st->bindParam(':transactionId', $this->transactionId);
            $st->bindParam(':bookBy', $this->bookBy);
            $st->bindParam(':bookerPhone', $this->bookerPhone);
            $st->bindParam(':checkIn', $this->checkIn);
            $st->bindParam(':checkOut', $this->checkOut);
            $st->bindParam(':bookQty', $this->bookQty);
            $st->bindParam(':adminId', $this->adminId);
            // die($st->getRawSql());
            $tr = $db->beginTransaction();
            $st->execute();
            if ($this->errNum == '0') 
            {
                $tr->commit();// bisa ganti rollback()
            }
            else
            {
                $tr->rollback();// bisa ganti rollback()
                return [
                    'errNum' => $this->errNum,
                    'errStr' => $this->errStr
                ];
            }
        
        //booking detail + update status room
            for ($i=0; $i < sizeof($this->roomIdArr) ; $i++) 
            {
                $db = Yii::$app->db;
                $sql = "
                        BEGIN
                            sp_hiz_meeting_bookdet_insert
                            (
                                out_code		            => :outCode,
                                out_msg			            => :outMsg,
                                in_book_id			        => :bookingId,
                                in_room_id                  => :roomId,
                                in_book_dinner              => :dinner,
                                in_book_lunch               => :lunch,
                                in_book_break               => :break,
                                in_book_breakfast           => :breakfast,
                                in_price                    => :price,
                                in_create_by 	            => :adminId
                            );
                        END;    
                ";
                $st = $db->createCommand($sql);
                $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
                $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
                $st->bindParam(':bookingId', $this->bookingId);
                $st->bindParam(':roomId', $this->roomIdArr[$i]);
                $st->bindParam(':dinner', $this->dinnerArr[$i]);
                $st->bindParam(':lunch', $this->lunchArr[$i]);
                $st->bindParam(':break', $this->breakArr[$i]);
                $st->bindParam(':breakfast', $this->breakfastArr[$i]);
                $st->bindParam(':price', $this->priceArr[$i]);
                $st->bindParam(':adminId', $this->adminId);
                // die($st->getRawSql());
                $tr = $db->beginTransaction();
                $st->execute();
                if ($this->errNum == '0') 
                {
                    $tr->commit();// bisa ganti rollback()
                }
                else
                {
                    $tr->rollback();// bisa ganti rollback()
                    return [
                        'errNum' => $this->errNum,
                        'errStr' => $this->errStr
                    ];
                }

                $db = Yii::$app->db;
                $sql = "
                        BEGIN
                            sp_hiz_meeting_room_updBooked
                            (
                                out_code		            => :outCode,
                                out_msg			            => :outMsg,
                                in_id			            => :roomId,
                                in_room_status              => :roomStatus,
                                in_admin_id 	            => :adminId
                            );
                        END;    
                ";
                $st = $db->createCommand($sql);
                $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
                $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
                $st->bindParam(':roomId', $this->roomIdArr[$i]);
                $st->bindParam(':roomStatus', $this->roomStatus);
                $st->bindParam(':adminId', $this->adminId);
                // die($st->getRawSql());
                $tr = $db->beginTransaction();
                $st->execute();
                if ($this->errNum == '0') 
                {
                    $tr->commit();// bisa ganti rollback()
                }
                else
                {
                    $tr->rollback();// bisa ganti rollback()
                    return [
                        'errNum' => $this->errNum,
                        'errStr' => $this->errStr
                    ];
                }
            }

        return [
            'errNum' => $this->errNum,
            'errStr' => $this->errStr
        ];
    }

//------------------------------------------UPDATE--------------------------------------

    public function bookingStatusUpdate()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_meeting_booking_update
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_id			            => :bookingId,
                        in_transaction_id           => :transactionId,
                        in_admin_id 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':bookingId', $this->bookingId);
        $st->bindParam(':transactionId', $this->transactionId);
        $st->bindParam(':adminId', $this->adminId);
        // die($st->getRawSql());
        $tr = $db->beginTransaction();
        $st->execute();
        if ($this->errNum == '0') 
        {
            $tr->commit();// bisa ganti rollback()
        }
        else
        {
            $tr->rollback();// bisa ganti rollback()
            return [
                'errNum' => $this->errNum,
                'errStr' => $this->errStr
            ];
        }

        for ($i=0; $i < sizeof($this->roomIdArr) ; $i++) 
        {
            $db = Yii::$app->db;
            $sql = "
                    BEGIN
                        sp_hiz_meeting_room_updateAvb
                        (
                            out_code		            => :outCode,
                            out_msg			            => :outMsg,
                            in_id			            => :roomId,
                            in_admin_id 	            => :adminId
                        );
                    END;    
            ";
            $st = $db->createCommand($sql);
            $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
            $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
            $st->bindParam(':roomId', $this->roomIdArr[$i]);
            $st->bindParam(':adminId', $this->adminId);
            // die($st->getRawSql());
            $tr = $db->beginTransaction();
            $st->execute();
            if ($this->errNum == '0') 
            {
                $tr->commit();// bisa ganti rollback()
            }
            else
            {
                $tr->rollback();// bisa ganti rollback()
                return [
                    'errNum' => $this->errNum,
                    'errStr' => $this->errStr
                ];
            }
        }

        return [
            'errNum' => $this->errNum,
            'errStr' => $this->errStr
        ];
    }

    public function bookingDelete()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_meeting_booking_delete
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_id			            => :bookingId,
                        in_transaction_id           => :transactionId,
                        in_admin_id 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':bookingId', $this->bookingId);
        $st->bindParam(':transactionId', $this->transactionId);
        $st->bindParam(':adminId', $this->adminId);
        // die($st->getRawSql());
        $tr = $db->beginTransaction();
        $st->execute();
        if ($this->errNum == '0') 
        {
            $tr->commit();// bisa ganti rollback()
        }
        else
        {
            $tr->rollback();// bisa ganti rollback()
            return [
                'errNum' => $this->errNum,
                'errStr' => $this->errStr
            ];
        }

        for ($i=0; $i < sizeof($this->roomIdArr) ; $i++) 
        {
            $db = Yii::$app->db;
            $sql = "
                    BEGIN
                        sp_hiz_meeting_room_updateAvb
                        (
                            out_code		            => :outCode,
                            out_msg			            => :outMsg,
                            in_id			            => :roomId,
                            in_admin_id 	            => :adminId
                        );
                    END;    
            ";
            $st = $db->createCommand($sql);
            $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
            $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
            $st->bindParam(':roomId', $this->roomIdArr[$i]);
            $st->bindParam(':adminId', $this->adminId);
            // die($st->getRawSql());
            $tr = $db->beginTransaction();
            $st->execute();
            if ($this->errNum == '0') 
            {
                $tr->commit();// bisa ganti rollback()
            }
            else
            {
                $tr->rollback();// bisa ganti rollback()
                return [
                    'errNum' => $this->errNum,
                    'errStr' => $this->errStr
                ];
            }
        }

        return [
            'errNum' => $this->errNum,
            'errStr' => $this->errStr
        ];
    }
}