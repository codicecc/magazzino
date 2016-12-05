<?php
class Quantities{
	static function quantity($code_id){
		$result = DB::select(DB::expr(' SUM(`quantity`) as tot_count'))
			->from('scans')
			->where_open()
			->where('code_id',$code_id)
			->where('quantity_less','0')
			->where_close()
			->execute();
		$tot_count=$result[0]["tot_count"];            
		
		$result = DB::select(DB::expr('SUM(`quantity`) as less_count'))
			->from('scans')
			->where_open()
			->where('quantity_less','>','0')   
			->and_where('code_id',$code_id)
			->where_close()
			->execute();
		$less_count=$result[0]["less_count"];	       
		
		$tot_quantity=($tot_count-$less_count);
		return $tot_quantity;
	}
	/**
	* By $code_id it gets the disponible amount at this moment
	**/
	static function quantity_by_code($code_id){
		$total_quantity=0;
		foreach (self::get_code_id_array($code_id) as $id=>$item):
			$total_quantity+=self::quantity($id);
		endforeach;
		return $total_quantity;
	}
	static private function get_code_id_array($code_id){
		$result=DB::select()->from('codes')->where_open()
			->where('code', 'like',Model_Code::find($code_id)->code)
			->where('store_id',Model_Code::find($code_id)->store_id)
			->and_where('active',1)
			->where_close()
			->execute();
			return $result->as_array('id');
	}
}
?>
