<?php

namespace app\models;

use Yii;
use yii\base\Model;
use PDO;

class HotelPaymethod extends Model
{
    public $errNum = 0;
    public $errStr = '';
    public $name, $adminId, $id;

    public function rules()
    {
        return[
            // rule add paymethod
            [['name','adminId'], 'required', 'on' => ['scenarioAddPaymethod']],
            [['name'], 'string', 'length' => [1, 256], 'on' => ['scenarioAddPaymethod']],
            // rule edit paymethod
            [['name', 'adminId', 'id'], 'required', 'on' => ['scenarioEditPaymethod']],
            [['name'], 'string', 'length' => [1, 256], 'on' => ['scenarioEditPaymethod']],
            // rule delete paymethod
            [['adminId', 'id'], 'required', 'on' => ['scenarioDeletePaymethod']]
        ];
    }

//-----------------------------------------GET PAYMETHOD--------------------------------------

    public function getPaymethod()
    {
        $db = Yii::$app->db;
        $sql = "
                SELECT
                    ID,
                    NAME
                FROM 
                    HIZ_HOTEL_PAYMETHOD
                WHERE 
                    status = 1";
        $st = $db->createCommand($sql);
        $method = $st->queryAll();

        return $method;
    }

//-----------------------------------------ADD PAYMETHOD--------------------------------------

    public function addPaymethod()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_paymethod_insert
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_name                     => :name,
                        in_create_by 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':name', $this->name);
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

//-----------------------------------------EDIT PAYMETHOD--------------------------------------

    public function editPaymethod()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_paymethod_update
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_id                       => :id,
                        in_name                     => :name,
                        in_admin_id 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':name', $this->name);
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

//-----------------------------------------DELETE PAYMETHOD--------------------------------------

    public function deletePaymethod()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_paymethod_delete
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_id			            => :id,
                        in_admin_id 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
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
}