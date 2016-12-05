<?php
class Codes{
	static function checkCode($code){
		if(strlen($code)<5){
			if(strtolower(substr($code,0,1)=="E"||strtolower(substr($code,0,1)=="C"))){
					return true;
			}
		}
		return false;
	}
	static function getNewCode($code){
		$ccode=substr($code,0,1);
		switch ($ccode) {
			case 'C':
				$ccode="204";
				break;
			case 'E':
				$ccode="203";
				break;
    }
		$ncode=substr($code,1);
		$ncode="00".$ncode;
		$ncode=substr($ncode,strlen($ncode)-3,3);
		return $ccode.$ncode;
	}
}
