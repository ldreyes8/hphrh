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


	Route::get('pprueba','Pprueba@index');
	Route::resource('confirmacion','Confirmacion');
	Route::resource('rechazados','Rechazados');
	Route::resource('interino','Interino');
	
	Route::post('pprueba/agregar','Pprueba@store');
	Route::get('update/{id}','Confirmacion@update');
	Route::get('rechazados/eliminar/{id}','Rechazados@eliminar');//prueba de eliminar

});

// Rutas Creados por LDRL
Route::group(['prefix'=>'empleado'],function(){

	//Listado general
	Route::get('listado/{page?}','ListadoController@listado'); 
	Route::get('busqueda/{rol}/{dato?}','ListadoController@busqueda'); 
	Route::get('empleados','ListadoController@index');
	Route::get('empleados/calculardias/{id}','ListadoController@calculardias'); 
	Route::get('rechazados','Rechazados@index');
	Route::get('hlaboral/{id}','ListadoController@laboral');
	Route::get('show/{id}','ListadoController@show');

	//Rutas de despido de un empleado
	Route::get('personabaja/{id}','ListadoController@bajas');
	Route::post('addbaja','ListadoController@addbaja');
	Route::get('debaja','ListadoController@debaja');

	//Rutas de nombramiento y/o asecensos.
	Route::get('indexnombramiento','RHNombramientoEmpleado@index');
	Route::get('addnombramiento/{id}','RHNombramientoEmpleado@addnombramiento');
	Route::get('busquedaActivo/{rol}/{dato?}','RHNombramientoEmpleado@busqueda');
	Route::post('addasecenso','RHNombramientoEmpleado@addasecenso');

	//Asignar o quitar jefes inmediatos
	Route::get('asignar_jefeinmediato/{idempleado}/{identificacion}/{notifica}', 'RHNombramientoEmpleado@asignar_jefeinmediato');
	Route::get('quitar_jefeinmediato/{idempleado}/{identificacion}', 'RHNombramientoEmpleado@quitar_jefeinmediato');


	//Listado permisosvacaciones
	Route::get('listadoPV','RHPermiso@listadoPV');
	Route::get('psolicitado/{page?}','RHPermiso@indexsolicitado');
	Route::get('pconfirmado','RHPermiso@indexconfirmado');
	Route::get('prechazado','RHPermiso@indexrechazado');
	Route::get('vautorizadopv','RHPermiso@indexautorizado');
	Route::get('busquedaindexsolicitado/{tipoausencia}/{dato?}','RHPermiso@busquedasolicitados');
	Route::get('busquedaindexaceptado/{tipoausencia}/{dato?}','RHPermiso@busquedaconfirmados');
	Route::get('busquedaindexrechazado/{tipoausencia}/{dato?}','RHPermiso@busquedarechazados');

	//Listapo reclutamiento
	Route::get('listadoR','RHReclutamiento@listadoR');
	Route::get('solicitudes','RHReclutamiento@index');
	Route::get('solicitudesjf','RHReclutamiento@indexjf');
	Route::get('busquedas/{dato?}','RHReclutamiento@busquedas');//dssdsd//
	Route::get('update/{id}','Pprueba@update');
	//Route::get('solicitudesjf/show/upPreentrevista1/{id}/{ids?}','RHPreentrevista@upPreentrevista');

	//JI reclutamiento
	Route::get('precalificarjf/{id}','RHPrecalificado@precalificarjf');
	Route::get('upPreentrevistajf/{id}/{ids?}','RHPreentrevista@upPreentrevistajf');

	Route::get('solicitudesjf/show/{id}','RHReclutamiento@showjf');
	Route::post('solicitudesjf/show/expcomentaro/','PersonaController@expcomentaro');// agregar una observacion experiencia
	Route::post('solicitudesjf/show/refcomentario/','PersonaController@refcomentario');// agregar una observacion referencia
	
	Route::post('solicitudesjf/show/upsolicitud','PersonaController@upsolicitud');//update de la solicitud para precalificacion
	Route::post('solicitudesjf/show/upsolicitudPE','PersonaController@upsolicitudPE');//update de la solicitud para precalificacion
	Route::post('solicitudesjf/show/upsolicitudPD','PersonaController@upsolicitudPD');//update de la solicitud para precalificacion
	Route::post('solicitudesjf/show/upsolicitudPEL','PersonaController@upsolicitudPEL');//update de la solicitud para precalificacion
	Route::post('solicitudesjf/show/upsolicitudPR','PersonaController@upsolicitudPR');//update de la solicitud para precalificacion
	Route::post('solicitudesjf/show/upsolicitudPF','PersonaController@upsolicitudPF');//update de la solicitud para precalificacion
	Route::post('solicitudesjf/show/upsolicitudPA','PersonaController@upsolicitudPA');//update de la solicitud para precalificacion

	Route::get('pre_entrevistadoji/show/{id}','RHPreentrevista@showprejf');

	Route::post('pre_entrevistadoji/show/expcomentaro/','PersonaController@expcomentaro');// agregar una observacion experiencia
	Route::post('pre_entrevistadoji/show/refcomentario/','PersonaController@refcomentario');// agregar una observacion referencia
	Route::post('pre_entrevistadoji/show/upsolicitud','PersonaController@upsolicitud');//update de la solicitud para precalificacion
	Route::post('pre_entrevistadoji/show/upsolicitudPE','PersonaController@upsolicitudPE');//update de la solicitud para precalificacion
	Route::post('pre_entrevistadoji/show/upsolicitudPD','PersonaController@upsolicitudPD');//update de la solicitud para precalificacion
	Route::post('pre_entrevistadoji/show/upsolicitudPEL','PersonaController@upsolicitudPEL');//update de la solicitud para precalificacion
	Route::post('pre_entrevistadoji/show/upsolicitudPR','PersonaController@upsolicitudPR');//update de la solicitud para precalificacion
	Route::post('pre_entrevistadoji/show/upsolicitudPF','PersonaController@upsolicitudPF');//update de la solicitud para precalificacion
	Route::post('pre_entrevistadoji/show/upsolicitudPA','PersonaController@upsolicitudPA');//update de la solicitud para precalificacion

	Route::get('pre_calificadosjf/show/{id}','RHPrecalificado@showjfpc');
	Route::post('pre_calificadosjf/show/expcomentaro/','PersonaController@expcomentaro');// agregar una observacion experiencia
	Route::post('pre_calificadosjf/show/refcomentario/','PersonaController@refcomentario');// agregar una observacion referencia
	Route::post('pre_calificadosjf/show/upsolicitud','PersonaController@upsolicitud');//update de la solicitud para precalificacion
	Route::post('pre_calificadosjf/show/upsolicitudPE','PersonaController@upsolicitudPE');//update de la solicitud para precalificacion
	Route::post('pre_calificadosjf/show/upsolicitudPD','PersonaController@upsolicitudPD');//update de la solicitud para precalificacion
	Route::post('pre_calificadosjf/show/upsolicitudPEL','PersonaController@upsolicitudPEL');//update de la solicitud para precalificacion
	Route::post('pre_calificadosjf/show/upsolicitudPR','PersonaController@upsolicitudPR');//update de la solicitud para precalificacion
	Route::post('pre_calificadosjf/show/upsolicitudPF','PersonaController@upsolicitudPF');//update de la solicitud para precalificacion
	Route::post('pre_calificadosjf/show/upsolicitudPA','PersonaController@upsolicitudPA');//update de la solicitud para precalificacion

	//Preentrevistados
	Route::get('pre_entrevistado','RHPreentrevista@listadopreE');
	Route::get('pre_entrevistadoji','RHPreentrevista@prelistadojf');
	Route::get('upPreentrevista/{id}/{ids?}','RHPreentrevista@upPreentrevista');
	//Route::get('rechazo/{id}/{ids?}','SController@rechazo');
	Route::get('preentre/{id}','RHPreentrevista@preentre');
	Route::post('preentre/prentrevista','RHPreentrevista@prentrevista');
	Route::get('preentre/towns/{id}', 'RHPreentrevista@getTowns');
	Route::post('preentre/adicionalacad','RHPreentrevista@adicionalacad');
	Route::post('preentre/agregarexperiencia','RHPreentrevista@agregarexperiencia');
	Route::get('pre_entrevistado/show/{id}','RHPreentrevista@show');
	Route::get('PDFpre/{id}','RHPreentrevista@PDFpre');
	
	Route::post('pre_entrevistado/show/upt/','SController@upt');// agregar una observacion

		Route::post('pre_entrevistado/show/expcomentaro/','PersonaController@expcomentaro');// agregar una observacion experiencia
		Route::post('pre_entrevistado/show/refcomentario/','PersonaController@refcomentario');// agregar una observacion referencia

	Route::post('pre_entrevistado/show/upsolicitud','PersonaController@upsolicitud');//update de la solicitud para precalificacion
	Route::post('pre_entrevistado/show/upsolicitudPE','PersonaController@upsolicitudPE');//update de la solicitud para precalificacion
	Route::post('pre_entrevistado/show/upsolicitudPD','PersonaController@upsolicitudPD');//update de la solicitud para precalificacion
	Route::post('pre_entrevistado/show/upsolicitudPEL','PersonaController@upsolicitudPEL');//update de la solicitud para precalificacion
	Route::post('pre_entrevistado/show/upsolicitudPR','PersonaController@upsolicitudPR');//update de la solicitud para precalificacion
	Route::post('pre_entrevistado/show/upsolicitudPF','PersonaController@upsolicitudPF');//update de la solicitud para precalificacion
	Route::post('pre_entrevistado/show/upsolicitudPA','PersonaController@upsolicitudPA');//update de la solicitud para precalificacion

	//Precalificar
	Route::get('precalificar/{id}','RHPrecalificado@precalificar');
	Route::get('pre_calificados','RHPrecalificado@listadopreC');
	Route::get('pre_calificadosjf','RHPrecalificado@listadopreCjf');
	Route::get('pre_calificados/show/{id}','RHPrecalificado@show');
	Route::get('precali/{id}','RHPrecalificado@precali');
	Route::post('precali/prentrevista','RHPreentrevista@prentrevista');
	Route::get('precali/towns/{id}', 'RHPreentrevista@getTowns');
	Route::post('precali/adicionalacad','RHPreentrevista@adicionalacad');
	Route::post('precali/agregarexperiencia','RHPreentrevista@agregarexperiencia');
	Route::get('PDFpreC/{id}','RHPrecalificado@PDFpreC');
		Route::post('pre_calificados/show/upt/','SController@upt');// agregar una observacion 

			Route::post('pre_calificados/show/expcomentaro/','PersonaController@expcomentaro');// agregar una observacion experiencia
			Route::post('pre_calificados/show/refcomentario/','PersonaController@refcomentario');// agregar una observacion referencia

		Route::post('pre_calificados/show/upsolicitud','PersonaController@upsolicitud');//update de la solicitud para precalificacion
		Route::post('pre_calificados/show/upsolicitudPE','PersonaController@upsolicitudPE');//update de la solicitud para precalificacion
		Route::post('pre_calificados/show/upsolicitudPD','PersonaController@upsolicitudPD');//update de la solicitud para precalificacion
		Route::post('pre_calificados/show/upsolicitudPEL','PersonaController@upsolicitudPEL');//update de la solicitud para precalificacion
		Route::post('pre_calificados/show/upsolicitudPR','PersonaController@upsolicitudPR');//update de la solicitud para precalificacion
		Route::post('pre_calificados/show/upsolicitudPF','PersonaController@upsolicitudPF');//update de la solicitud para precalificacion
		Route::post('pre_calificados/show/upsolicitudPA','PersonaController@upsolicitudPA');//update de la solicitud para precalificacion

	//Evaluaciones
	Route::get('busquedaeva/{dato?}','RHEvaluciones@busquedaevaluacion');//dssdsd//
	Route::get('envioaevaluar/{id}/{ids?}','RHEvaluciones@envioaevaluar');
	Route::get('resultados','RHEvaluciones@listadoev');
	Route::get('resultados/show/{id}','RHEvaluciones@show');
	Route::post('agregarnota','RHEvaluciones@agregarnota');
	Route::get('nombrelist/{id}','RHEvaluciones@nombrelist');
	Route::get('resultadosev','RHEvaluciones@listadores');
	Route::get('resultadosev/listadotablares/{id}','RHEvaluciones@listadotablares');
	Route::get('entrevista/{id}','RHEntrevista@entrevista');
	Route::get('listadoen','RHEntrevista@listadoentrevista');
		Route::post('resultados/show/upt/','SController@upt');// agregar una observacion

			Route::post('resultados/show/expcomentaro/','PersonaController@expcomentaro');// agregar una observacion experiencia
			Route::post('resultados/show/refcomentario/','PersonaController@refcomentario');// agregar una observacion referencia

		Route::post('resultados/show/upsolicitud','PersonaController@upsolicitud');//update de la solicitud para precalificacion
		Route::post('resultados/show/upsolicitudPE','PersonaController@upsolicitudPE');//update de la solicitud para precalificacion
		Route::post('resultados/show/upsolicitudPD','PersonaController@upsolicitudPD');//update de la solicitud para precalificacion
		Route::post('resultados/show/upsolicitudPEL','PersonaController@upsolicitudPEL');//update de la solicitud para precalificacion
		Route::post('resultados/show/upsolicitudPR','PersonaController@upsolicitudPR');//update de la solicitud para precalificacion
		Route::post('resultados/show/upsolicitudPF','PersonaController@upsolicitudPF');//update de la solicitud para precalificacion
		Route::post('resultados/show/upsolicitudPA','PersonaController@upsolicitudPA');//update de la solicitud para precalificacion

	//Entrevita
	Route::get('listadoen','RHEntrevista@listadoentrevista');
	Route::get('listadoen/show/{id}','RHEntrevista@show');
	Route::get('entrevistarh/{id}','RHEntrevista@entrevistarh');
	Route::post('entrevistarh/prentrevista','RHPreentrevista@prentrevista');
	Route::get('entrevistarh/towns/{id}', 'RHPreentrevista@getTowns');
	Route::post('entrevistarh/adicionalacad','RHPreentrevista@adicionalacad');
	Route::post('entrevistarh/agregarexperiencia','RHPreentrevista@agregarexperiencia');
	Route::get('nombramiento1/{id}','RHEntrevista@nombramiento1');
	Route::get('PDFEntre/{id}','RHEntrevista@PDFEntre');
		Route::post('listadoen/show/upt/','SController@upt');// agregar una observacion 

		Route::post('listadoen/show/expcomentaro/','PersonaController@expcomentaro');// agregar una observacion experiencia
		Route::post('listadoen/show/refcomentario/','PersonaController@refcomentario');// agregar una observacion referencia

		Route::post('listadoen/show/upsolicitud','PersonaController@upsolicitud');//update de la solicitud para precalificacion
		Route::post('listadoen/show/upsolicitudPE','PersonaController@upsolicitudPE');//update de la solicitud para precalificacion
		Route::post('listadoen/show/upsolicitudPD','PersonaController@upsolicitudPD');//update de la solicitud para precalificacion
		Route::post('listadoen/show/upsolicitudPEL','PersonaController@upsolicitudPEL');//update de la solicitud para precalificacion
		Route::post('listadoen/show/upsolicitudPR','PersonaController@upsolicitudPR');//update de la solicitud para precalificacion
		Route::post('listadoen/show/upsolicitudPF','PersonaController@upsolicitudPF');//update de la solicitud para precalificacion
		Route::post('listadoen/show/upsolicitudPA','PersonaController@upsolicitudPA');//update de la solicitud para precalificacion

	//Nombramiento
	Route::get('listadon1','RHEntrevista@listadonombramiento');
	Route::get('listadon1/show/{id}','RHNombramientoEmpleado@show');

	Route::post('listadon1/show/expcomentaro/','PersonaController@expcomentaro');// agregar una observacion experiencia
		Route::post('listadon1/show/refcomentario/','PersonaController@refcomentario');// agregar una observacion referencia

		Route::post('listadon1/show/upsolicitud','PersonaController@upsolicitud');//update de la solicitud para precalificacion
		Route::post('listadon1/show/upsolicitudPE','PersonaController@upsolicitudPE');//update de la solicitud para precalificacion
		Route::post('listadon1/show/upsolicitudPD','PersonaController@upsolicitudPD');//update de la solicitud para precalificacion
		Route::post('listadon1/show/upsolicitudPEL','PersonaController@upsolicitudPEL');//update de la solicitud para precalificacion
		Route::post('listadon1/show/upsolicitudPR','PersonaController@upsolicitudPR');//update de la solicitud para precalificacion
		Route::post('listadon1/show/upsolicitudPF','PersonaController@upsolicitudPF');//update de la solicitud para precalificacion
		Route::post('listadon1/show/upsolicitudPA','PersonaController@upsolicitudPA');//update de la solicitud para precalificacion

	//Reporte
	Route::get('Rmintrab','Controllermintrab@index');

	
	Route::post('cambiar_password', 'UController@cambiar_password');

        
	Route::get('solicitud','PerController@solicitud');


    
    //rutas de solicitud de vacaciones y permisos


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
	Route::post('Gpdf','VController@Gpdf');


	//Rutas de la solicitud de empleo
	Route::resource('solicitante','SController'); 	// SController = SolicitanteController
	Route::get('Spdf/{id}', 'SController@Spdf');
	Route::get('perfil','PerController@index');		// PerController = PerfilController
	Route::get('contacto','PerController@contacto');
	//Rechazos de eempleados rutas
	Route::get('rechazo/{id}/{ids?}','SController@rechazo');
	Route::get('rechazope/{id}/{ids?}','SController@rechazope');
	Route::get('rechazopc/{id}/{ids?}','SController@rechazopc');
	Route::get('rechazoe/{id}/{ids?}','SController@rechazoe');
	Route::get('rechazoet/{id}/{ids?}','SController@rechazoet');
	Route::get('rechazon/{id}/{ids?}','SController@rechazon');
	Route::get('rechazojf/{id}/{ids?}','SController@rechazojf');
	Route::get('rechazopej/{id}/{ids?}','SController@rechazopej');
	Route::get('rechazojpc/{id}/{ids?}','SController@rechazojpc');
	//Route::get();
	Route::get('rechazoPP/{id}','SController@rechazoPP');
	Route::get('rechazoPI/{id}','SController@rechazoPI');
	
	Route::post('solicitante/upt/','SController@upt');// agregar una observacion
	
	Route::post('solicitante/expcomentaro/','PersonaController@expcomentaro');// agregar una observacion experiencia
	Route::post('solicitante/refcomentario/','PersonaController@refcomentario');// agregar una observacion referencia
	
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
	Route::get('reclutamiento','RHReclutamiento@listadoR');
	Route::get('autorizaciones','JIPermiso@indexdirector'); /// solicitud de vacaciones y permisos de los empleados que tiene un jefe x.
	Route::get('solicitadoVP','JIPermiso@index');
	Route::get('vautorizado','VacacionesController@indexautorizado')->middleware('roleshinobi:jefeinmediato');/////
	Route::get('rechazado/{pag?}','JIPermiso@indexrechazado')->middleware('roleshinobi:jefeinmediato');
	Route::get('confirmado/{page?}','JIPermiso@indexconfirmado')->middleware('roleshinobi:jefeinmediato');


	//Rutas de validacion de permisos y vacaciones JI

	Route::get('verificar/{idpersona}','JIPermiso@verificar')->middleware('roleshinobi:jefeinmediato');
	Route::post('verificar/enviarpermiso','JIPermiso@enviarpermiso')->middleware('roleshinobi:jefeinmediato');
	Route::get('confirmado','JIPermiso@indexconfirmado')->middleware('roleshinobi:jefeinmediato');
	Route::get('rechazado','JIPermiso@indexrechazado')->middleware('roleshinobi:jefeinmediato');

	Route::get('busquedaindexsolicitadoJI/{tipoausencia}/{dato?}','JIPermiso@busquedasolicitados');
	Route::get('busquedaindexaceptadoJI/{tipoausencia}/{dato?}','JIPermiso@busquedaconfirmados');
	Route::get('busquedaindexrechazadoJI/{tipoausencia}/{dato?}','JIPermiso@busquedarechazados');



	Route::get('detalleconfirmado/{idpersona}','JIPermiso@detalleconfirmado')->middleware('roleshinobi:jefeinmediato');
	Route::get('detallerechazado/{idpersona}','JIPermiso@detallerechazado')->middleware('roleshinobi:jefeinmediato');

//Solicita plaza vacante de un puesto en un afiliado.
	Route::get('plazavacante','JIvacante@add')->middleware('roleshinobi:jefeinmediato');
	Route::post('addplazavacante','JIvacante@store')->middleware('roleshinobi:jefeinmediato');

//Reportes
	Route::get('reporteEmpleado','Reporte@index')->middleware('roleshinobi:reporte');

//Excel
	Route::get('reporteEmpleadoExcel','Reporte@Empleadoexcel')->middleware('roleshinobi:reporte');

	//FotoController@agregarimagen
	//Route::put('/colaboradores/{id}',['uses' => 'Colaboradores@update', 'middleware' => 'auth']);

});

Route::get('totalvacaciones','RHMintrab@ttvacaciones');


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


Route::get('seguridad/usuario', 'PCUsuarioController@contenedor')->middleware('roleshinobi:informatica');

Route::get('seguridad/usuarios/{page?}','PCUsuarioController@index')->middleware('roleshinobi:informatica');
Route::get('seguridad/usuario/create','PCUsuarioController@add')->middleware('roleshinobi:informatica');
Route::post('seguridad/usuario/store','PCUsuarioController@store')->middleware('roleshinobi:informatica');
Route::get('seguridad/usuario/editar_usuario/{id}', 'PCUsuarioController@editar_usuario')->middleware('roleshinobi:informatica');
Route::delete('destroy/{id}','PCUsuarioController@destroy')->middleware('roleshinobi:informatica');
Route::get('asignar_rol/{idusu}/{idrol}', 'PCUsuarioController@asignar_rol')->middleware('roleshinobi:informatica');
Route::get('quitar_rol/{idusu}/{idrol}','PCUsuarioController@quitar_rol')->middleware('roleshinobi:informatica');
Route::get('cambiarclave/{id}/{clave}','PCUsuarioController@cambiarclave')->middleware('roleshinobi:informatica');

//Route::get('form_nuevo_usuario', 'UsuariosController@form_nuevo_usuario');
Route::get('seguridad/usuario/form_nuevo_rol', 'PCUsuarioController@form_nuevo_rol')->middleware('roleshinobi:informatica');
Route::get('seguridad/buscar_usuarios/{rol}/{dato?}', 'PCUsuarioController@buscar_usuarios'); 

Route::post('crear_rol', 'PCUsuarioController@crear_rol')->middleware('roleshinobi:informatica');
Route::get('borrar_rol/{idrol}', 'PCUsuarioController@borrar_rol')->middleware('roleshinobi:informatica');



