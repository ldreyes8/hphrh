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
Route::get('eventos','UController@listartablero');


Route::group(['prefix'=>'listados'],function(){
	Route::get('empleado','ListadoController@index');
	Route::get('laboral/{id}','ListadoController@laboral');
	Route::get('show/{id}','ListadoController@show');
	Route::get('historial/{id}','ListadoController@historial');
	Route::get('empleado/Acta/{id}','ListadoController@Acta');
	Route::post('empleado/agregar','ListadoController@store');
	Route::get('empleado/calculardias/{id}','ListadoController@calculardias');
	Route::get('vconfirmado','ListadoController@indexconfirmado')->middleware('roleshinobi:recurso');
	Route::get('vrechazado','ListadoController@indexrechazado')->middleware('roleshinobi:recurso');
	Route::get('vautorizado','ListadoController@indexautorizado')->middleware('roleshinobi:recurso');
	Route::get('vsolicitado','ListadoController@indexsolicitado')->middleware('roleshinobi:recurso');

	Route::get('psolicitado','RHPermiso@indexsolicitado')->middleware('roleshinobi:recurso');
	Route::get('prechazado','RHPermiso@indexrechazado')->middleware('roleshinobi:recurso');
	Route::get('pconfirmado','RHPermiso@indexconfirmado')->middleware('roleshinobi:recurso');


	//Route::get('index/{id}','ListadoController@show');
	Route::get('pprueba','Pprueba@index');
	Route::resource('confirmacion','Confirmacion');
	Route::resource('rechazados','Rechazados');
	Route::resource('interino','Interino');
	Route::get('pprueba/update/{id}','Pprueba@update');
	Route::post('pprueba/agregar','Pprueba@store');
	Route::get('update/{id}','Confirmacion@update');
	Route::get('rechazados/eliminar/{id}','Rechazados@eliminar');//prueba de eliminar

});

// Rutas Creados por LDRL

Route::group(['prefix'=>'empleado'],function(){

	Route::post('cambiar_password', 'UController@cambiar_password');
    
    //rutas de solicitud de vacaciones y permisos

    Route::get('solicitud','PerController@solicitud');

	//rutas de permiso del usuario
	Route::get('permiso','PController@index');  // PController = PermisoController
	Route::get('permiso/create','PController@create');
	Route::post('permiso/store','PController@store');
	Route::get('diashatomar','PController@diashatomar');

	//Rutas de vacaciones del usuario
	Route::get('vacaciones','VController@index');
	Route::get('vacaciones/create','VController@create');
	Route::post('vacaciones/store','VController@store');
	Route::get('vacaciones/diashatomar','VController@diashatomar');
	Route::get('vacaciones/calculardias','VController@calculardias');

	Route::post('vacaciones/update','VController@update');
	Route::get('goce','VController@goce');
	Route::get('diastomado','VController@rangogoce');
	//Route::get('Gpdf/{idempleado?}','VController@Gpdf');
	//Route::get('Gpdf/{fini}/{ffin}/{idempleado?}','VController@Gpdf');
	Route::post('Gpdf','VController@Gpdf');


	//Rutas de la solicitud de empleo
	Route::resource('solicitante','SController'); 	// SController = SolicitanteController
	Route::get('Spdf/{id}', 'SController@Spdf');
	Route::get('perfil','PerController@index');		// PerController = PerfilController
	Route::get('contacto','PerController@contacto');

	Route::get('rechazo/{id}/{ids?}','SController@rechazo');
	Route::get('rechazoPP/{id}','SController@rechazoPP');
	Route::get('rechazoPI/{id}','SController@rechazoPI');
	
	Route::post('solicitante/upt/','SController@upt');// agregar una observacion 
	Route::post('solicitante/upsolicitud','PersonaController@upsolicitud');//update de la solicitud para precalificacion
	Route::post('solicitante/upsolicitudPE','PersonaController@upsolicitudPE');//update de la solicitud para precalificacion
	Route::post('solicitante/upsolicitudPD','PersonaController@upsolicitudPD');//update de la solicitud para precalificacion
	Route::post('solicitante/upsolicitudPEL','PersonaController@upsolicitudPEL');//update de la solicitud para precalificacion
	Route::post('solicitante/upsolicitudPR','PersonaController@upsolicitudPR');//update de la solicitud para precalificacion
	Route::post('solicitante/upsolicitudPF','PersonaController@upsolicitudPF');//update de la solicitud para precalificacion
	Route::post('solicitante/upsolicitudPA','PersonaController@upsolicitudPA');//update de la solicitud para precalificacion

	//Route::get('update/{id}','SController@update');

	//rutas del perfil
	Route::post('/updatefoto','UController@subirimagen'); 
	Route::get('galeria','UController@galeria');
	Route::get('buscar_personal/{dato?}', 'UController@buscar_personal');
	Route::get('empleado','HomeController@dgenerales');
	Route::get('listardgenerales','HomeController@listardgenerales');
	Route::put('updatedgenerales/{id}','HomeController@updatedgenerales');
	




	
	//Route::get('buscar_usuarios/{pais}/{dato?}', 'UController@buscar_usuarios');

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

	//Route idioma crud
	Route::get('listaridioma/{id}','UController@listaridioma');
	Route::post('agregaridioma','UController@agregaridioma');
	Route::put('updateidioma/{id}','UController@updateidioma');
	Route::delete('deleteidioma/{id}','UController@deleteidioma');

	//Route licencia crud
	Route::get('listarlicencia/{id}','UController@listarlicencia');
	Route::post('agregarlicencia','UController@agregarlicencia');
	Route::put('updatelic/{id}','UController@updatelic');
	Route::delete('deletelic/{id}','UController@deletelic');

	//Route puesto a aplicar
	Route::put('SolicitanteI','UController@SolicitanteI');

	
	

//Rutas de permisos Y vacaciones del jefeinmediato

	//Route::get('autorizaciones','PermisosController@index');
	Route::get('autorizaciones','PermisosController@indexdirector'); /// solicitud de vacaciones y permisos de los empleados que tiene un jefe x.
	Route::get('solicitadoVP','PermisosController@index');
	Route::get('vautorizado','VacacionesController@indexautorizado')->middleware('roleshinobi:jefeinmediato');/////
	Route::get('rechazado','PermisosController@indexrechazado')->middleware('roleshinobi:jefeinmediato');
	Route::get('confirmado','PermisosController@indexconfirmado')->middleware('roleshinobi:jefeinmediato');


	Route::resource('solicitadospermis','PermisosController');
	
	Route::get('verificar/{idpersona}','PermisosController@verificar')->middleware('roleshinobi:jefeinmediato');
	Route::post('verificar/enviarpermiso','PermisosController@enviarpermiso')->middleware('roleshinobi:jefeinmediato');

	Route::get('detalleconfirmado/{idpersona}','PermisosController@detalleconfirmado')->middleware('roleshinobi:jefeinmediato');
	Route::get('detallerechazado/{idpersona}','PermisosController@detallerechazado')->middleware('roleshinobi:jefeinmediato');

	Route::resource('vsolicitado','VacacionesController');
	Route::get('vverificar/{idpersona}','VacacionesController@verificar')->middleware('roleshinobi:jefeinmediato');
	Route::get('dconfirmar/{idpersona}','VacacionesController@dconfirmar')->middleware('roleshinobi:jefeinmediato');

	
	Route::post('vverificar/enviarvacaciones','VacacionesController@enviarvacaciones')->middleware('roleshinobi:jefeinmediato');
	Route::get('vconfirmado','VacacionesController@indexconfirmado')->middleware('roleshinobi:jefeinmediato');
	Route::get('vrechazado','VacacionesController@indexrechazado')->middleware('roleshinobi:jefeinmediato');
	Route::get('vconfirmar/{idpersona}','VacacionesController@confirmar')->middleware('roleshinobi:jefeinmediato');
	Route::post('vconfirmar/enviarconfirmacion','VacacionesController@confirmavacaciones')->middleware('roleshinobi:jefeinmediato');
	
	Route::get('/logout', 'Auth\LoginController@logout');

// Rutas del reclutamiento del jefeinmediato
	Route::get('reclutamiento','ReclutamientoJI@index');


//Reportes
	Route::get('reporteEmpleado','Reporte@index')->middleware('roleshinobi:reporte');

//Excel
	Route::get('reporteEmpleadoExcel','Reporte@Empleadoexcel')->middleware('roleshinobi:reporte');

	//FotoController@agregarimagen
	//Route::put('/colaboradores/{id}',['uses' => 'Colaboradores@update', 'middleware' => 'auth']);

});

//Errores
Route::get('error404',function(){
	abort(404);
});
Route::get('error401',function(){
	abort(401);
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
//rutas del controlador de Usuario
Route::get('seguridad/usuario', 'UController@contenedor')->middleware('roleshinobi:informatica');
Route::get('seguridad/usuarios/{page?}','UController@index')->middleware('roleshinobi:informatica');
Route::get('seguridad/usuario/create','UController@add')->middleware('roleshinobi:informatica');
Route::post('seguridad/usuario/store','UController@store')->middleware('roleshinobi:informatica');
Route::get('seguridad/usuario/editar_usuario/{id}', 'UController@editar_usuario')->middleware('roleshinobi:informatica');
Route::delete('destroy/{id}','UController@destroy')->middleware('roleshinobi:informatica');
Route::get('asignar_rol/{idusu}/{idrol}', 'UController@asignar_rol')->middleware('roleshinobi:informatica');
Route::get('quitar_rol/{idusu}/{idrol}','UController@quitar_rol')->middleware('roleshinobi:informatica');

//Route::get('form_nuevo_usuario', 'UsuariosController@form_nuevo_usuario');
Route::get('seguridad/usuario/form_nuevo_rol', 'UController@form_nuevo_rol')->middleware('roleshinobi:informatica');
Route::get('seguridad/buscar_usuarios/{rol}/{dato?}', 'UController@buscar_usuarios'); 

Route::post('crear_rol', 'UController@crear_rol')->middleware('roleshinobi:informatica');
Route::get('borrar_rol/{idrol}', 'UController@borrar_rol')->middleware('roleshinobi:informatica');

