<?php
class Controller_Admin_Codecompetitor extends Controller_Admin{
	
	public function action_index()
	{
		$data['codecompetitors'] = Model_Codecompetitor::find('all');
		$this->template->title = "Codecompetitors";
		$this->template->content = View::forge('admin/codecompetitor/index', $data);

	}

	public function action_view($id = null)
	{
		$data['codecompetitor'] = Model_Codecompetitor::find($id);

		$this->template->title = "Codecompetitor";
		$this->template->content = View::forge('admin/codecompetitor/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Codecompetitor::validate('create');

			if ($val->run())
			{
				$codecompetitor = Model_Codecompetitor::forge(array(
					'codesource_id' => Input::post('codesource_id'),
					'title' => Input::post('title'),
					'note' => Input::post('note'),
				));

				try {
					$codecompetitor and $codecompetitor->save();
						Session::set_flash('success', e('Added codecompetitor #'.$codecompetitor->id.'.'));
						Response::redirect('admin/codecompetitor');
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

		$this->template->title = "Codecompetitors";
		$this->template->content = View::forge('admin/codecompetitor/create');

	}

	public function action_edit($id = null)
	{
		$codecompetitor = Model_Codecompetitor::find($id);
		$val = Model_Codecompetitor::validate('edit');

		if ($val->run())
		{
			$codecompetitor->codesource_id = Input::post('codesource_id');
			$codecompetitor->title = Input::post('title');
			$codecompetitor->note = Input::post('note');

			try {
				$codecompetitor->save();
				Session::set_flash('success', e('Updated codecompetitor #' . $id));
				Response::redirect('admin/codecompetitor');
			} catch (\Database_Exception $e) {
				Session::set_flash('error', e('Could not save code. You can not create a duplicate entity!'));
				Response::redirect('admin/codecompetitor');
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$codecompetitor->codesource_id = $val->validated('codesource_id');
				$codecompetitor->title = $val->validated('title');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('codecompetitor', $codecompetitor, false);
		}

		$this->template->title = "Codecompetitors";
		$this->template->content = View::forge('admin/codecompetitor/edit');

	}

	public function action_delete($id = null)
	{
		if ($codecompetitor = Model_Codecompetitor::find($id))
		{
			$codecompetitor->delete();

			Session::set_flash('success', e('Deleted codecompetitor #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete codecompetitor #'.$id));
		}

		Response::redirect('admin/codecompetitor');

	}

}
