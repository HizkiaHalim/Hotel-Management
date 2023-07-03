<?php

namespace app\controllers;

use Yii;
use app\extensions\HotelExtController;
use app\models\HotelBooking;
use app\models\HotelReport;
use app\models\HotelRtype;

class HotelReportController extends HotelExtController
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

    public function actionReport()
    {
        $report = new HotelReport();
        $resTrans = $report->getTransaction();
        $book = new HotelBooking();
        $resfacility = $book->getRtypeFacility();
        $respaymeth = $book->getPaymentMethod();
        $rtype = new HotelRtype();
        $resRtype = $rtype->getRtype();
        $this->layout = 'layoutUser';
        return $this->render('@app/views/hotel/report.php', [
            'adminId' => Yii::$app->session['adminId'],
            'transList' => json_encode($resTrans),
            'rtypeFacility' => json_encode($resfacility),
            'paymentMethod' => json_encode($respaymeth),
            'rtypeWithPrice' => json_encode($resRtype),
        ]);
    }
}