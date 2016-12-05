<?php
class Controller_Admin_Codeoem extends Controller_Admin{

	protected static $_belongs_to = array('codesource');
	
	public function action_index()
	{
		$data['codeoems'] = Model_Codeoem::find('all');
		$this->template->title = "Codeoems";
		$this->template->content = View::forge('admin/codeoem/index', $data);

	}

	public function action_view($id = null)
	{
		$data['codeoem'] = Model_Codeoem::find($id);

		$this->template->title = "Codeoem";
		$this->template->content = View::forge('admin/codeoem/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Codeoem::validate('create');

			if ($val->run())
			{
				$codeoem = Model_Codeoem::forge(array(
					'codesource_id' => Input::post('codesource_id'),
					'title' => Input::post('title'),
				));

				try {
					$codeoem and $codeoem->save();
						Session::set_flash('success', e('Added code #'.$code->id.'.'));
						Response::redirect('admin/codeoem');
				} catch (\Database_Exception $e) {
					//return $e->getMessage();
					Session::set_flash('error', e('Could not save code. You can not create a duplicate entity!'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Codeoems";
		$this->template->content = View::forge('admin/codeoem/create');

	}

	public function action_edit($id = null)
	{
		$codeoem = Model_Codeoem::find($id);
		$val = Model_Codeoem::validate('edit');

		if ($val->run())
		{
			$codeoem->codesource_id = Input::post('codesource_id');
			$codeoem->title = Input::post('title');

			try {
				$codeoem->save();
				Session::set_flash('success', e('Updated codeoem #' . $id));
				Response::redirect('admin/codeoem');
			} catch (\Database_Exception $e) {
				//return $e->getMessage();
				Session::set_flash('error', e('Could not save code. You can not create a duplicate entity!'));
				Response::redirect('admin/codeoem');
			}

		}
		else
		{
			if (Input::method() == 'POST')
			{
				$codeoem->codesource_id = $val->validated('codesource_id');
				$codeoem->title = $val->validated('title');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('codeoem', $codeoem, false);
		}

		$this->template->title = "Codeoems";
		$this->template->content = View::forge('admin/codeoem/edit');

	}

	public function action_delete($id = null)
	{
		if ($codeoem = Model_Codeoem::find($id))
		{
			$codeoem->delete();

			Session::set_flash('success', e('Deleted codeoem #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete codeoem #'.$id));
		}

		Response::redirect('admin/codeoem');

	}

}
