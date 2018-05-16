<?php

namespace app\components\genUtils;
// keep namespace, class and file name same like "components"


use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class genUtils extends Component {
	
  public function getDates(){
    return  '<br />Get date called<br />';
  }
  
  public function buildJsonResponce(array $successData, array $errorData){
	$obj = array();
	$obj['responce'] = array('ack' => '', 'data' => array(''), 'error' => array('code' => '', 'msg' => '', 'moreInfo' => array()));

	if(empty($errorData)){
		$obj['responce']['ack'] = 'success';
		$obj['responce']['data'] = isset($successData) ? $successData : '';
	}

	if(!empty($errorData)){
		$obj['responce']['error']['code'] = isset($errorData['code']) ? $errorData['code'] : '';
		$obj['responce']['error']['msg'] = isset($errorData['msg']) ? $errorData['msg'] : '';
		$obj['responce']['error']['moreInfo'] = isset($errorData['moreInfo']) ? $errorData['moreInfo'] : '';
	}

	return json_encode($obj);	
  }
}
?>