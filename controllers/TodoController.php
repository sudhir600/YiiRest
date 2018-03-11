<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\rest\ActiveController;
use app\models\Todo;
// use yii\db\ActiveRecord;

class TodoController extends ActiveController {
	public $modelClass = 'app\models\Todo';
	/* 
	public function beforeAction($action)
	{
		// use yii\web\Response; (add this namespace above)
		// \Yii::$app->response->format = Response::FORMAT_JSON;
		// return parent::beforeAction($action);
	} 
	*/
	public function actions() {
		$actions = parent::actions();
		unset($actions['create']);
		unset($actions['index']);
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
		/*
		Yii::$app->db->createCommand()->insert...
		Yii::$app->db->createCommand()->batchInsert...
		Yii::$app->db->createCommand()->update...
		Yii::$app->db->createCommand()->delete...
		Yii::$app->db->createCommand()->upsert... either insert or update if exits
		*/
		// update name for record 2
		 // use excute for non returting query
		$remark = 'this remark was set from PHP excute 4th time';
		// Yii::$app->db->createCommand('UPDATE todo SET remark = "'.$remark.'" WHERE id=2')->execute();
		// Yii::$app->db->createCommand()->update('todo', ['remark' => $remark, 'status' => 5], 'id = 2 and user = "Nehagupta"')->execute();
		Yii::$app->db->createCommand()->update('todo', ['remark' => $remark, 'status' => 5], 'status = 3')->execute();
		Yii::$app->db->createCommand()->delete('todo', 'id = 6')->execute();
		$posts = Yii::$app->db->createCommand('SELECT * FROM todo')->queryAll();
		print_r(json_encode($posts));	
	}
	
}
?>