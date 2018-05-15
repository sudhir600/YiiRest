<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
// use yii\web\NotFoundHttpException;
//use app\models\Session;
//use yii\web\Controller;
use yii\rest\ActiveController;

class SessionController extends ActiveController {
	
	public $modelClass = 'app\models\Session';

	protected function verbs() {
	   $verbs = parent::verbs();
	    $verbs =  [
			'index' => ['GET', 'POST', 'HEAD'],
			'view' => ['GET', 'HEAD'],
			'create' => ['POST'],
			'update' => ['PUT', 'PATCH'],
			'anyOtherAction' => ['DELETE'],
		];
	   //$verbs['index'] = ['POST', 'GET']; //methods you need in action
	   return $verbs;
	}
	public function init() {
        // echo "hello<br >";
    }
	public function actionHelper(){
		echo 'Yii::$app->gHelpers->hello() called - <br />';
		echo Yii::$app->gHelpers->hello();
	}
	public function actionUtility(){
		echo 'gUtils called - ';
		echo Yii::$app->gUtils->getDates();
	}
	public function actionIndex($params = array()) {
		// \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		// echo $_SERVER['REQUEST_METHOD'];
		echo '<pre>';
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$error = [];
			$username =  isset($_POST['username']);
			$password =  isset($_POST['password']);
			if($username == null || empty($username)){
				$error['msg'] = 'username can\'t be empty';
				$error['code'] = 'e001';
			} else if($password == null || empty($password)){
				$error['msg'] = 'password can\'t be empty';
				$error['code'] = 'e002';
			}
			print_r($_POST);
			print_r($error);
			echo '   ';
			// echo $_POST['username'];
			// echo $_POST['password'];
		} else{
			 echo 'Method should be post.';
		}
	}
		
	public function actions() {
		$actions = parent::actions();
		unset($actions['create']);
		unset($actions['index']);
		return $actions;
	}
	
	public function actionCreate() {
		echo 'this is custom create action';
		//print_r(Yii::$app->request-post());
		//exit;
	}
	public function actionTest() {
		echo 'test';
		return 0;
	}
}
?>