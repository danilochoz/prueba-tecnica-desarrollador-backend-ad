
<?php
	class Menu{
		
	public static function navbarsideleft(){
		return [
		[
			'path' => 'home',
			'label' => "Inicio", 
			'icon' => '<i class="material-icons ">home</i>'
		],
		
		[
			'path' => 'autores',
			'label' => "Autores", 
			'icon' => '<i class="material-icons ">supervisor_account</i>'
		],
		
		[
			'path' => 'libros',
			'label' => "Libros", 
			'icon' => '<i class="material-icons ">library_books</i>'
		],
		
		[
			'path' => 'usuarios',
			'label' => "Usuarios", 
			'icon' => '<i class="material-icons ">account_circle</i>'
		]
	] ;
	}
	
		
	}
