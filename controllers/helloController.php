<?php

namespace app\controllers;

use Yii;
//use yii\base\Model;
use yii\rest\ActiveController;
use yii\web\Controller;

class HelloController extends Controller {
	
	// Note - if you extend ActiveController, then you must overright thow methods, init and actions. 
	// so that modelClass not found error will resolved.
	
	/*
	public function init() {
        // do not remove this function
    }
	public function actions() {
        // do not remove this function
	}
	*/	
	
	public function actionIndex($params = array()) {
		$data =  array('msg' => 'Hello Guest.', 'api' => 'your api is running on the sky.');
		$error = array();
		$data = Yii::$app->gUtils->buildJsonResponce($data, $error);
		echo $data;
	}
		
}
?>