<?php

namespace app\controllers;

use Yii;
use app\extensions\HotelExtController;
use app\models\HotelPaymethod;

class HotelPaymethodController extends HotelExtController
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

    public function actionPaymethod()
    {
        $user = new HotelPaymethod();
        $res =  $user->getPaymethod();
        $this->layout = 'layoutUser';
        return $this->render('@app/views/hotel/paymethod.php', [
            'adminId' => Yii::$app->session['adminId'],
            'adminLevel' => Yii::$app->session['sessionStatus'],
            'paymethod' => json_encode($res)
        ]);
    }

//  ---------------------------------------- ADD USER ----------------------------------------

    public function actionAddPaymethod()
    {
        $name = Yii::$app->request->getBodyParam("name");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $paymethod = new HotelPaymethod();
        $paymethod->name = $name;
        $paymethod->adminId = $adminId;
        $paymethod->scenario = 'scenarioAddPaymethod';

        if ($paymethod->validate()) 
        {
            $res =  $paymethod->addPaymethod();
            return json_encode($res);
        }
        else
        {
            return json_encode($paymethod->errors);
        }
    }

//  ---------------------------------------- EDIT USER ----------------------------------------

    public function actionEditPaymethod()
    {
        $id = Yii::$app->request->getBodyParam("id");
        $name = Yii::$app->request->getBodyParam("name");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $paymethod = new HotelPaymethod();
        $paymethod->id = $id;
        $paymethod->name = $name;
        $paymethod->adminId = $adminId;
        $paymethod->scenario = 'scenarioEditPaymethod';

        if ($paymethod->validate()) 
        {
            $res =  $paymethod->editPaymethod();
            return json_encode($res);
        }
        else
        {
            return json_encode($paymethod->errors);
        }
    }

//  ---------------------------------------- DELETE USER ----------------------------------------

    public function actionDeletePaymethod()
    {
        $id = Yii::$app->request->getBodyParam("id");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $paymethod = new HotelPaymethod();
        $paymethod->id = $id;
        $paymethod->adminId = $adminId;
        $paymethod->scenario = 'scenarioDeletePaymethod';

        if ($paymethod->validate()) 
        {
            $res =  $paymethod->deletePaymethod();
            return json_encode($res);
        }
        else
        {
            return json_encode($paymethod->errors);
        }
    }
}