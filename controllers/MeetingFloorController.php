<?php

namespace app\controllers;

use Yii;
use app\extensions\HotelExtController;
use app\models\MeetingFloor;
use app\models\MeetingRtype;
use yii\web\UploadedFile;

class MeetingFloorController extends HotelExtController
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

    public function actionImageUpload()
    {
        $image = UploadedFile::getInstanceByName('image');
        $destinationPath = Yii::getAlias('@webroot/images/') . $_FILES["image"]["name"];
        $image->saveAs($destinationPath);
    }
//  ---------------------------------------- REDIRECT ----------------------------------------

    public function actionFloor()
    {
        $floor = new MeetingFloor();
        $resRoom = $floor->getFloorRoom();
        $resAll = $floor->getFloorAll();
        $rtype = new MeetingRtype();
        $resRtypeList = $rtype->getRtype();
        $this->layout = 'layoutUser';
        return $this->render('@app/views/meeting/floor.php', [
            'adminId' => Yii::$app->session['adminId'],
            'floorListRoom' => json_encode($resRoom),
            'floorListAll' => json_encode($resAll),
            'rtypeList' => json_encode($resRtypeList)
        ]);
    }

//  ---------------------------------------- ADD FLOOR ----------------------------------------

    public function actionAddFloor()
    {
        $name = Yii::$app->request->getBodyParam("name");
        $level = Yii::$app->request->getBodyParam("level");
        $row = Yii::$app->request->getBodyParam("row");
        $column = Yii::$app->request->getBodyParam("column");
        $rtypeIdArr = Yii::$app->request->getBodyParam("rtypeIdArr");
        $rtypeNameArr = Yii::$app->request->getBodyParam("rtypeNameArr");
        $qty = Yii::$app->request->getBodyParam("qty");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $floor = new MeetingFloor();
        $floor->name = $name;
        $floor->level = $level;
        $floor->row = $row;
        $floor->column = $column;
        $floor->rtypeIdArr = $rtypeIdArr;
        $floor->rtypeNameArr = $rtypeNameArr;
        $floor->qty = $qty;
        $floor->adminId = $adminId;
        $floor->scenario = 'scenarioAddFloor';

        if ($floor->validate()) 
        {
            $res =  $floor->addFloor();
            return json_encode($res);
        }
        else
        {
            return json_encode($floor->errors);
        }
    }

//  ---------------------------------------- EDIT FLOOR ----------------------------------------

    public function actionEditFloor()
    {
        $id = Yii::$app->request->getBodyParam("id");
        $name = Yii::$app->request->getBodyParam("name");
        $level = Yii::$app->request->getBodyParam("level");
        $row = Yii::$app->request->getBodyParam("row");
        $column = Yii::$app->request->getBodyParam("column");
        $rtypeIdArr = Yii::$app->request->getBodyParam("rtypeIdArr");
        $rtypeNameArr = Yii::$app->request->getBodyParam("rtypeNameArr");
        $qty = Yii::$app->request->getBodyParam("qty");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $floor = new MeetingFloor();
        $floor->id = $id;
        $floor->name = $name;
        $floor->level = $level;
        $floor->row = $row;
        $floor->column = $column;
        $floor->rtypeIdArr = $rtypeIdArr;
        $floor->rtypeNameArr = $rtypeNameArr;
        $floor->qty = $qty;
        $floor->adminId = $adminId;

        if ($floor->validate()) 
        {
            $res =  $floor->editFloor();
            return json_encode($res);
        }
        else
        {
            return json_encode($floor->errors);
        }
    }

//  ---------------------------------------- DELETE FLOOR ----------------------------------------

    public function actionRemoveFloor()
    {
        $id = Yii::$app->request->getBodyParam("id");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $floor = new MeetingFloor();
        $floor->id = $id;
        $floor->adminId = $adminId;

        if ($floor->validate()) 
        {
            $res =  $floor->removeFloor();
            return json_encode($res);
        }
        else
        {
            return json_encode($floor->errors);
        }
    }

//  ---------------------------------------- ADD ROOM ----------------------------------------

    public function actionAddRoom()
    {
        $floorId = Yii::$app->request->getBodyParam("floorId");
        $rtypeId = Yii::$app->request->getBodyParam("rtypeId");
        $rtypeName = Yii::$app->request->getBodyParam("rtypeName");
        $name = Yii::$app->request->getBodyParam("name");
        $capacity = Yii::$app->request->getBodyParam("capacity");
        $tableQty = Yii::$app->request->getBodyParam("tableQty");
        $chairQty = Yii::$app->request->getBodyParam("chairQty");
        $map = Yii::$app->request->getBodyParam("map");
        $status = Yii::$app->request->getBodyParam("status");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $floor = new MeetingFloor();
        $floor->floorId = $floorId;
        $floor->rtypeId = $rtypeId;
        $floor->rtypeName = $rtypeName;
        $floor->name = $name;
        $floor->capacity = $capacity;
        $floor->tableQty = $tableQty;
        $floor->chairQty = $chairQty;
        $floor->map = $map;
        $floor->status = $status;
        $floor->adminId = $adminId;
        $floor->scenario = 'scenarioAddRoom';

        if ($floor->validate()) 
        {
            $res =  $floor->addRoom();
            return json_encode($res);
        }
        else
        {
            return json_encode($floor->errors);
        }
    }

//  ---------------------------------------- REMOVE ROOM ----------------------------------------

    public function actionRemoveRoom()
    {
        $id = Yii::$app->request->getBodyParam("id");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $floor = new MeetingFloor();
        $floor->id = $id;
        $floor->adminId = $adminId;

        if ($floor->validate()) 
        {
            $res =  $floor->removeRoom();
            return json_encode($res);
        }
        else
        {
            return json_encode($floor->errors);
        }
    }

//  ---------------------------------------- EDIT ROOM ----------------------------------------

    public function actionEditRoom()
    {
        $roomId = Yii::$app->request->getBodyParam("roomId");
        $floorId = Yii::$app->request->getBodyParam("floorId");
        $rtypeId = Yii::$app->request->getBodyParam("rtypeId");
        $rtypeName = Yii::$app->request->getBodyParam("rtypeName");
        $name = Yii::$app->request->getBodyParam("name");
        $capacity = Yii::$app->request->getBodyParam("capacity");
        $tableQty = Yii::$app->request->getBodyParam("tableQty");
        $chairQty = Yii::$app->request->getBodyParam("chairQty");
        $map = Yii::$app->request->getBodyParam("map");
        $status = Yii::$app->request->getBodyParam("status");
        $adminId = Yii::$app->request->getBodyParam("adminId");

        $floor = new MeetingFloor();
        $floor->roomId = $roomId;
        $floor->floorId = $floorId;
        $floor->rtypeId = $rtypeId;
        $floor->rtypeName = $rtypeName;
        $floor->capacity = $capacity;
        $floor->tableQty = $tableQty;
        $floor->chairQty = $chairQty;
        $floor->name = $name;
        $floor->map = $map;
        $floor->status = $status;
        $floor->adminId = $adminId;

        if ($floor->validate()) 
        {
            $res =  $floor->editRoom();
            return json_encode($res);
        }
        else
        {
            return json_encode($floor->errors);
        }
    }
}