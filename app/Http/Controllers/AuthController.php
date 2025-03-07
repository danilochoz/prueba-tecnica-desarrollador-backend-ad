<?php 

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Http\Requests\UsersRegisterRequest;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller{
	

	/**
     * Authenticate and login user
     * @return \Illuminate\Http\Response
     */
	function login(Request $request){
		$username = $request->username;
		$password = $request->password;
		Auth::attempt(['username' => $username, 'password' => $password]);
        if (!Auth::check()) {
            return redirect("index/login")->withErrors("Nombre de usuario o contraseña no correctos");
        }
		$user = auth()->user();
		return $this->redirectIntended("/home", "Inicio de sesión completado");

	}
	

	/**
     * Logout user from session
     * @return \Illuminate\Http\Response
     */
	function logout(Request $request){
		Auth::logout();
		return redirect('/');
	}
	

	/**
     * Display user registration form
     * @return \Illuminate\View\View
     */
	function register(){
		return view("pages.index.register");
	}
	

	/**
     * Save new user record
     * @return \Illuminate\Http\Response
     */
	function register_store(UsersRegisterRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['password'] = bcrypt($modeldata['password']);
		
		//save Users record
		$user = $record = Users::create($modeldata);
		$rec_id = $record->user_id;
		Auth::login($user);
		return $this->redirectIntended("/home", "Inicio de sesión completado");

	}
	

	/**
     * Logout user from session
     * @return \Illuminate\Http\Response
     */
	function accountcreated(Request $request){
		return view("pages.index.accountcreated");
	}

	

	/**
     * Logout user from session
     * @return \Illuminate\Http\Response
     */
	function accountblocked(Request $request){
		return view("pages.index.accountblocked");
	}

	

	/**
     * Logout user from session
     * @return \Illuminate\Http\Response
     */
	function accountpending(Request $request){
		return view("pages.index.accountpending");
	}
}
