<?php

namespace app\extensions;

use Yii;
use yii\web\Controller;

class HotelExtController extends Controller
{
    public function init()
    {
        parent::init();
        Yii::$app->language = Yii::$app->session['lang'];
        
        return true;
    }

    public function beforeAction($event)
    {
        return parent::beforeAction($event);
    }

    public function redirectToLogin()
    {
        return $this->redirect(['hotel-login/login']);
    }

    public function checkSessionGuest()
    {
        $sessionStatus = Yii::$app->session['sessionStatus'];
        if ($sessionStatus == 'Guest') 
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function checkSessionAdmin()
    {
        $sessionStatus = Yii::$app->session['sessionStatus'];
        if ($sessionStatus == 'Admin' || $sessionStatus == 'SuperAdmin' ) 
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function setStatusGuest($status, $id, $lang)
    {
        $session = Yii::$app->session;
        $session->open();
        $session->set('sessionStatus', $status);
        $session->set('adminId', $id);
        $session->close();
        $this->setSessionLang($lang);
    }

    public function setStatusAdmin($status, $id, $username, $lang)
    {
        $session = Yii::$app->session;
        $session->open();
        $session->set('sessionStatus', $status);
        $session->set('adminId', $id);
        $session->set('username', $username);
        $session->close();
        $this->setSessionLang($lang);
    }

    public function destroySession()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->destroy();
        $session->close();
    }

    public function setSessionLang($lang)
    {
        $session = Yii::$app->session;
        $session->open();
        $session->set('lang', $lang);
        $session->close();
        Yii::$app->language = $lang;
    }
}