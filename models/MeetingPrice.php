<?php

namespace app\models;

use Yii;
use yii\base\Model;
use PDO;

class MeetingPrice extends Model
{
    public $errNum = 0;
    public $errStr = '';
    public $rtypeId, $regularPrice, $holidayPrice, $breakPrice, $breakfastPrice, $lunchPrice, $dinnerPrice, $adminId, $id;

    public function rules()
    {
        return[
            // rule edit
            [['id', 'rtypeId', 'regularPrice', 'holidayPrice', 'breakPrice', 'breakfastPrice', 'lunchPrice', 'dinnerPrice', 'adminId'], 'required', 'on' => ['scenarioEditPrice']],
            // rule add
            [['rtypeId', 'regularPrice', 'holidayPrice', 'breakPrice', 'breakfastPrice', 'lunchPrice', 'dinnerPrice', 'adminId'], 'required', 'on' => ['scenarioAddPrice']]
        ];

    }

//  ---------------------------------------- ADD PRICE ----------------------------------------

    public function addPrice()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_meeting_price_insert
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_rtype_id                 => :rtypeId,
                        in_regular_price            => :regularPrice,
                        in_holiday_price            => :holidayPrice,
                        in_break_price              => :breakPrice,
                        in_breakfast_price          => :breakfastPrice,
                        in_lunch_price              => :lunchPrice,
                        in_dinner_price             => :dinnerPrice,
                        in_admin_id 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':rtypeId', $this->rtypeId);
        $st->bindParam(':regularPrice', $this->regularPrice);
        $st->bindParam(':holidayPrice', $this->holidayPrice);
        $st->bindParam(':breakPrice', $this->breakPrice);
        $st->bindParam(':breakfastPrice', $this->breakfastPrice);
        $st->bindParam(':lunchPrice', $this->lunchPrice);
        $st->bindParam(':dinnerPrice', $this->dinnerPrice);
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
        }
        
        return [
            'errNum' => $this->errNum,
            'errStr' => $this->errStr
        ];
    }

//  ---------------------------------------- EDIT PRICE ----------------------------------------

    public function editPrice()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_meeting_price_update
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_id                       => :id,
                        in_rtype_id                 => :rtypeId,
                        in_regular_price            => :regularPrice,
                        in_holiday_price            => :holidayPrice,
                        in_break_price              => :breakPrice,
                        in_breakfast_price          => :breakfastPrice,
                        in_lunch_price              => :lunchPrice,
                        in_dinner_price             => :dinnerPrice,
                        in_admin_id 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':rtypeId', $this->rtypeId);
        $st->bindParam(':regularPrice', $this->regularPrice);
        $st->bindParam(':holidayPrice', $this->holidayPrice);
        $st->bindParam(':breakPrice', $this->breakPrice);
        $st->bindParam(':breakfastPrice', $this->breakfastPrice);
        $st->bindParam(':lunchPrice', $this->lunchPrice);
        $st->bindParam(':dinnerPrice', $this->dinnerPrice);
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
        }
        
        return [
            'errNum' => $this->errNum,
            'errStr' => $this->errStr
        ];
    }

    public function deletePrice()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_meeting_price_delete
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_id                       => :id,
                        in_admin_id 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':adminId', $this->adminId);
        $tr = $db->beginTransaction();
        $st->execute();

        if ($this->errNum == '0') 
        {
            $tr->commit();// bisa ganti rollback()
        }
        else
        {
            $tr->rollback();// bisa ganti rollback()
        }
        
        return [
            'errNum' => $this->errNum,
            'errStr' => $this->errStr
        ];
    }

//  ---------------------------------------- GET PRICE ----------------------------------------

    public function getPrice()
    {
        $db = Yii::$app->db;
        $sql = "
                SELECT
                    P.ID,
                    P.RTYPE_ID,
                    P.REGULAR_PRICE,
                    P.HOLIDAY_PRICE,
                    P.BREAK_PRICE,
                    P.BREAKFAST_PRICE,
                    P.LUNCH_PRICE,
                    P.DINNER_PRICE,
                    R.NAME AS ROOM_TYPE
                FROM 
                    HIZ_MEETING_PRICE P
                LEFT JOIN 
                    HIZ_MEETING_RTYPE R ON P.RTYPE_ID = R.ID
                WHERE 
                    P.status = 1
                ORDER BY
                    R.NAME";
        $st = $db->createCommand($sql);
        $price = $st->queryAll();

        return $price;
    }
}