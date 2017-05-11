<?php

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


Route::resource('persona','PersonaController');
Route::resource('listados','ListadoController');

Route::get('persona/towns/{id}', 'PersonaController@getTowns');
//Route::get('layouts/towns/{id}', 'PersonaController@getTowns');

// Rutas Creados por LDRL

Route::group(['prefix'=>'empleado'],function(){
	Route::resource('permiso','PController');       // PController = PermisoController 
	Route::resource('vacaciones','VController');
	Route::get('vacaciones/create','VController@create');
	Route::post('vacaciones/store','VController@store');
	Route::get('vacaciones/diashatomar','VController@diashatomar');

	Route::get('vacaciones/calculardias','VController@calculardias');


	Route::resource('solicitante','SController'); 	// SController = SolicitanteController
	Route::get('Spdf/{id}', 'SController@Spdf');
	Route::resource('perfil','PerController');		// PerController = PerfilController
//	Route::post('updatefoto', 'FotoController@agregarimagen'); 		
	Route::post('/updatefoto','UController@subirimagen');
	Route::get('galeria','UController@galeria');
	Route::get('listaracademico','UController@listaracademico');
	Route::get('towns/{id}', 'UController@getTowns'); 
	Route::post('agregaracademico','UController@agregaracademico');
	Route::get('listarfamilia','UController@listarfamiliar');
	Route::post('agregarfamiliar','UController@agregarfamiliar');

	Route::resource('permisos','PermisosController');
	Route::get('verificar/{idpersona}','PermisosController@verificar');
	Route::post('verificar/enviarpermiso','PermisosController@enviarpermiso');
	Route::get('confirmado','PermisosController@indexconfirmado');
	Route::get('rechazado','PermisosController@indexrechazado');

//FotoController@agregarimagen
	//Route::put('/colaboradores/{id}',['uses' => 'Colaboradores@update', 'middleware' => 'auth']);

});


Route::get('/', function () {
    return view('auth/login');
});

Route::get('/logout', 'Auth\LoginController@logout');
Route::get('pdf','SController@pdf');


///
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('seguridad/usuario','UController'); 