<?php

namespace app\models;

use Yii;
use yii\base\Model;
use PDO;

class HotelUser extends Model
{
    public $errNum = 0;
    public $errStr = '';
    public $outId = 0;
    public $fname, $lname, $email, $ktp, $phoneNum, $address, $password, $adminId, $admin_level, $id;

    public function rules()
    {
        return[
            // rule add user
            [['fname', 'lname', 'email', 'ktp', 'phoneNum', 'address', 'password', 'adminId', 'admin_level'], 'required', 'on' => ['scenarioAddUser']],
            [['fname', 'lname', 'address', 'email', 'password'], 'string', 'length' => [1, 256], 'on' => ['scenarioAddUser']],
            [['email'] , 'email' , 'on'  => ['scenarioAddUser']],
            // rule edit user
            [['id', 'fname', 'lname', 'email', 'ktp', 'phoneNum', 'address', 'password', 'adminId', 'admin_level'], 'required', 'on' => ['scenarioEditUser']],
            [['fname', 'lname', 'address', 'email', 'password'], 'string', 'length' => [1, 256], 'on' => ['scenarioEditUser']],
            [['email'] , 'email' , 'on'  => ['scenarioEditUser']],
        ];
    }

//-----------------------------------------ADD USER--------------------------------------
    
    public function addUser()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_user_insert
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        out_id			            => :outId,
                        in_f_name                   => :fname,
                        in_l_name                   => :lname,
                        in_identity_num             => :ktp,
                        in_email                    => :email,
                        in_password                 => :password,
                        in_phone_num                => :phoneNum,
                        in_address                  => :address,
                        in_admin_level              => :admin_level,
                        in_create_by 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':outId', $this->outId, PDO::PARAM_INT, 7);
        $st->bindParam(':fname', $this->fname);
        $st->bindParam(':lname', $this->lname);
        $st->bindParam(':ktp', $this->ktp);
        $st->bindParam(':email', $this->email);
        $st->bindParam(':phoneNum', $this->phoneNum);
        $st->bindParam(':password', $this->password);
        $st->bindParam(':address', $this->address);
        $st->bindParam(':admin_level', $this->admin_level);
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
            'outId' => $this->outId,
            'errNum' => $this->errNum,
            'errStr' => $this->errStr
        ];
    }

//-----------------------------------------GET USER--------------------------------------

    public function getUser()
    {
        $db = Yii::$app->db;
        $sql = "
                SELECT
                    ID,
                    F_NAME,
                    L_NAME,
                    IDENTITY_NUM,
                    EMAIL,
                    PASSWORD,
                    PHONE_NUM,
                    ADDRESS,
                    ADMIN_LEVEL
                FROM 
                    HIZ_HOTEL_USER 
                WHERE 
                    status = 1
                    AND ID != 3";
        $st = $db->createCommand($sql);
        $game = $st->queryAll();

        return $game;
    }

//-----------------------------------------EDIT USER-------------------------------------- 

    public function editUser()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_user_update
                    (
                        out_code		            => :outCode,
                        out_msg			            => :outMsg,
                        in_id			            => :id,
                        in_f_name                   => :fname,
                        in_l_name                   => :lname,
                        in_identity_num             => :ktp,
                        in_email                    => :email,
                        in_password                 => :password,
                        in_phone_num                => :phoneNum,
                        in_address                  => :address,
                        in_admin_level              => :admin_level,
                        in_admin_id 	            => :adminId
                    );
                END;    
        ";
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':fname', $this->fname);
        $st->bindParam(':lname', $this->lname);
        $st->bindParam(':ktp', $this->ktp);
        $st->bindParam(':email', $this->email);
        $st->bindParam(':phoneNum', $this->phoneNum);
        $st->bindParam(':password', $this->password);
        $st->bindParam(':address', $this->address);
        $st->bindParam(':admin_level', $this->admin_level);
        $st->bindParam(':adminId', $this->adminId);
        // die($st->getRawSql());
        $tr = $db->beginTransaction();
        $st->execute();
        // die(var_dump($this->errNum));

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

//-----------------------------------------DELETE USER-------------------------------------- 

    public function deleteUser()
    {
        $db = Yii::$app->db;
        $sql = "
                BEGIN
                    sp_hiz_hotel_user_delete
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