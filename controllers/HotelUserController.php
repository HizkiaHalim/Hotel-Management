<?php

namespace app\controllers;

use Yii;
use app\extensions\HotelExtController;
use app\models\HotelUser;

class HotelUserController extends HotelExtController
{
    public function beforeAction($event)
    {
        $lang = Yii::$app->session['lang'];
        if(!$this->checkSessionAdmin())
        {
            $this->destroySession();
            $this->redirectToLogin();
        }
        
        return parent::beforeAction($event);
    }

//  ---------------------------------------- REDIRECT ----------------------------------------

    public function actionUser()
    {
        $user = new HotelUser();
        $res =  $user->getUser();
        $this->layout = 'layoutUser';
        return $this->render('@app/views/hotel/user.php', [
            'adminId' => Yii::$app->session['adminId'],
            'adminLevel' => Yii::$app->session['sessionStatus'],
            'userList' => json_encode($res)
        ]);
    }

//  ---------------------------------------- ADD USER ----------------------------------------

    public function actionAddUser()
    {
        $fname = Yii::$app->request->getBodyParam("fname");
        $lname = Yii::$app->request->getBodyParam("lname");
        $email = Yii::$app->request->getBodyParam("email");
        $ktp = Yii::$app->request->getBodyParam("ktp");
        $phoneNum = Yii::$app->request->getBodyParam("phoneNum");
        $address = Yii::$app->request->getBodyParam("address");
        $password = Yii::$app->request->getBodyParam("password");
        $admin_level = Yii::$app->request->getBodyParam("admin_level");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $user = new HotelUser();
        $user->fname = $fname;
        $user->lname = $lname;
        $user->email = $email;
        $user->ktp = $ktp;
        $user->phoneNum = $phoneNum;
        $user->address = $address;
        $user->password = $password;
        $user->admin_level = $admin_level;
        $user->adminId = $adminId;
        $user->scenario = 'scenarioAddUser';

        $user->password = password_hash($password, PASSWORD_DEFAULT);

        if ($user->validate()) 
        {
            $res =  $user->addUser();
            return json_encode($res);
        }
        else
        {
            return json_encode($user->errors);
        }
    }

//  ---------------------------------------- EDIT USER ----------------------------------------

    public function actionEditUser()
    {
        $id = Yii::$app->request->getBodyParam("id");
        $fname = Yii::$app->request->getBodyParam("fname");
        $lname = Yii::$app->request->getBodyParam("lname");
        $email = Yii::$app->request->getBodyParam("email");
        $ktp = Yii::$app->request->getBodyParam("ktp");
        $phoneNum = Yii::$app->request->getBodyParam("phoneNum");
        $address = Yii::$app->request->getBodyParam("address");
        $password = Yii::$app->request->getBodyParam("password");
        $admin_level = Yii::$app->request->getBodyParam("admin_level");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $user = new HotelUser();
        $user->id = $id;
        $user->fname = $fname;
        $user->lname = $lname;
        $user->email = $email;
        $user->ktp = $ktp;
        $user->phoneNum = $phoneNum;
        $user->address = $address;
        $user->password = $password;
        $user->admin_level = $admin_level;
        $user->adminId = $adminId;
        $user->scenario = 'scenarioEditUser';

        $user->password = password_hash($password, PASSWORD_DEFAULT);


        if ($user->validate()) 
        {
            $res =  $user->editUser();
            return json_encode($res);
        }
        else
        {
            return json_encode($user->errors);
        }
    }

//  ---------------------------------------- DELETE USER ----------------------------------------

    public function actionDeleteUser()
    {
        $id = Yii::$app->request->getBodyParam("id");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $user = new HotelUser();
        $user->id = $id;
        $user->adminId = $adminId;

        if ($user->validate()) 
        {
            $res =  $user->deleteUser();
            return json_encode($res);
        }
        else
        {
            return json_encode($user->errors);
        }
    }

//  ---------------------------------------- SET LANGUAGE ----------------------------------------

    public function actionSetLang()
    {
        $lang = Yii::$app->request->getBodyParam("lang");
        $oldLang = Yii::$app->session['lang'];
        $this->setSessionLang($lang);
        if ($oldLang != $lang) 
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }
}