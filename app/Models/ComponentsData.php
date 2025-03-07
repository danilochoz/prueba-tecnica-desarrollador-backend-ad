<?php 
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components data Model
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Model
 */
class ComponentsData{
	

	/**
     * autor_id_option_list Model Action
     * @return array
     */
	function autor_id_option_list(){
		$sqltext = "SELECT  DISTINCT autor_id AS value,nombre_completo AS label FROM autores ORDER BY nombre_completo ASC";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}

	

	/**
     * Check if value already exist in Users table
	 * @param string $value
     * @return bool
     */
	function users_username_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('users')->where('username', $value)->value('username');   
		if($exist){
			return true;
		}
		return false;
	}
}
