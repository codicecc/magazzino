<?php
class Controller_Admin_Stores extends Controller_Admin
{

	public function action_index()
	{
		$data['stores'] = Model_Store::find('all');
		$this->template->title = "Stores";
		$this->template->content = View::forge('admin/stores/index', $data);

	}

	public function action_view($id = null)
	{
		$data['store'] = Model_Store::find($id);

		$this->template->title = "Store";
		$this->template->content = View::forge('admin/stores/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Store::validate('create');

			if ($val->run())
			{
				$store = Model_Store::forge(array(
					'name' => Input::post('name'),
					'note' => Input::post('note'),
				));

				if ($store and $store->save())
				{
					Session::set_flash('success', e('Added store #'.$store->id.'.'));

					Response::redirect('admin/stores');
				}

				else
				{
					Session::set_flash('error', e('Could not save store.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Stores";
		$this->template->content = View::forge('admin/stores/create');

	}

	public function action_edit($id = null)
	{
		$store = Model_Store::find($id);
		$val = Model_Store::validate('edit');

		if ($val->run())
		{
			$store->name = Input::post('name');
			$store->note = Input::post('note');

			if ($store->save())
			{
				Session::set_flash('success', e('Updated store #' . $id));

				Response::redirect('admin/stores');
			}

			else
			{
				Session::set_flash('error', e('Could not update store #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$store->name = $val->validated('name');
				$store->note = $val->validated('note');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('store', $store, false);
		}

		$this->template->title = "Stores";
		$this->template->content = View::forge('admin/stores/edit');

	}

	public function action_delete($id = null)
	{
		if ($store = Model_Store::find($id))
		{
			$store->delete();

			Session::set_flash('success', e('Deleted store #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete store #'.$id));
		}

		Response::redirect('admin/stores');

	}

}
