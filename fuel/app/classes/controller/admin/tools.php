<?php
class Controller_Admin_Tools extends Controller_Admin{
	
	private $host="localhost";
	private $db="demax";
	private $user="demax";
	private $password="Agenda2016";
	private $magento_path="/home/magazzinodemax/private/ecommerce/app/Mage.php";
	private $script_path="/home/magazzinodemax/private/scripts/";
	
	private $acommerce2=array();
	private $amagazzino2=array();
	
	public function action_index(){

		$data['codes']=[];
        		
		$this->template->title = "Strumenti";
		$this->template->content = View::forge('admin/tools/index', $data);
		$view = View::forge('admin/tools/index');
	}
	
	public function action_mageCheck(){
		$mypid=time();
		shell_exec(''.$this->script_path.'verifica-stato-sincronizzazione-ecommerce.php '.$mypid);
		  
    $result = DB::select()->from('commands')->where('PID', '=', $mypid)->execute();
    
    $data['ecommerce']=Format::forge($result[0]["options"], 'json')->to_array();
    
    $data['codes']=$this->magazzinoCollection();
    
		$this->template->title = "Verifica stato sincronizzazione ecommerce";
		$this->template->content = View::forge('admin/verifica-stato-sincronizzazione-ecommerce/index', $data);
		$view = View::forge('admin/verifica-stato-sincronizzazione-ecommerce/index');

	} 

	public function aecommerce_init(){
		$mypid=time();
		shell_exec(''.$this->script_path.'verifica-stato-sincronizzazione-ecommerce.php '.$mypid);
		  
    $result = DB::select()->from('commands')->where('PID', '=', $mypid)->execute();
    
    $aecommerce0=Format::forge($result[0]["options"], 'json')->to_array();
    $acommerce=array();
    foreach ($aecommerce0 as $label=>$value):
			array_push($acommerce,strtoupper(str_replace(" ","",$label)));
		endforeach;
		
		$this->acommerce2=$acommerce;
	}
  private function aecommerce_check(){
  	$result=array();
		foreach($this->acommerce2 as $label=>$value):
			$fields=Arraytools::asearch_value($this->amagazzino2,$value);
			if($fields===0)array_push($result,$value	);
		endforeach;
		return $result;
  }
  
	public function amagazzino_init(){    		
    $acodes0=$this->magazzinoCollection();
		$amagazzino=array();
		foreach ($acodes0 as $item): 
			array_push($amagazzino,strtoupper(str_replace(" ","",$item->code)));
		endforeach;
		$this->amagazzino2=$amagazzino;
	}
	
	private function amagazzino_check(){	
		$result=array();
		foreach($this->amagazzino2 as $label=>$value):
			$fields=Arraytools::asearch_value($this->acommerce2,$value);
			if($fields===0)array_push($result,$value);
		endforeach;
		return $result;
	}
	
	public function action_mage_sync_ecommerce_zero_qty(){
		$this->aecommerce_init();
		$this->amagazzino_init();
		$result=$this->aecommerce_check();	
		$s="";
		foreach ($result as $item):
			$s.=utilities::standardize2($item).',0|';
    endforeach;
    
    $mypid=time();
    shell_exec(''.$this->script_path.'sincronizzazione-ecommerce-tutto-magazzino.php '.$mypid.' "'. $s.'"');
			
		Session::set_flash('success', "Modifica elaborata");
		Response::redirect('admin/tools/mageCheck_ecommerce_magazzino/1');
	}
	
	public function action_mageCheck_ecommerce_magazzino($mc){
	
		$this->aecommerce_init();
		$this->amagazzino_init();
					
		if($mc==1):
			$result=$this->aecommerce_check();
			$data['subtitle']="Codici presenti in Ecommerce ma non presenti in magazzino(Prodotto Finito)";
			$data['mc']=1;
		endif;
			
		if($mc==2):
			$result=$this->amagazzino_check();
			$data['subtitle']="Codici presenti in Magazzino(Prodotto Finito) ma non presenti in Ecommerce";
			$data['mc']=2;
		endif;
		
		$data['result']=$result;
		$this->template->title = "Verifica stato sincronizzazione ecommerce - magazzino";
		$this->template->content = View::forge('admin/verifica-stato-sincronizzazione-ecommerce-magazzino/index', $data);
		$view = View::forge('admin/verifica-stato-sincronizzazione-ecommerce-magazzino/index');
	}	
	public function action_mageChangeQty($code=null,$qty=null){
		/*
		Session::set_flash('error', "Funzionalità in sviluppo!");
		Response::redirect('admin/tools/');
		die();
		*/
		$mypid=time();
		shell_exec(''.$this->script_path.'sincronizzazione-ecommerce.php '.$mypid.' '. $code.' '.$qty);    
    $data=[];
		Session::set_flash('success', "Modifica elaborata per: <a href=\"/admin/tools/mageCheck#".utilities::standardize2($code)."\">".$code."</a>");
		Response::redirect('admin/tools/mageCheck#'.utilities::standardize2($code));
	}
	public function action_mageAllChangeQty(){
		$mypid=time();
		$codes=$this->magazzinoCollection();
		$s="";
		foreach ($codes as $item):
			$s.=utilities::standardize2($item->code).','.Quantities::quantity_by_code($item->id).'|';
    endforeach;

    shell_exec(''.$this->script_path.'sincronizzazione-ecommerce-tutto-magazzino.php '.$mypid.' "'. $s.'"');
			
    /*
		echo "<pre>";
		var_dump($s);
		echo "</pre>";
		
		die();
    */
		Session::set_flash('success', "Modifica elaborata");
		Response::redirect('admin/tools/mageCheck');
	}
	
	private function magazzinoCollection(){
		$store_id=2;	
		$query = Model_Code::query();
		if($store_id)$query->where("store_id",$store_id);
		$query->group_by('code')
					->order_by('code');
						
		$data['codes']=$query->get();
		return $data['codes'];
	}
}
