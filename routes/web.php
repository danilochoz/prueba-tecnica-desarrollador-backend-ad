<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



	Route::get('', 'IndexController@index')->name('index')->middleware(['redirect.to.home']);
	Route::get('index/login', 'IndexController@login')->name('login');
	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::any('auth/logout', 'AuthController@logout')->name('logout')->middleware(['auth']);

	Route::get('auth/accountcreated', 'AuthController@accountcreated')->name('accountcreated');
	Route::get('auth/accountpending', 'AuthController@accountpending')->name('accountpending');
	Route::get('auth/accountblocked', 'AuthController@accountblocked')->name('accountblocked');
	Route::get('auth/accountinactive', 'AuthController@accountinactive')->name('accountinactive');


	
	Route::get('index/register', 'AuthController@register')->name('auth.register')->middleware(['redirect.to.home']);
	Route::post('index/register', 'AuthController@register_store')->name('auth.register_store');
		
	Route::post('auth/login', 'AuthController@login')->name('auth.login');

/**
 * All routes which requires auth
 */
Route::middleware(['auth'])->group(function () {
		
	Route::get('home', 'HomeController@index')->name('home');

	

/* routes for Autores Controller */
	Route::get('autores', 'AutoresController@index')->name('autores.index');
	Route::get('autores/index/{filter?}/{filtervalue?}', 'AutoresController@index')->name('autores.index');	
	Route::get('autores/view/{rec_id}', 'AutoresController@view')->name('autores.view');
	Route::get('autores/masterdetail/{rec_id}', 'AutoresController@masterDetail')->name('autores.masterdetail');	
	Route::get('autores/add', 'AutoresController@add')->name('autores.add');
	Route::post('autores/add', 'AutoresController@store')->name('autores.store');
		
	Route::any('autores/edit/{rec_id}', 'AutoresController@edit')->name('autores.edit');	
	Route::get('autores/delete/{rec_id}', 'AutoresController@delete');

/* routes for Libros Controller */
	Route::get('libros', 'LibrosController@index')->name('libros.index');
	Route::get('libros/index/{filter?}/{filtervalue?}', 'LibrosController@index')->name('libros.index');	
	Route::get('libros/view/{rec_id}', 'LibrosController@view')->name('libros.view');	
	Route::get('libros/add', 'LibrosController@add')->name('libros.add');
	Route::post('libros/add', 'LibrosController@store')->name('libros.store');
		
	Route::any('libros/edit/{rec_id}', 'LibrosController@edit')->name('libros.edit');	
	Route::get('libros/delete/{rec_id}', 'LibrosController@delete');

/* routes for Users Controller */
	Route::get('usuarios', 'UsersController@index')->name('usuarios.index');
	Route::get('usuarios/index/{filter?}/{filtervalue?}', 'UsersController@index')->name('usuarios.index');	
	Route::get('usuarios/view/{rec_id}', 'UsersController@view')->name('usuarios.view');	
	Route::any('account/edit', 'AccountController@edit')->name('account.edit');	
	Route::get('account', 'AccountController@index');	
	Route::get('usuarios/add', 'UsersController@add')->name('usuarios.add');
	Route::post('usuarios/add', 'UsersController@store')->name('usuarios.store');
		
	Route::any('usuarios/edit/{rec_id}', 'UsersController@edit')->name('usuarios.edit');	
	Route::get('usuarios/delete/{rec_id}', 'UsersController@delete');
});


	
Route::get('componentsdata/autor_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->autor_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/users_username_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_username_value_exist($request);
	}
);


Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');


/**
 * All static content routes
 */
Route::get('info/about',  function(){
		return view("pages.info.about");
	}
);
Route::get('info/faq',  function(){
		return view("pages.info.faq");
	}
);

Route::get('info/contact',  function(){
	return view("pages.info.contact");
}
);
Route::get('info/contactsent',  function(){
	return view("pages.info.contactsent");
}
);

Route::post('info/contact',  function(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		$senderName = $request->name;
		$senderEmail = $request->email;
		$message = $request->message;

		$receiverEmail = config("mail.from.address");

		Mail::send(
			'pages.info.contactemail', [
				'name' => $senderName,
				'email' => $senderEmail,
				'comment' => $message
			],
			function ($mail) use ($senderEmail, $receiverEmail) {
				$mail->from($senderEmail);
				$mail->to($receiverEmail)
					->subject('Contact Form');
			}
		);
		return redirect("info/contactsent");
	}
);


Route::get('info/features',  function(){
		return view("pages.info.features");
	}
);
Route::get('info/privacypolicy',  function(){
		return view("pages.info.privacypolicy");
	}
);
Route::get('info/termsandconditions',  function(){
		return view("pages.info.termsandconditions");
	}
);

Route::get('info/changelocale/{locale}', function ($locale) {
	app()->setlocale($locale);
	session()->put('locale', $locale);
    return redirect()->back();
})->name('info.changelocale');