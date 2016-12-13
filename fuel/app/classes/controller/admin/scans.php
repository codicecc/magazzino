<?php
class Controller_Admin_Scans extends Controller_Admin
{

	public function action_index()
	{
		//$data['scans'] = Model_Scan::find('all',array('order_by'=>array('updated_at'=>'desc')));
		$config = array(
			'pagination_url' => '/admin/scans',
			'total_items'    => Model_Scan::count(),
			'per_page'       => 10,
			//'uri_segment'    => 3,
			// or if you prefer pagination by query string
			'uri_segment'    => 'page',
		);
		
		// Create a pagination instance named 'mypagination'
		$pagination = Pagination::forge('mypagination', $config);
      
		$data['scans'] = Model_Scan::query()
			->order_by('created_at','desc')
			->rows_offset($pagination->offset)
			->rows_limit($pagination->per_page)
			->get();
        
		// we pass the object, it will be rendered when echo'd in the view
		$data['pagination'] = $pagination;
		
		$this->template->title = "Scans";
		$this->template->content = View::forge('admin/scans/index', $data);
		if(Input::get('phonescan'))$this->template->content = View::forge('admin/scans/result', $data);
	}

	public function action_view($id = null)	{
		$data['scan'] = Model_Scan::find($id);

		$this->template->title = "Scan";
		$this->template->content = View::forge('admin/scans/view', $data);

	}

	public function action_find(){
		$this->template->title = "Finding Scans";
		$this->template->content = "";
		$view = View::forge('admin/scans/find');
		$view->set_global('is_search',1);
  
		if (Input::method()){
			$code_id= Input::get('code_id');
			
			if(!empty($code_id)){
			
					Session::set_flash('success', "Finding: ".Model_Code::find($code_id)->code." - ".Model_Store::find(Model_Code::find($code_id)->store_id)->name." - Posizione: ".Model_Code::find($code_id)->position);			

					$where_array=array(array('id','>',0));
					if(!empty($code_id))array_push($where_array,array('code_id', $code_id));
								
					$data['scans'] = Model_Scan::query()
					->where($where_array)
					->get();

					$this->template->content = View::forge('admin/scans/find', $data);
				}
				else{
					Session::set_flash('error', "No Values!");
					Response::redirect('admin');
				}
		}
  }
	
	public function action_create()	{
		
		$view = View::forge('admin/scans/create');
				
		if (Input::method() == 'POST'){
			$val = Model_Scan::validate('create');

			if ($val->run()){
				$scan = Model_Scan::forge(array(
					'user_id' => Input::post('user_id'),
					'code_id' => Input::post('code_id'),
					'quantity' => Input::post('quantity'),
					'quantity_less' => Input::post('quantity_less')?1:0,
					'phonescan' => Input::post('phonescan'),
				));

				if ($scan and $scan->save()){
					
					$quantity_less="caricato";
					$position_str="<br />Posizione: <strong>".strtoupper($scan->code->position)."</strong>";
					
					if($scan->quantity_less>0):
						$quantity_less="scaricato";
						$position_str="";
					endif;
									
					$ecommerce_update=0;
					if(Model_Code::find($scan->code->id)->store['id']==2){
							$ecommerce_update=1;
							
							Mymage::mageChangeQty(Codes::getNewCode(Utilities::standardize2($scan->code->code)), quantities::quantity_by_code($scan->code_id));
					}
					
					$element=($scan->quantity>1)?"elementi":"elemento";
					$str='Hai '.$quantity_less.' '.$scan->quantity.' '.$element.' con codice '.$scan->code->code.' nel <br />magazzino:<strong>'.Model_Code::find($scan->code->id)->store['name'].'</strong>';
					$str.=$position_str;
					if($ecommerce_update==1)$str.="<br />E' stato aggiornato l'ecommerce, verifica <a href='/admin/tools/mageCheck#".utilities::standardize2($scan->code->code)."' target='_blank'>QUI</a>";

					Session::set_flash('success', $str . "<br />".e('Added code #'.$scan->id.'.'));
					Response::redirect('admin/scans?phonescan='.$scan->phonescan);
				}

				else
				{
					Session::set_flash('error', e('Could not save scan.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
				
		}
		$store_id=1;
		if(Input::get('store_id'))$store_id=Input::get('store_id');
		if(!empty(Input::get('code_id')))$store_id=Model_Code::find(Input::get('code_id'))->store['id'];
		$acode=$this->get_assoc_to_keyval(Input::get('code_id'),$store_id);		
		$view->set_global('users', Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));	
		$view->set_global('codes', Arr::assoc_to_keyval($acode,'id','code'));	
		$this->template->title = "Scans";
		$this->template->content = View::forge('admin/scans/create');

		if(Input::get('code_id')){
			if($this->code_check_status(Input::get('code_id'))==0){
				Session::set_flash('error', "Impossibile caricare il codice: ".Model_Code::find(Input::get('code_id'))->code.' - '.Model_Code::find(Input::get('code_id'))->store['name'].' - Posizione '.Model_Code::find(Input::get('code_id'))->position."");
				$this->template->title = "Il codice non è attivo!";
				$this->template->content = View::forge('admin/scans/empty');
			}
		}
	}
	
	private function code_name($code_id){
		return Model_Code::find(Input::get('code_id'))->code;
	}
	private function code_check_status($code_id){
		return count(Model_Code::find($code_id,array(
			'where' => array(
				array('active', 1),
			),)));
	}
	// Francesco Dattolo - gnucms - 160315
	private function get_assoc_to_keyval($code_id,$store_id){
		$where_array=array(array('active', 1));
		if(!empty($code_id))array_push($where_array,array('code', 'like', $this->code_name($code_id)));
		if(!empty($store_id))array_push($where_array,array('store_id',$store_id));
					
		$acode = Model_Code::query()
		->where($where_array)
		->order_by('position','asc')
		->get();
		
		$acode2=array();
		foreach ($acode as $item):
			array_push($acode2,array("code"=>Model_Store::find($item->store_id)->name." ".$item->code." posizione ".$item->position,"id"=>$item->id));
		endforeach;
		return $acode2;
	}

	public function action_edit($id = null){
		
		$view = View::forge('admin/scans/edit');
		
		$scan = Model_Scan::find($id);
		$val = Model_Scan::validate('edit');

		if ($val->run())
		{
			$scan->user_id = Input::post('user_id');
			$scan->code_id = Input::post('code_id');
			$scan->quantity = Input::post('quantity');
			$scan->quantity_less = Input::post('quantity_less');

			if ($scan->save())
			{
				Session::set_flash('success', e('Updated scan #' . $id));

				Response::redirect('admin/scans');
			}

			else
			{
				Session::set_flash('error', e('Could not update scan #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$scan->user_id = $val->validated('user_id');
				$scan->code_id = $val->validated('code_id');
				$scan->quantity = $val->validated('quantity');
				$scan->quantity_less = $val->validated('quantity_less');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('scan', $scan, false);
		}
		
		$store_id=1;
		if(Input::get('store_id'))$store_id=Input::get('store_id');
		if(!empty(Input::get('code_id')))$store_id=Model_Code::find(Input::get('code_id'))->store['id'];
		$acode=$this->get_assoc_to_keyval(Input::get('code_id'),$store_id);		
		
		$view->set_global('users', Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));
    //$view->set_global('codes', Arr::assoc_to_keyval(Model_Code::find('all'), 'id', 'code'));
    $view->set_global('codes', Arr::assoc_to_keyval($acode, 'id', 'code'));
    
		$this->template->title = "Scans";
		$this->template->content = View::forge('admin/scans/edit');

	}

	public function action_delete($id = null)
	{
		if ($scan = Model_Scan::find($id))
		{
			$scan->delete();

			Session::set_flash('success', e('Deleted scan #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete scan #'.$id));
		}

		Response::redirect('admin/scans');

	}

}
