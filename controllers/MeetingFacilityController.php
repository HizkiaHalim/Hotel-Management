<?php

namespace app\controllers;

use Yii;
use app\extensions\HotelExtController;
use app\models\MeetingFacility;

class MeetingFacilityController extends HotelExtController
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

    public function actionFacility()
    {
        $facility = new MeetingFacility();
        $res = $facility->getFacility();
        $this->layout = 'layoutUser';
        return $this->render('@app/views/meeting/facility.php', [
            'adminId' => Yii::$app->session['adminId'],
            'facilityList' => json_encode($res),
        ]);
    }

//  ---------------------------------------- ADD FACILITY ----------------------------------------

    public function actionAddFacility()
    {
        $name = Yii::$app->request->getBodyParam("name");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $facility = new MeetingFacility();
        $facility->name = $name;
        $facility->adminId = $adminId;
        $facility->scenario = 'scenarioAddFacility';

        if ($facility->validate()) 
        {
            $res =  $facility->addFacility();
            return json_encode($res);
        }
        else
        {
            return json_encode($facility->errors);
        }
    }

//  ---------------------------------------- EDIT FACILITY ----------------------------------------

    public function actionEditFacility()
    {
        $id = Yii::$app->request->getBodyParam("id");
        $name = Yii::$app->request->getBodyParam("name");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $facility = new MeetingFacility();
        $facility->id = $id;
        $facility->name = $name;
        $facility->adminId = $adminId;
        $facility->scenario = 'scenarioEditFacility';

        if ($facility->validate()) 
        {
            $res =  $facility->editFacility();
            return json_encode($res);
        }
        else
        {
            return json_encode($facility->errors);
        }
    }

//  ---------------------------------------- DELETE FACILITY ----------------------------------------

    public function actionDeleteFacility()
    {
        $id = Yii::$app->request->getBodyParam("id");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $facility = new MeetingFacility();
        $facility->id = $id;
        $facility->adminId = $adminId;
        $facility->scenario = 'scenarioDeleteFacility';

        if ($facility->validate()) 
        {
            $res =  $facility->deleteFacility();
            return json_encode($res);
        }
        else
        {
            return json_encode($facility->errors);
        }
    }
}