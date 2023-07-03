<?php

namespace app\controllers;

use Yii;
use app\extensions\HotelExtController;
use app\models\MeetingPrice;
use app\models\MeetingRtype;

class MeetingPriceController extends HotelExtController
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

    public function actionPrice()
    {
        $price = new MeetingPrice();
        $resPrice = $price->getPrice();
        $rtype = new MeetingRtype();
        $resRtype = $rtype->getRtype();
        $this->layout = 'layoutUser';
        return $this->render('@app/views/meeting/price.php', [
            'adminId' => Yii::$app->session['adminId'],
            'rtypeList' => json_encode($resRtype),
            'priceList' => json_encode($resPrice),
        ]);
    }

//  ---------------------------------------- ADD PRICE ----------------------------------------

    public function actionAddPrice()
    {
        $rtypeId = Yii::$app->request->getBodyParam("rtypeId");
        $regularPrice = Yii::$app->request->getBodyParam("regularPrice");
        $holidayPrice = Yii::$app->request->getBodyParam("holidayPrice");
        $breakPrice = Yii::$app->request->getBodyParam("breakPrice");
        $breakfastPrice = Yii::$app->request->getBodyParam("breakfastPrice");
        $lunchPrice = Yii::$app->request->getBodyParam("lunchPrice");
        $dinnerPrice = Yii::$app->request->getBodyParam("dinnerPrice");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $price = new MeetingPrice();
        $price->rtypeId = $rtypeId;
        $price->regularPrice = $regularPrice;
        $price->holidayPrice = $holidayPrice;
        $price->breakPrice = $breakPrice;
        $price->breakfastPrice = $breakfastPrice;
        $price->lunchPrice = $lunchPrice;
        $price->dinnerPrice = $dinnerPrice;
        $price->adminId = $adminId;
        $price->scenario = 'scenarioAddPrice';

        if ($price->validate()) 
        {
            $res =  $price->addPrice();
            return json_encode($res);
        }
        else
        {
            return json_encode($price->errors);
        }
    }

//  ---------------------------------------- EDIT PRICE ----------------------------------------

    public function actionEditPrice()
    {
        $id = Yii::$app->request->getBodyParam("id");
        $rtypeId = Yii::$app->request->getBodyParam("rtypeId");
        $regularPrice = Yii::$app->request->getBodyParam("regularPrice");
        $holidayPrice = Yii::$app->request->getBodyParam("holidayPrice");
        $breakPrice = Yii::$app->request->getBodyParam("breakPrice");
        $breakfastPrice = Yii::$app->request->getBodyParam("breakfastPrice");
        $lunchPrice = Yii::$app->request->getBodyParam("lunchPrice");
        $dinnerPrice = Yii::$app->request->getBodyParam("dinnerPrice");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $price = new MeetingPrice();
        $price->id = $id;
        $price->rtypeId = $rtypeId;
        $price->regularPrice = $regularPrice;
        $price->holidayPrice = $holidayPrice;
        $price->breakPrice = $breakPrice;
        $price->breakfastPrice = $breakfastPrice;
        $price->lunchPrice = $lunchPrice;
        $price->dinnerPrice = $dinnerPrice;
        $price->adminId = $adminId;
        $price->scenario = 'scenarioEditPrice';

        if ($price->validate()) 
        {
            $res =  $price->editPrice();
            return json_encode($res);
        }
        else
        {
            return json_encode($price->errors);
        }
    }

    public function actionDeletePrice()
    {
        $id = Yii::$app->request->getBodyParam("id");
        $adminId = Yii::$app->request->getBodyParam("adminId");
        $price = new MeetingPrice();
        $price->id = $id;
        $price->adminId = $adminId;
        $res =  $price->deletePrice();
        return json_encode($res);
    }
}