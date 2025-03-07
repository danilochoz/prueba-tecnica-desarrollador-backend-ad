<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutoresAddRequest;
use App\Http\Requests\AutoresEditRequest;
use App\Models\Autores;
use Illuminate\Http\Request;
use Exception;
class AutoresController extends Controller
{


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.autores.list";

		$query = Autores::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Autores::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "autores.autor_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Autores::listFields());
		return $this->renderView($view, compact("records"));
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Autores::query();
		$record = $query->findOrFail($rec_id, Autores::viewFields());
		return $this->renderView("pages.autores.view", ["data" => $record]);
	}


	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.autores.detail-pages", ["masterRecordId" => $rec_id]);
	}


	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.autores.add");
	}


	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(AutoresAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());

		//save Autores record
		$record = Autores::create($modeldata);
		$rec_id = $record->autor_id;
		return $this->redirect("autores", "Registro agregado exitosamente");
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(AutoresEditRequest $request, $rec_id = null){
		$query = Autores::query();
		$record = $query->findOrFail($rec_id, Autores::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("autores", "Registro actualizado con éxito");
		}
		return $this->renderView("pages.autores.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Autores::query();
		$query->whereIn("autor_id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Registro eliminado con éxito");
	}
}
