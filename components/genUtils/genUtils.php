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
  
  public function createTokenx($userId){
	$randomNumber = $this->randomNumber();
	$ip  = $this->getIP();
	//sleep(1);
	$hash = date('Ymdhis'.$userId.$randomNumber.'_'.$ip);
	return md5($hash);
  }
  
  function randomNumberx(){
    $min = 0;
	$max = 9999;
	$count = 1;
	$range = array();
	$i = $min;
    while ($i++ < $count) {
        while(in_array($num = mt_rand($min, $max), $range));
        $range[] = $num;
    }
    return $range[0];
  }
  
  public function getIP($ip = null, $deep_detect = TRUE){
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    return $ip;
  }
  
  
	public function randomNumber($min, $max){
		$range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
	}

	public function createToken($cutomText = '', $length = 32){
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		for($i=0;$i<$length;$i++){
			$token .= $codeAlphabet[$this->randomNumber(0,strlen($codeAlphabet))];
		}
		return md5($cutomText.$token);
	}
	
	public function generateShareSessionId($customText = ''){
		$userIp 	= $this->getIP();
		$randomTxt 	= md5(date('Ymdhis'.$customText.'_'.$userIp));
		$tokenHash  = $this->createToken('shareSession_', 40);
		return $randomTxt.$tokenHash;
	}
}
?>