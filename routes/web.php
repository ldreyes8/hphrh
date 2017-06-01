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


Route::get('solicitud','PersonaController@create');
Route::get('towns/{id}', 'PersonaController@getTowns');
Route::post('solicitud/ds','PersonaController@store');
Route::resource('mintrabf','Controllermintrab');
Route::get('excel','Controllermintrab@excel');



Route::group(['prefix'=>'listados'],function(){
	Route::get('empleado','ListadoController@index');
	Route::get('laboral/{id}','ListadoController@laboral');
	Route::get('show/{id}','ListadoController@show');
	Route::get('historial/{id}','ListadoController@historial');
	Route::get('empleado/Acta/{id}','ListadoController@Acta');
	Route::post('empleado/agregar','ListadoController@store');
	//Route::get('index/{id}','ListadoController@show');
	Route::get('pprueba','Pprueba@index');
	Route::resource('confirmacion','Confirmacion');
	Route::resource('rechazados','Rechazados');
	Route::resource('interino','Interino');
	Route::get('pprueba/update/{id}','Pprueba@update');
	Route::post('pprueba/agregar','Pprueba@store');
	Route::get('update/{id}','Confirmacion@update');
});

// Rutas Creados por LDRL

Route::group(['prefix'=>'empleado'],function(){

	Route::post('cambiar_password', 'UController@cambiar_password');
       // PController = PermisoController 

	Route::get('permiso','PController@index');
	Route::get('permiso/create','PController@create');

	Route::post('permiso/store','PController@store');

	Route::get('diashatomar','PController@diashatomar');


	Route::get('vacaciones','VController@index');
	Route::get('vacaciones/create','VController@create');
	Route::post('vacaciones/store','VController@store');
	Route::get('vacaciones/diashatomar','VController@diashatomar');
	Route::get('vacaciones/calculardias','VController@calculardias');
	Route::post('vacaciones/update','VController@update');
	Route::get('goce','VController@goce');
	Route::get('diastomado','VController@rangogoce');
	Route::get('Gpdf','VController@Gpdf');

	Route::resource('solicitante','SController'); 	// SController = SolicitanteController
	Route::get('Spdf/{id}', 'SController@Spdf');
	Route::resource('perfil','PerController');		// PerController = PerfilController
//	Route::post('updatefoto', 'FotoController@agregarimagen'); 		
	Route::post('/updatefoto','UController@subirimagen');

	Route::get('rechazo/{id}','SController@rechazo');
	
	Route::post('solicitante/upt/','SController@upt');// agregar una observacion 
	Route::post('solicitante/upsolicitud/','PersonaController@upsolicitud');//update de la solicitud para precalificacion

	//Route::get('update/{id}','SController@update');

	Route::get('galeria','UController@galeria');

	//Route academico crud
	Route::get('listaracademico','UController@listaracademico');
	Route::get('towns/{id}', 'UController@getTowns'); 
	Route::post('agregaracademico','UController@agregaracademico');
	Route::get('listaracademico1/{id}','UController@listaracademico1');
	Route::put('updateAca/{id}','UController@updateAca');
	Route::delete('deleteacad/{id}','UController@deleteacad');

	//Route familia crud
	Route::get('listarfamilia','UController@listarfamiliar');
	Route::post('agregarfamiliar','UController@agregarfamiliar');
	Route::get('listarfamilia1/{id}','UController@listarfamilia1');
	Route::put('updatefam/{id}','UController@updatefam');
	Route::delete('deletefam/{id}','UController@deletefam');

	//Route referencia curd
	Route::get('listarreferencia','UController@listarreferencia');
	Route::post('agregarreferencia','UController@agregarreferencia');
	Route::get('listarreferencia1/{id}','UController@listarreferencia1');
	Route::put('updateref/{id}','UController@updateref');
	Route::delete('deleteref/{id}','UController@deleteref');
	
	//Route credito crud
	Route::get('listarcredito','UController@listarcredito');
	Route::post('agregarcredito','UController@agregarcredito');
	Route::get('listarcredito1/{id}','UController@listarcredito1');
	Route::put('updateco/{id}','UController@updateco');
	Route::delete('deletecredito/{id}','UController@deletecredito');

	//Route padecimiento crud
	Route::get('listarpadecimiento','UController@listarpadecimiento');
	Route::post('agregarpadecimiento','UController@agregarpadecimiento');
	Route::get('listarpadecimiento1/{id}','UController@listarpadecimiento1');
	Route::put('updatepad/{id}','UController@updatepad');
	Route::delete('deletepad/{id}','UController@deletepad');

	//Route experiencia crud
	Route::get('listarexperiencia','UController@listarexperiencia');
	Route::post('agregarexperiencia','UController@agregarexperiencia');
	Route::get('listarexperiencia1/{id}','UController@listarexperiencia1');
	Route::put('updatexp/{id}','UController@updatexp');
	Route::delete('deletexp/{id}','UController@deletexp');

	//Route otros crud
	Route::get('listarotros','UController@listarotros');
	Route::post('agregarotros','UController@agregarotros');
	Route::get('listarotros1/{id}','UController@listarotros1');

	Route::resource('permisos','PermisosController');

	Route::get('verificar/{idpersona}','PermisosController@verificar');
	Route::post('verificar/enviarpermiso','PermisosController@enviarpermiso');
	Route::get('confirmado','PermisosController@indexconfirmado');
	Route::get('rechazado','PermisosController@indexrechazado');

	Route::get('detalleconfirmado/{idpersona}','PermisosController@detalleconfirmado');
	Route::get('detallerechazado/{idpersona}','PermisosController@detallerechazado');

	Route::resource('vsolicitado','VacacionesController');
	Route::get('vverificar/{idpersona}','VacacionesController@verificar');
	Route::get('dconfirmar/{idpersona}','VacacionesController@dconfirmar');


	
	Route::post('vverificar/enviarvacaciones','VacacionesController@enviarvacaciones');
	Route::get('vconfirmado','VacacionesController@indexconfirmado');
	Route::get('vrechazado','VacacionesController@indexrechazado');
	Route::get('vautorizado','VacacionesController@indexautorizado');
	Route::get('vconfirmar/{idpersona}','VacacionesController@confirmar');
	Route::post('vconfirmar/enviarconfirmacion','VacacionesController@confirmavacaciones');
	
Route::get('/logout', 'Auth\LoginController@logout');

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
Route::get('/{slug?}','HomeController@index');
Route::get('/home', 'HomeController@index');
Route::resource('seguridad/usuario','UController'); 