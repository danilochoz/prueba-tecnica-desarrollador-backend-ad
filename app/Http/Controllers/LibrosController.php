<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\LibrosAddRequest;
use App\Http\Requests\LibrosEditRequest;
use App\Models\Libros;
use Illuminate\Http\Request;
use Exception;
class LibrosController extends Controller
{


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.libros.list";

		$query = Libros::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Libros::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "libros.libro_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Libros::listFields());
		return $this->renderView($view, compact("records"));
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Libros::query();
		$record = $query->findOrFail($rec_id, Libros::viewFields());
		return $this->renderView("pages.libros.view", ["data" => $record]);
	}


	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.libros.add");
	}


	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(LibrosAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());

		//save Libros record
		$record = Libros::create($modeldata);
		$rec_id = $record->libro_id;
		return $this->redirect("libros", "Registro agregado exitosamente");
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(LibrosEditRequest $request, $rec_id = null){
		$query = Libros::query();
		$record = $query->findOrFail($rec_id, Libros::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("libros", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.libros.edit", ["data" => $record, "rec_id" => $rec_id]);
	}


	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Libros::query();
		$query->whereIn("libro_id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Registro eliminado con éxito");
	}
}
