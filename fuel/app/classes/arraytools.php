<?php
class arraytools{
	static function asearch($a, $searchvalue) {
	   foreach($a as $label => $value) {
	   	 if(Utilities::standardize2($label)==Utilities::standardize2($searchvalue)){
	   	 	 return $value;
	   	 }
	   }
	   return 0 ;
  }
  static function asearch_value($a, $searchvalue) {
	   foreach($a as $label => $value) {
	   	 if(Utilities::standardize2($value)==Utilities::standardize2($searchvalue)){
	   	 	 return $value;
	   	 }
	   }
	   return 0 ;
  }
}
?>
