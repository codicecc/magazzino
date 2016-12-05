<?php
class Controller_Admin_Codenew extends Controller_Admin
{

	public function action_index(){
		
		Session::set_flash('success', e('Solo Valvole EGR e Corpi Farfallati'));
		
		$data['codenews'] = Model_Codenew::find('all');
		$this->template->title = "Codenews";
		$this->template->content = View::forge('admin/codenew/index', $data);

	}
	public function action_sync(){
		
		$codesources = DB::select('id','title')->from('codesources')->distinct(true)->execute();
		
		$this->deleteAll();
		$i=0;
		for($i>0;$i<count($codesources);$i++){
			$tcode=Utilities::standardize2($codesources[$i]['title']);
			if(Codes::checkCode($tcode)){
				$codenew = Model_Codenew::forge(array(
					'codesource_id' => $codesources[$i]['id'],
					'title' => Codes::getNewCode($tcode),
					));
				if ($codenew and $codenew->save()){
					$var=1;
					Log::info(Codes::getNewCode($tcode).' CREATED!','sync()');
				}
			}
		}	
		$data['codenews'] = Model_Codenew::find('all');
		$this->template->title = "Codenews";
		$this->template->content = View::forge('admin/codenew/index', $data);
	}

	public function deleteAll(){
		DB::delete('codenews');
	}


	public function action_view($id = null)
	{
		$data['codenew'] = Model_Codenew::find($id);

		$this->template->title = "Codenew";
		$this->template->content = View::forge('admin/codenew/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Codenew::validate('create');

			if ($val->run())
			{
				$codenew = Model_Codenew::forge(array(
					'codesource_id' => Input::post('codesource_id'),
					'title' => Input::post('title'),
				));

				if ($codenew and $codenew->save())
				{
					Session::set_flash('success', e('Added codenew #'.$codenew->id.'.'));

					Response::redirect('admin/codenew');
				}

				else
				{
					Session::set_flash('error', e('Could not save codenew.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Codenews";
		$this->template->content = View::forge('admin/codenew/create');

	}

	public function action_edit($id = null)
	{
		$codenew = Model_Codenew::find($id);
		$val = Model_Codenew::validate('edit');

		if ($val->run())
		{
			$codenew->codesource_id = Input::post('codesource_id');
			$codenew->title = Input::post('title');

			if ($codenew->save())
			{
				Session::set_flash('success', e('Updated codenew #' . $id));

				Response::redirect('admin/codenew');
			}

			else
			{
				Session::set_flash('error', e('Could not update codenew #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$codenew->codesource_id = $val->validated('codesource_id');
				$codenew->title = $val->validated('title');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('codenew', $codenew, false);
		}

		$this->template->title = "Codenews";
		$this->template->content = View::forge('admin/codenew/edit');

	}

	public function action_delete($id = null)
	{
		if ($codenew = Model_Codenew::find($id))
		{
			$codenew->delete();

			Session::set_flash('success', e('Deleted codenew #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete codenew #'.$id));
		}

		Response::redirect('admin/codenew');

	}

}
