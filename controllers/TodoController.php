<?php

namespace app\controllers;

// use Yii;
use yii\rest\ActiveController;

class TodoController extends ActiveController {
	public $modelClass = 'app\models\Todo';
	
	public function actions() {
		$actions = parent::actions();
		unset($actions['create']);
		// unset($actions['test']);
		return $actions;
	}
	
	public function actionCreate() {
		echo 'this is custom creatse';
		print_r(Yii::$app->request-post());
		exit;
	}
	public function actionTest() {
		echo 'test';
		return 0;
	}
	
	public function actionIndex() {
		echo 'index';
	}
	
}
?>