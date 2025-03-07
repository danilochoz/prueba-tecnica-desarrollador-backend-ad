<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Libros extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'libros';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'libro_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'titulo','descripcion','fecha_publicacion','autor_id'
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
				libro_id LIKE ?  OR 
				titulo LIKE ?  OR 
				descripcion LIKE ? 
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
			"libro_id",

			"titulo",

			"descripcion",

			"fecha_publicacion",

			"autor_id" 
		];
	}

	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"libro_id",

			"titulo",

			"descripcion",

			"fecha_publicacion",

			"autor_id" 
		];
	}

	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"libro_id",

			"titulo",

			"descripcion",

			"fecha_publicacion",

			"autor_id" 
		];
	}

	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"libro_id",

			"titulo",

			"descripcion",

			"fecha_publicacion",

			"autor_id" 
		];
	}

	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"titulo",

			"descripcion",

			"fecha_publicacion",

			"autor_id",

			"libro_id" 
		];
	}
}
