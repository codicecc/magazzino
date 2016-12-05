<?php
class Controller_Admin_Codesource extends Controller_Admin
{

	public function action_index(){
		$data['codesources'] = Model_Codesource::find('all');
		$this->template->title = "Codesources";
		$this->template->content = View::forge('admin/codesource/index', $data);

	}

	public function action_sync()
	{
		$codes = DB::select('code')->from('codes')->distinct(true)->execute();
		//$codes=$query->get();
		
		$i=0;
		$codeexisting=0;
		for($i>0;$i<count($codes);$i++){
			$codeexisting=Model_Codesource::query()
					->where(DB::expr("REPLACE(`title`,' ','')"), 'like', Utilities::standardize2($codes[$i]['code']))
					->get();
		
			if(count($codeexisting)>0){
				$var=1;
				Log::info($codes[$i]['code'].' EXISTS!','sync()');
			}
			else{
				$codesource = Model_Codesource::forge(array(
						'title' => $codes[$i]['code'],
					));
				if ($codesource and $codesource->save()){
					$var=1;
					Log::info($codes[$i]['code'].' CREATED!','sync()');
				}
			}			
		}
		
		$data['codesources'] = Model_Codesource::find('all');
		$this->template->title = "Codesources";
		$this->template->content = View::forge('admin/codesource/index', $data);

	}
	
	public function action_view($id = null)
	{
		$data['codesource'] = Model_Codesource::find($id);

		$this->template->title = "Codesource";
		$this->template->content = View::forge('admin/codesource/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Codesource::validate('create');

			if ($val->run())
			{
				$codesource = Model_Codesource::forge(array(
					'title' => Input::post('title'),
				));

				if ($codesource and $codesource->save())
				{
					Session::set_flash('success', e('Added codesource #'.$codesource->id.'.'));

					Response::redirect('admin/codesource');
				}

				else
				{
					Session::set_flash('error', e('Could not save codesource.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Codesources";
		$this->template->content = View::forge('admin/codesource/create');

	}

	public function action_edit($id = null)
	{
		$codesource = Model_Codesource::find($id);
		$val = Model_Codesource::validate('edit');

		if ($val->run())
		{
			$codesource->title = Input::post('title');

			if ($codesource->save())
			{
				Session::set_flash('success', e('Updated codesource #' . $id));

				Response::redirect('admin/codesource');
			}

			else
			{
				Session::set_flash('error', e('Could not update codesource #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$codesource->title = $val->validated('title');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('codesource', $codesource, false);
		}

		$this->template->title = "Codesources";
		$this->template->content = View::forge('admin/codesource/edit');

	}

	public function action_delete($id = null)
	{
		if ($codesource = Model_Codesource::find($id))
		{
			$codesource->delete();

			Session::set_flash('success', e('Deleted codesource #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete codesource #'.$id));
		}

		Response::redirect('admin/codesource');

	}

}
