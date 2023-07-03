<?php

namespace app\models;

use Yii;
use yii\base\Model;
use PDO;

class HotelFloor extends Model
{
    public $errNum = 0;
    public $errStr = '';
    public $name, $level, $qty, $adminId, $column, $row, $id, $rtypeId, $rtypeName, $status, $rtypeIdArr, $rtypeNameArr, $nameArr, $roomId, $floorId;

    public function rules()
    {
        return[
            // rule room
            [['floorId', 'rtypeId', 'rtypeName', 'name', 'status', 'adminId'], 'required', 'on' => ['scenarioAddRoom']],
            [['name'], 'string', 'length' => [1, 256], 'on' => ['scenarioAddRoom']],
            // rule add
            [['name', 'level', 'qty', 'row', 'column'], 'required', 'on' => ['scenarioAddFloor']],
            [['name'], 'string', 'length' => [1, 256], 'on' => ['scenarioAddFloor']],
        ];

    }

//-----------------------------------------ADD FLOOR--------------------------------------

    public function addFloor()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_floor_insert
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_name                     => :name,
                        in_floor_level              => :level,
                        in_qty                      => :qty,
                        in_rtype_id                 => :rtypeid,
                        in_rtype_name               => :rtypename,
                        in_floor_row                => :row,
                        in_floor_column             => :column,
                        in_admin_id 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':name', $this->name);
        $st->bindParam(':level', $this->level);
        $st->bindParam(':qty', $this->qty);
        $st->bindParam(':rtypeid', $this->rtypeIdArr);
        $st->bindParam(':rtypename', $this->rtypeNameArr);
        $st->bindParam(':row', $this->row);
        $st->bindParam(':column', $this->column);
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

//-----------------------------------------EDIT FLOOR--------------------------------------

    public function editFloor()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_floor_update
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_id                       => :id,
                        in_name                     => :name,
                        in_floor_level              => :floor_level,
                        in_floor_row                => :row,
                        in_floor_column             => :column,
                        in_rtype_id                 => :rtypeid,
                        in_rtype_name               => :rtypename,
                        in_qty                      => :qty,
                        in_admin_id 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':name', $this->name);
        $st->bindParam(':floor_level', $this->level);
        $st->bindParam(':row', $this->row);
        $st->bindParam(':column', $this->column);
        $st->bindParam(':rtypeid', $this->rtypeIdArr);
        $st->bindParam(':rtypename', $this->rtypeNameArr);
        $st->bindParam(':qty', $this->qty);
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

//-----------------------------------------DELETE FLOOR--------------------------------------

    public function removeFloor()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_floor_delete
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
                    sp_hiz_hotel_room_clear
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_floor_id                 => :id,
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
            return [
                'errNum' => $this->errNum,
                'errStr' => $this->errStr
            ];
        }

        
        
        return [
            'errNum' => $this->errNum,
            'errStr' => $this->errStr
        ];
    }

//-----------------------------------------GET FLOOR--------------------------------------
    
    public function getFloorRoom()
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
                    LISTAGG ( H.ROOM_NAME, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS ROOM,
                    LISTAGG ( H.RTYPE_NAME, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS RTYPE_SELECT,
                    LISTAGG ( H.ROOM_STATUS, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS ROOM_STATUS,
                    LISTAGG ( H.RTYPE_ID, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS RTYPE_SELECT_ID
                FROM 
                    HIZ_HOTEL_FLOOR F
                LEFT JOIN
                    HIZ_HOTEL_ROOM H ON F.ID = H.FLOOR_ID
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
                    F.ID";
        $st = $db->createCommand($sql);
        $result = $st->queryAll();//queryOne, queryScalar
        return $result;
    }

    public function getFloorRtype()
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
                    LISTAGG ( R.NAME, ',' ) WITHIN GROUP (ORDER BY R.ID ) AS ROOM_TYPE, 
                    LISTAGG ( R.ID, ',' ) WITHIN GROUP (ORDER BY R.ID ) AS RTYPE_ID 
                FROM 
                    HIZ_HOTEL_FLOOR F
                LEFT JOIN
                    HIZ_HOTEL_RTYPE R ON F.RTYPE_ID = R.ID
                WHERE 
                    F.STATUS = 1 AND R.STATUS = 1
                GROUP BY
                    F.ID, 
                    F.NAME,
                    F.FLOOR_LEVEL, 
                    F.FLOOR_ROW, 
                    F.FLOOR_COLUMN, 
                    F.QTY
                ORDER BY
                    F.ID";
        $st = $db->createCommand($sql);
        $result = $st->queryAll();//queryOne, queryScalar
        return $result;
    }
    
    public function getFloorAll()
    {
        $db = Yii::$app->db;
        $sql = "
                SELECT 
                    F.ID,
                    F.NAME,
                    F.FLOOR_LEVEL, 
                    F.FLOOR_ROW, 
                    F.FLOOR_COLUMN,
                    F.RTYPE_ID,
                    F.RTYPE_NAME, 
                    F.QTY,
                    LISTAGG ( H.ID, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS ROOM_ID,
                    LISTAGG ( H.ROOM_NAME, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS ROOM,
                    LISTAGG ( H.RTYPE_NAME, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS RTYPE_SELECT,
                    LISTAGG ( H.ROOM_STATUS, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS ROOM_STATUS,
                    LISTAGG ( H.RTYPE_ID, ',' ) WITHIN GROUP (ORDER BY H.ROOM_NAME ) AS RTYPE_SELECT_ID
                FROM 
                    HIZ_HOTEL_FLOOR F
                LEFT JOIN
                    HIZ_HOTEL_ROOM H ON F.ID = H.FLOOR_ID
                WHERE 
                    F.STATUS = 1
                GROUP BY
                    F.ID,
                    F.NAME,
                    F.FLOOR_LEVEL, 
                    F.FLOOR_ROW, 
                    F.RTYPE_ID,
                    F.RTYPE_NAME,   
                    F.FLOOR_COLUMN, 
                    F.QTY";
        $st = $db->createCommand($sql);
        $result = $st->queryAll();//queryOne, queryScalar
        return $result;
    }

//-----------------------------------------ADD ROOM--------------------------------------
    
    public function addRoom()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_room_insert
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_floor_id                 => :floorId,
                        in_rtype_id                 => :rtypeId,
                        in_room_name                => :name,
                        in_room_status              => :status,
                        in_rtype_name               => :rtypeName,
                        in_create_by 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':floorId', $this->floorId);
        $st->bindParam(':rtypeId', $this->rtypeId);
        $st->bindParam(':name', $this->name);
        $st->bindParam(':status', $this->status);
        $st->bindParam(':rtypeName', $this->rtypeName);
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

//-----------------------------------------REMOVE ROOM--------------------------------------
    
    public function removeRoom()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_room_delete
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

//-----------------------------------------EDIT ROOM--------------------------------------

    public function editRoom()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_room_update
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_id                       => :roomId,
                        in_floor_id                 => :floorId,
                        in_rtype_id                 => :rtypeId,
                        in_room_name                => :name,
                        in_room_status              => :status,
                        in_rtype_name               => :rtypeName,
                        in_admin_id 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':roomId', $this->roomId);
        $st->bindParam(':floorId', $this->floorId);
        $st->bindParam(':rtypeId', $this->rtypeId);
        $st->bindParam(':name', $this->name);
        $st->bindParam(':status', $this->status);
        $st->bindParam(':rtypeName', $this->rtypeName);
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