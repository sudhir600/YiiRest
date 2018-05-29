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
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			$error = [];
			$username =  isset($_POST['username']) ? $_POST['username'] : null;
			$password =  isset($_POST['password']) ? md5($_POST['password']) : null;
			$data = array();
			$error = array();
			
			if($username == null || empty($username)){
				$error['msg'] = 'username can\'t be empty';
				$error['code'] = 'e001';
			} else if($password == null || empty($password)){
				$error['msg'] = 'password can\'t be empty';
				$error['code'] = 'e002';
			}
			$checkUser = 0;
			$dbResponce = Yii::$app->db->createCommand('SELECT * FROM users where username = "' . $username . '" and password  ="' . $password . '"')->queryOne();
			print_r($dbResponce);
			if(is_array($dbResponce) && count($dbResponce) > 0) {
				$checkUser = true;
				$userId = $dbResponce['id'];
				$userName = $dbResponce['username'];
				$userIp = Yii::$app->gUtils->getIP();
				$tokenLength = 30;
				$tokenKey = Yii::$app->gUtils->createToken($userId, $tokenLength);
				$shareSessionKey = Yii::$app->gUtils->generateShareSessionId($userId);
				Yii::$app->db->createCommand()->insert('token', [
																  'user_id' => $userId,
																  'token_key' => $tokenKey,
																  'ip_address' => $userIp,
																  'share_session' => $shareSessionKey
																]
													   )->execute();
				$data =  array('userId'=>$userId, 'userName' => $userName, 'tokenKey'=>$tokenKey);
			} else {
				$error = array('code' => 200, 'msg' => 'Bad username / password combination', 'moreInfo'=> 'details infomation is saved in errorlog');
			}
		} else{
			$data = array();
			$error = array('code' => 001, 'msg' => 'Method should be POST.', 'moreInfo'=> 'Method \''.$_SERVER['REQUEST_METHOD'] . '\' is not allowed to perform this action.');
			// echo 'Method should be POST.';
		}
		$util = Yii::$app->gUtils->buildJsonResponce($data, $error);
		print_r($util);
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