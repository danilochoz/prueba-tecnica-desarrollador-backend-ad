<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Autores extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'autores';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'autor_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'nombre_completo','nacionalidad','fecha_nacimiento'
	];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				autor_id LIKE ?  OR 
				nombre_completo LIKE ?  OR 
				nacionalidad LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);

	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"autor_id",

			"nombre_completo",

			"nacionalidad",

			"fecha_nacimiento" 
		];
	}

	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"autor_id",

			"nombre_completo",

			"nacionalidad",

			"fecha_nacimiento" 
		];
	}

	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"autor_id",

			"nombre_completo",

			"nacionalidad",

			"fecha_nacimiento" 
		];
	}

	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"autor_id",

			"nombre_completo",

			"nacionalidad",

			"fecha_nacimiento" 
		];
	}

	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"nombre_completo",

			"nacionalidad",

			"fecha_nacimiento",

			"autor_id" 
		];
	}
}
