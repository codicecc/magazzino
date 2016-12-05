<?php
class Controller_Quantity extends Controller_Rest
{
    public function get_quantity(){
    	/*
        return $this->response(array(
            'Code_id' => Input::get('code_id'),
        ));
      */
      if (Auth::check())echo Quantities::quantity(Input::get('code_id'));
    }
}
?>
