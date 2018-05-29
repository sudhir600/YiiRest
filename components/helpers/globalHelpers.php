<?php

namespace app\components\helpers;
// keep namespace, class and file name same like "components"


use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class globalHelpers { 
	public static function abc() { 
		return '123456'; 
	} 
	public function hi(){
	  return 'hi';
	}
	public function Hello(){
		return "<br />Hello Yii2! this is helper called.<br />";
	}
}