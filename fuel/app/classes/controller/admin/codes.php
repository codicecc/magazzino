<?php
class Controller_Admin_Codes extends Controller_Admin
{

	protected static $_belongs_to = array('store');
	
	public function action_index(){
		//$data['codes'] = Model_Code::find('all');
				$config = array(
			'pagination_url' => '/admin/codes',
			'total_items'    => Model_Code::count(),
			'per_page'       => 10,
			//'uri_segment'    => 3,
			// or if you prefer pagination by query string
			'uri_segment'    => 'page',
		);
		
		// Create a pagination instance named 'mypagination'
		$pagination = Pagination::forge('mypagination', $config);
      
		$data['codes'] = Model_Code::query()
			->rows_offset($pagination->offset)
			->rows_limit($pagination->per_page)
			->get();
        
		// we pass the object, it will be rendered when echo'd in the view
		$data['pagination'] = $pagination;
		
		$this->template->title = "Codes";
		$this->template->content = View::forge('admin/codes/index', $data);
		$view = View::forge('admin/codes/index');
		$view->set_global('stores', Arr::assoc_to_keyval(Model_Store::find('all'), 'id', 'name'));


	}
	public function action_getcsv($store_id = null){
		$query="SELECT
			(select name from stores where id=store_id ),
			`code`,
			`position`,
			((select SUM(`quantity`) from scans where scans.code_id=codes.id and quantity_less=0)-
			IFNULL((select SUM(`quantity`) from scans where scans.code_id=codes.id and quantity_less>0),0))
			FROM `codes` WHERE active>0";
			if($store_id)$query.=" and store_id=".$store_id;
			
		$data = Model_Code::query()
			->select('position')
			->get_query()
			->execute()
			->as_array();
		
		$data = DB::query($query)
			->execute()
			->as_array();
		
		$data = Format::forge($data)->to_csv(null, ";", false, array('Magazzino', 'Codice', 'Posizione','Quantità'));
		
		$response = new Response($data,200);
		$response->set_header('Content-Type','application/csv');
		$response->set_header('Content-Disposition','attachment; filename="codes.csv"');
		$response->set_header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate');
		$response->set_header('Expires','Mon, 26 Jul 1997 05:00:00 GMT');
		$response->set_header('Pragma','no-cache');
		
		return $response;	
	}
	
	public function action_view($id = null)
	{
		$data['code'] = Model_Code::find($id);
		
		$this->template->title = "Code";
		$this->template->content = View::forge('admin/codes/view', $data);

	}
	
	public function action_qrcode($id = null)	{
		$data['code'] = Model_Code::find($id);
		$view = View::forge('admin/codes/qrcode');
		$view->set_global('store', Model_Store::find($data['code']->store_id)["name"]);
		$this->template->title = "QR Code ";
		$this->template->content = View::forge('admin/codes/qrcode', $data);		
	}

	public function action_findingbyname(){
		$this->template->title = "Finding Codes";
		$this->template->content = "";
		$view = View::forge('admin/codes/findingbyname');
		$view->set_global('is_search',1);
		$view->set_global('stores', Arr::assoc_to_keyval(Model_Store::find('all'), 'id', 'name'));
  
		if (Input::method()){
			$store_id= Input::get('store_id');
			if(empty($store_id))$store_id= Input::post('store_id');			
			
			$code= Input::get('code');
			if(empty($code))$code= Input::post('code');			
			
			$acode=explode(" ",$code);
			$code="";
			foreach($acode as $lcode => $vcode)$code.=$vcode;
			
			$position= Input::get('position');
			if(empty($position))$position= Input::post('position');			
			
			$aposition=explode(" ",$position);
			$position="";
			foreach($aposition as $lposition => $vposition)$position.=$vposition;
			
			if(!empty($code)||!empty($store_id)||!empty($position)){
		
					//Session::set_flash('success', "Finding: ".Model_Code::find($code)->code." - ".Model_Store::find(Model_Code::find($code_id)->store_id)->name);
					
					$where_array=array(array('id','>',0));
					//if(!empty($code))array_push($where_array,array('code', 'like', $code));
					if(!empty($code))array_push($where_array,array(DB::expr("REPLACE(`code`,' ','')"), 'like', $code));
					if(!empty($position))array_push($where_array,array(DB::expr("REPLACE(`position`,' ','')"), 'like', $position));
					if(!empty($store_id))array_push($where_array,array('store_id', $store_id));
					
					/*
					Debug::dump($where_array);
					die();
					*/
					$data['codes'] = Model_Code::query()
					->where($where_array)
					->get();

					$this->template->content = View::forge('admin/codes/findingbyname', $data);
				}
				else{
					Session::set_flash('error', "No Values!");
					//Response::redirect('admin');
				}
		}
  }
	public function action_create()	{
		$view = View::forge('admin/codes/create');
		if (Input::method() == 'POST')
		{
			$val = Model_Code::validate('create');

			if ($val->run())
			{
				$code = Model_Code::forge(array(
					'store_id' => Input::post('store_id'),
					'code' => Input::post('code'),
					'position' => Input::post('position'),
					'active' => Input::post('active')?1:0,
				));

			try {
				$code and $code->save();
					Session::set_flash('success', e('Added code #'.$code->id.'.'));
					Response::redirect('admin/codes');
			} catch (\Database_Exception $e) {
				//return $e->getMessage();
				Session::set_flash('error', e('Could not save code.'));
				Response::redirect('admin/codes');
			}
				/*
				if ($code and $code->save())
				{
					Session::set_flash('success', e('Added code #'.$code->id.'.'));
					Response::redirect('admin/codes');
				}

				else
				{
					Session::set_flash('error', e('Could not save code.'));
				}
				*/
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$view->set_global('stores', Arr::assoc_to_keyval(Model_Store::find('all'), 'id', 'name'));
		$this->template->title = "Codes";
		$this->template->content = View::forge('admin/codes/create');

	}

	public function action_edit($id = null)
	{
		
		$view = View::forge('admin/codes/edit');
		$code = Model_Code::find($id);
		$val = Model_Code::validate('edit');

		if ($val->run())
		{
			$code->store_id = Input::post('store_id');
			$code->code = Input::post('code');
			$code->position = Input::post('position');
			$code->active = Input::post('active');

			try {
				$code->save();
				Session::set_flash('success', e('Updated code #' . $id));
				Response::redirect('admin/codes');				
			} catch (\Database_Exception $e) {
				//return $e->getMessage();
				Session::set_flash('error', e($e->getMessage().' - Could not update code #' . $id));
				Response::redirect('admin/codes');
			}
			/*
			if ($code->save())
			{
				Session::set_flash('success', e('Updated code #' . $id));

				Response::redirect('admin/codes');
			}
			else
			{
				Session::set_flash('error', e('Could not update code #' . $id));
			}
			*/
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$code->store_id = $val->validated('store_id');
				$code->code = $val->validated('code');
				$code->position = $val->validated('position');
				$code->active = $val->validated('active');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('code', $code, false);
		}

		$view->set_global('stores', Arr::assoc_to_keyval(Model_Store::find('all'), 'id', 'name'));
		$this->template->title = "Codes";
		$this->template->content = View::forge('admin/codes/edit');

	}

/*
	public function action_delete($id = null){
		if ($code = Model_Code::find($id)){
			if(Model_Scan::query()->where('code_id',$id)->count()>0):
				Session::set_flash('error', e('Sono presenti delle scansioni associate a questo codice, Nessuna opeazione è stata esguita! Visualizza \'Dettaglio Scansioni\' per cancellarle e solo dopo cancella il codice!'));
				Response::redirect('admin/codes');
			endif;
			
			$code->delete();
			Session::set_flash('success', e('Deleted code #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete code #'.$id));
		}

		Response::redirect('admin/codes');

	}
	public function action_deleteOLD($id = null)
	{
		if ($code = Model_Code::find($id))
		{
			$code->delete();

			Session::set_flash('success', e('Deleted code #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete code #'.$id));
		}

		Response::redirect('admin/codes');

	}
*/

}
