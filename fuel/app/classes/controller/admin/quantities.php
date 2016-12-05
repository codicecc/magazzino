<?php
class Controller_Admin_Quantities extends Controller_Admin_Codes{
		public function action_index($store_id=null){

			/*
			$data['codes'] = Model_Code::query()
				->group_by('code')
				->order_by('code')
				->get();
			*/
			
			$query = Model_Code::query();
			if($store_id)$query->where("store_id",$store_id);
			$query->group_by('code')
						->order_by('code');
						
			$data['codes']=$query->get();
        		
		$this->template->title = "Quantità";
		$this->template->content = View::forge('admin/quantities/index', $data);
		$view = View::forge('admin/quantities/index');
		$view->set_global('stores', Arr::assoc_to_keyval(Model_Store::find('all'), 'id', 'name'));
	}
	public function action_getcsv($store_id = null){
		$query="SELECT
			(select name from stores where id=store_id ),
			`code`,
			((select SUM(`quantity`) from scans where scans.code_id=codes.id and quantity_less=0)-
			IFNULL((select SUM(`quantity`) from scans where scans.code_id=codes.id and quantity_less>0),0))
			FROM `codes` WHERE active>0";
			if($store_id)$query.=" and store_id=".$store_id;
			$query.="			group by code
			order by store_id";
			
					
		$data = Model_Code::query()
			->get_query()
			->execute()
			->as_array();
		
		$data = DB::query($query)
			->execute()
			->as_array();
		
		$data = Format::forge($data)->to_csv(null, ";", false, array('Magazzino', 'Codice', 'Quantità'));
		
		$response = new Response($data,200);
		$response->set_header('Content-Type','application/csv');
		$response->set_header('Content-Disposition','attachment; filename="'.Model_Store::find($store_id)->name.'-'.date('YmdHi').'.csv"');
		$response->set_header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate');
		$response->set_header('Expires','Mon, 26 Jul 1997 05:00:00 GMT');
		$response->set_header('Pragma','no-cache');
		
		return $response;	
	}
}
