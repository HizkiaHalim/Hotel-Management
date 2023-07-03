<?php

namespace app\controllers;

use Yii;
use app\extensions\HotelExtController;
use app\models\MeetingFloor;
use app\models\MeetingRtype;
use app\models\MeetingFacility;

class MeetingRtypeController extends HotelExtController
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

    public function actionRtype()
    {
        $rtype = new MeetingRtype();
        $resRtype = $rtype->getRtype();
        $facility = new MeetingFacility();
        $resFacility = $facility->getFacility();
        $this->layout = 'layoutUser';
        return $this->render('@app/views/meeting/rtype.php', [
            'adminId' => Yii::$app->session['adminId'],
            'rtypeList' => json_encode($resRtype),
            'facilityList' => json_encode($resFacility)
        ]);
    }

//  ---------------------------------------- ADD RTYPE ----------------------------------------

    public function actionAddRtype()
    {
        $name = Yii::$app->request->getBodyParam("name");
        $facilityName = Yii::$app->request->getBodyParam("facilityName");
        $facilityId = Yii::$app->request->getBodyParam("facilityId");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $rtype = new MeetingRtype();
        $rtype->name = $name;
        $rtype->facilityName = $facilityName;
        $rtype->facilityId = $facilityId;
        $rtype->adminId = $adminId;
        $rtype->scenario = 'scenarioAddRtype';

        if ($rtype->validate()) 
        {
            $res =  $rtype->addRtype();
            return json_encode($res);
        }
        else
        {
            return json_encode($rtype->errors);
        }
    }

//  ---------------------------------------- EDIT RTYPE ----------------------------------------

    public function actionEditRtype()
    {
        $id = Yii::$app->request->getBodyParam("id");
        $name = Yii::$app->request->getBodyParam("name");
        $facilityName = Yii::$app->request->getBodyParam("facilityName");
        $facilityId = Yii::$app->request->getBodyParam("facilityId");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $rtype = new MeetingRtype();
        $rtype->id = $id;
        $rtype->name = $name;
        $rtype->facilityName = $facilityName;
        $rtype->facilityId = $facilityId;
        $rtype->adminId = $adminId;
        $rtype->scenario = 'scenarioEditRtype';

        if ($rtype->validate()) 
        {
            $res =  $rtype->editRtype();
            return json_encode($res);
        }
        else
        {
            return json_encode($rtype->errors);
        }
    }

    public function actionDeleteRtype()
    {
        $id = Yii::$app->request->getBodyParam("id");
        $adminId = Yii::$app->request->getBodyParam("adminId");
        $rtype = new MeetingRtype();
        $rtype->id = $id;
        $rtype->adminId = $adminId;
        $res =  $rtype->deleteRtype();
        return json_encode($res);
    }
}