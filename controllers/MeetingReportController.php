<?php

namespace app\controllers;

use Yii;
use app\extensions\HotelExtController;
use app\models\MeetingBooking;
use app\models\MeetingReport;
use app\models\MeetingRtype;

class MeetingReportController extends HotelExtController
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
        $report = new MeetingReport();
        $resTrans = $report->getTransaction();
        $book = new MeetingBooking();
        $resfacility = $book->getRtypeFacility();
        $respaymeth = $book->getPaymentMethod();
        $rtype = new MeetingRtype();
        $resRtype = $rtype->getRtype();
        $this->layout = 'layoutUser';
        return $this->render('@app/views/meeting/report.php', [
            'adminId' => Yii::$app->session['adminId'],
            'transList' => json_encode($resTrans),
            'rtypeFacility' => json_encode($resfacility),
            'paymentMethod' => json_encode($respaymeth),
            'rtypeWithPrice' => json_encode($resRtype),
        ]);
    }
}