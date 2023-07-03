<?php

namespace app\models;

use Yii;
use yii\base\Model;
use PDO;

class HotelLogin extends Model
{
    public $email, $password;

    public function rules()
    {
        return[
            // rule login
            [['email','password'], 'required', 'on' => ['scenarioLogin']],
            [['email','password'], 'string', 'length' => [1, 256], 'on' => ['scenarioLogin']],
            [['email'] , 'email' , 'on'  => ['scenarioLogin']],
        ];
    }

    public function verifyCredential()
    {
        $db = Yii::$app->db;
        $sql = "
                SELECT 
                    ID, 
                    EMAIL,
                    F_NAME, 
                    PASSWORD,
                    ADMIN_LEVEL
                FROM 
                    HIZ_HOTEL_USER
                WHERE 
                    UPPER(EMAIL) = UPPER(:email)
                    AND
                    STATUS = 1";
        $st = $db->createCommand($sql);
        $st->bindParam(':email', $this->email);
        $result = $st->queryAll();//queryOne, queryScalar
        return $result;
    }
}