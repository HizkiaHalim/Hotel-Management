<?php

namespace app\models;

use Yii;
use yii\base\Model;
use PDO;

class HotelFacility extends Model
{
    public $errNum = 0;
    public $errStr = '';
    public $name, $adminId, $id;

    public function rules()
    {
        return[
            // rule add facility
            [['name','adminId'], 'required', 'on' => ['scenarioAddFacility']],
            [['name'], 'string', 'length' => [1, 256], 'on' => ['scenarioAddFacility']],
            // rule edit facility
            [['name', 'adminId', 'id'], 'required', 'on' => ['scenarioEditFacility']],
            [['name'], 'string', 'length' => [1, 256], 'on' => ['scenarioEditFacility']],
            // rule delete facility
            [['adminId', 'id'], 'required', 'on' => ['scenarioDeleteFacility']]
        ];
    }

//-----------------------------------------GET FACILITY--------------------------------------

    public function getFacility()
    {
        $db = Yii::$app->db;
        $sql = "
                SELECT
                    ID,
                    NAME
                FROM 
                    HIZ_HOTEL_FACILITY
                WHERE 
                    status = 1
                ORDER BY
                    ID";
        $st = $db->createCommand($sql);
        $method = $st->queryAll();

        return $method;
    }

//-----------------------------------------ADD FACILITY--------------------------------------

    public function addFacility()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_facility_insert
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

//-----------------------------------------EDIT FACILITY--------------------------------------

    public function editFacility()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_facility_update
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

//-----------------------------------------DELETE FACILITY--------------------------------------

    public function deleteFacility()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_facility_delete
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