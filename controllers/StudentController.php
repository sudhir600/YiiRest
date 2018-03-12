<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class StudentController extends Controller
{
public function actionCreateStudent() {
    
     // \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
      return 133;
	}
}
?>