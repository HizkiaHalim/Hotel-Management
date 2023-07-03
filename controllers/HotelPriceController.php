<?php

namespace app\controllers;

use Yii;
use app\extensions\HotelExtController;
use app\models\HotelPrice;
use app\models\HotelRtype;

class HotelPriceController extends HotelExtController
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
        $price = new HotelPrice();
        $resPrice = $price->getPrice();
        $rtype = new HotelRtype();
        $resRtype = $rtype->getRtype();
        $this->layout = 'layoutUser';
        return $this->render('@app/views/hotel/price.php', [
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
        $extrabedPrice = Yii::$app->request->getBodyParam("extrabedPrice");
        $breakfastPrice = Yii::$app->request->getBodyParam("breakfastPrice");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $price = new HotelPrice();
        $price->rtypeId = $rtypeId;
        $price->regularPrice = $regularPrice;
        $price->holidayPrice = $holidayPrice;
        $price->extrabedPrice = $extrabedPrice;
        $price->breakfastPrice = $breakfastPrice;
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
        $extrabedPrice = Yii::$app->request->getBodyParam("extrabedPrice");
        $breakfastPrice = Yii::$app->request->getBodyParam("breakfastPrice");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $price = new HotelPrice();
        $price->id = $id;
        $price->rtypeId = $rtypeId;
        $price->regularPrice = $regularPrice;
        $price->holidayPrice = $holidayPrice;
        $price->extrabedPrice = $extrabedPrice;
        $price->breakfastPrice = $breakfastPrice;
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
        $price = new HotelPrice();
        $price->id = $id;
        $price->adminId = $adminId;
        $res =  $price->deletePrice();
        return json_encode($res);
    }
}