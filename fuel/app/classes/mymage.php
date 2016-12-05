<?php
class Mymage{
	static function mageChangeQty($code=null,$qty=null){
		$mypid=time();
		// ATTENZIONE questa variabile deve essere aggiornata
		$script_path="/home/magazzinodemax/private/scripts/";	
		shell_exec(''.$script_path.'sincronizzazione-ecommerce.php '.$mypid.' '. $code.' '.$qty);    
	}
}
