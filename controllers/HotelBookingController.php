<?php

namespace app\controllers;

use Yii;
use app\extensions\HotelExtController;
use app\models\HotelBooking;
use app\models\HotelFloor;
use app\models\HotelRtype;

class HotelBookingController extends HotelExtController
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

    public function actionBooking()
    {
        $book = new HotelBooking();
        $resrwc = $book->getRtypeWithCount();
        $resraif = $book->getRtypeAvbInFloor();
        $resrifws = $book->getRoomInFloorWithStatus();
        $respaymeth = $book->getPaymentMethod();
        $resfacility = $book->getRtypeFacility();
        $restfd = $book->getTransactionFullDetailed();
        $floor = new HotelFloor();
        $resfloorall = $floor->getFloorAll();
        $rtype = new HotelRtype();
        $resRtype = $rtype->getRtype();
        $this->layout = 'layoutUser';
        return $this->render('@app/views/hotel/booking.php', [
            'adminId' => Yii::$app->session['adminId'],
            'rtypeWithCountList' => json_encode($resrwc),
            'rtypeAvbInFloor' => json_encode($resraif),
            'roomInFloorWithStatus' => json_encode($resrifws),
            'floorListAll' => json_encode($resfloorall),
            'paymentMethod' => json_encode($respaymeth),
            'rtypeWithPrice' => json_encode($resRtype),
            'rtypeFacility' => json_encode($resfacility),
            'bookingAll' => json_encode($restfd),
        ]);
    }

//  ---------------------------------------- ADD BOOKING ----------------------------------------

    public function actionBookingAdd()
    {
        //transaction
        $totalPrice = Yii::$app->request->getBodyParam("totalPrice");
        $transactionDate = Yii::$app->request->getBodyParam("transactionDate");
        $paymentId = Yii::$app->request->getBodyParam("paymentId");
        //book
        $bookBy = Yii::$app->request->getBodyParam("bookBy");
        $bookerPhone = Yii::$app->request->getBodyParam("bookerPhone");
        $checkIn = Yii::$app->request->getBodyParam("checkIn");
        $checkOut = Yii::$app->request->getBodyParam("checkOut");
        $bookQty = Yii::$app->request->getBodyParam("bookQty");
        //book detail
        $roomIdArr = Yii::$app->request->getBodyParam("roomIdArr");
        $priceArr = Yii::$app->request->getBodyParam("priceArr");
        $breakfastArr = Yii::$app->request->getBodyParam("breakfastArr");
        $extrabedArr = Yii::$app->request->getBodyParam("extrabedArr");
        //room status
        $roomStatus = Yii::$app->request->getBodyParam("roomStatus");
        //admin
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $booking = new HotelBooking();
        $booking->totalPrice = $totalPrice;
        $booking->transactionDate = $transactionDate;
        $booking->paymentId = $paymentId;
        $booking->bookBy = $bookBy;
        $booking->bookerPhone = $bookerPhone;
        $booking->checkIn = $checkIn;
        $booking->checkOut = $checkOut;
        $booking->bookQty = $bookQty;
        $booking->roomIdArr = $roomIdArr;
        $booking->priceArr = $priceArr;
        $booking->breakfastArr = $breakfastArr;
        $booking->extrabedArr = $extrabedArr;
        $booking->roomStatus = $roomStatus;
        $booking->adminId = $adminId;
        // $booking->scenario = 'scenarioAddBooking';

        $res =  $booking->addBooking();
        return json_encode($res);
    }

//  ---------------------------------------- UPDATE BOOKING ----------------------------------------

    public function actionBookingStatusUpdate()
    {
        //transaction
        $transactionId = Yii::$app->request->getBodyParam("transactionId");
        //book
        $bookingId = Yii::$app->request->getBodyParam("bookId");
        //room
        $roomIdArr = Yii::$app->request->getBodyParam("roomId");
        //admin
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $booking = new HotelBooking();
        $booking->transactionId = $transactionId;
        $booking->bookingId = $bookingId;
        $booking->roomIdArr = $roomIdArr;
        $booking->adminId = $adminId;

        $res =  $booking->bookingStatusUpdate();
        return json_encode($res);
    }

    public function actionBookingDelete()
    {
        //transaction
        $transactionId = Yii::$app->request->getBodyParam("transactionId");
        //book
        $bookingId = Yii::$app->request->getBodyParam("bookId");
        //room
        $roomIdArr = Yii::$app->request->getBodyParam("roomId");
        //admin
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $booking = new HotelBooking();
        $booking->transactionId = $transactionId;
        $booking->bookingId = $bookingId;
        $booking->roomIdArr = $roomIdArr;
        $booking->adminId = $adminId;

        $res =  $booking->bookingDelete();
        return json_encode($res);
    }

}