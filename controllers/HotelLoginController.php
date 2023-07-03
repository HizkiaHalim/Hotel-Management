<?php

namespace app\controllers;

use Yii;
use app\extensions\HotelExtController;
use app\models\HotelLogin;

class HotelLoginController extends HotelExtController
{
    public function beforeAction($event)
    {
        $lang = Yii::$app->session['lang'];
        if(!$this->checkSessionGuest())
        {
            $this->destroySession();
            $this->redirectToLogin();
        }
        $this->setStatusGuest('Guest', 0, $lang);
        
        return parent::beforeAction($event);
    }

//  ---------------------------------------- REDIRECT ----------------------------------------

    public function actionLogin()
    {
        $this->layout = 'layoutGuest';
        return $this->render('@app/views/hotel/login.php', [
            'adminId' => Yii::$app->session['adminId']
        ]);
    }

// ------------------------------------------ GET ---------------------------------------------
    
    public function actionVerifyLogin()
    {
        $email = Yii::$app->request->getBodyParam("email");
        $password = Yii::$app->request->getBodyParam("password");
        $login = new HotelLogin();
        $login->email = $email;
        $login->scenario = 'scenarioLogin';
        $verifyCredential = json_encode($login->verifyCredential());
        if ($verifyCredential != '[]') 
        {
            $res = json_decode($verifyCredential);
            $verification = password_verify($password, $res[0]->PASSWORD);
            if ($verification == 1) 
            {
                $this->destroySession();
                $this->setStatusAdmin($res[0]->ADMIN_LEVEL, $res[0]->ID, $res[0]->F_NAME, 'eng');
                return 0;
            }
            else
            {
                return 1;
            }
        }
        else 
        {
            return 1;
        }

    }
}