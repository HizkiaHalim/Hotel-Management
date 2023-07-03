<?php

namespace app\models;

use Yii;
use yii\base\Model;
use PDO;

class MeetingRtype extends Model
{
    public $errNum = 0;
    public $outRtypeId = 0;
    public $errStr = '';
    public $name, $adminId, $facilityName, $facilityId, $floorId, $floorName, $id;

    public function rules()
    {
        return[
            // rule edit rtype
            [['name','adminId', 'id'], 'required', 'on' => ['scenarioEditRtype']],
            [['name'], 'string', 'length' => [1, 256], 'on' => ['scenarioEditRtype']],
            // rule add rtype
            [['name', 'adminId'], 'required', 'on' => ['scenarioAddRtype']],
            [['name'], 'string', 'length' => [1, 256], 'on' => ['scenarioAddRtype']],
        ];
    }

//-----------------------------------------ADD RTYPE--------------------------------------

    public function addRtype()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_meeting_rtype_insert
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        out_rtype_id			    => :outRtypeId,
                        in_name                     => :name,
                        in_facility_id              => :facilityId,
                        in_facility_name            => :facilityName,
                        in_create_by 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outRtypeId', $this->outRtypeId, PDO::PARAM_INT, 5);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':name', $this->name);
        $st->bindParam(':facilityId', $this->facilityId);
        $st->bindParam(':facilityName', $this->facilityName);
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
            'outRtypeId' => $this->outRtypeId,
            'errStr' => $this->errStr
        ];
    }

//-----------------------------------------EDIT RTYPE--------------------------------------

    public function editRtype()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_meeting_rtype_update
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_id                       => :id,
                        in_name                     => :name,
                        in_facility_id              => :facilityId,
                        in_facility_name            => :facilityName,
                        in_admin_id 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':name', $this->name);
        $st->bindParam(':facilityId', $this->facilityId);
        $st->bindParam(':facilityName', $this->facilityName);
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

    public function deleteRtype()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_meeting_rtype_delete
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

//-----------------------------------------GET RTYPE--------------------------------------

    public function getRtype()
    {
        $db = Yii::$app->db;
        $sql = "
                SELECT 
                    R.ID,
                    R.NAME,
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
                    HIZ_MEETING_RTYPE R
                LEFT JOIN
                    HIZ_MEETING_PRICE P ON R.ID = P.RTYPE_ID 
                WHERE 
                    R.STATUS = 1
                ORDER BY
                    R.ID";
        $st = $db->createCommand($sql);
        $result = $st->queryAll();//queryOne, queryScalar
        return $result;
    }

}