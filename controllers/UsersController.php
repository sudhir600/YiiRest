<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;

class UsersController extends ActiveController
{
	public $modelClass = 'app\models\Users';
	public function actionUsers()
    {
        echo 'this is test<pre>';
		print_r($_SERVER['SERVER_ADDR']);
    }
}
