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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('home', 'HomeController@index')->name('home');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'boletines'], function() {
	Route::get('verboletin','BoletinController@ver_boletin_index')->name('boletines.verboletin');
	Route::post('verboletin','BoletinController@ver_boletin_consulta');
	Route::get('verboletinxcurso','BoletinController@ver_boletinxcurso_index')->name('boletines.verboletinxcurso');
	Route::post('verboletinxcurso','BoletinController@ver_boletinxcurso_consulta');
	});

Route::group(['prefix' => 'estudiante'], function() {
	Route::get('verestudiante','EstudianteController@ver_estudiante_index')->name('estudiante.verestudiante');
	Route::post('verestudiante','EstudianteController@ver_estudiante_consulta');
	Route::get('verestudiantexcurso','EstudianteController@ver_estudiantexcurso_index')->name('estudiante.verestudiantexcurso');
	Route::post('verestudiantexcurso','EstudianteController@ver_estudiantexcurso_consulta');
	Route::get('editestudiante','EstudianteController@edit_estudiante_index')->name('estudiante.editestudiante');
	Route::post('editstudiante','EstudianteController@edit_estudiante_update');

	Route::get('upload_estudiante','EstudianteController@upload_estudiante_index')->name('estudiante.upload_estudiante');
	Route::post('upload_estudiante','EstudianteController@upload_estudiante_consulta');
	Route::get('registrar_estudiante','EstudianteController@registrar_estudiante_index')->name('estudiante.registrar_estudiante');
	Route::post('registrar_estudiante','EstudianteController@registrar_estudiante_consulta');

	});

Route::group(['prefix' => 'notas'], function() {
	Route::get('vernotaestudiante','NotasController@ver_notaestudiante_index')->name('notas.vernotaestudiante');
	Route::post('vernotaestudiante','NotasController@ver_notaestudiante_consulta');
	Route::get('ver_excel','NotasController@ver_excel_index')->name('notas.ver_excel');
	Route::post('ver_excel','NotasController@ver_excel_consulta');
	Route::get('vernotacurso','NotasController@ver_notacurso_index')->name('notas.vernotacurso');
	Route::post('vernotacurso','NotasController@ver_notacurso_consulta');

	});

Route::group(['prefix' => 'fallas'], function() {
	Route::get('upload_fallas','FallasController@upload_fallas_index')->name('fallas.upload_fallas');
	Route::post('upload_fallas','FallasController@upload_fallas_consulta');
	Route::get('ver_fallasxcurso','FallasController@ver_fallasxcurso_index')->name('fallas.ver_fallasxcurso');
	Route::post('ver_fallasxcurso','FallasController@ver_fallasxcurso_consulta');
	Route::get('ver_fallasxestudiante','FallasController@ver_fallasxestudiante_index')->name('fallas.ver_fallasxestudiante');
	Route::post('ver_fallasxestudiante','FallasController@ver_fallasxestudiante_consulta');
	});


Route::group(['prefix' => 'matricula'], function() {
	Route::get('upload_matricula','MatriculaController@upload_excel_index')->name('matricula.upload_matricula');
	Route::post('upload_matricula','MatriculaController@upload_excel_consulta');
	Route::get('registrar_matricula','MatriculaController@registrar_matricula_index')->name('matricula.registrar_matricula');
	Route::post('registrar_matricula','MatriculaController@registrar_matricula_consulta');
	});

//OBSERVACIONES
Route::group(['prefix' => 'observaciones'], function() {
	Route::get('upload_observacion','ObservacionesController@upload_observacion_index')->name('observaciones.upload_observacion');
	Route::post('upload_observacion','ObservacionesController@upload_observacion_consulta');
	Route::get('ver_observacionesxestudiante','ObservacionesController@ver_observacionesxestudiante_index')->name('observaciones.ver_observacionesxestudiante');
	Route::post('ver_observacionesxestudiante','ObservacionesController@ver_observacionesxestudiante_consulta');
	});


//DISCIPLINA
Route::group(['prefix' => 'disciplina'], function() {
	Route::get('upload_disciplina','DisciplinaController@upload_disciplina_index')->name('disciplina.upload_disciplina');
	Route::post('upload_disciplina','DisciplinaController@upload_disciplina_consulta');
	Route::get('ver_disciplinaxestudiante','DisciplinaController@ver_disciplinaxestudiante_index')->name('disciplina.ver_disciplinaxestudiante');
	Route::post('ver_disciplinaxestudiante','DisciplinaController@ver_disciplinaxestudiante_consulta');
	});


//BIENESTAR

//AUSENCIA
Route::group(['prefix' => 'bienestar'], function() {
	Route::get('registrar_ausencia','BienestarController@buscar_ausencia_index')->name('bienestar.registrar_ausencia');
	Route::put('registrar_ausencia','BienestarController@buscar_ausencia_consulta');
	Route::post('registrar_ausencia','BienestarController@registrar_ausencia_consulta');

	Route::get('ver_registros','BienestarController@ver_registros_index')->name('bienestar.ver_registros');
	Route::put('ver_registros','BienestarController@buscar_registros_consulta');
	Route::get('view_ausencia','BienestarController@view_registros_consulta');

	Route::get('registrar_visita','BienestarController@buscar_visita_index')->name('bienestar.registrar_visita');
	Route::put('registrar_visita','BienestarController@buscar_ausencia_consulta');
	Route::post('registrar_visita','BienestarController@registrar_visita_consulta');

	Route::get('registrar_conflicto','BienestarController@buscar_conflicto_index')->name('bienestar.registrar_conflicto');
	Route::put('registrar_conflicto','BienestarController@buscar_ausencia_consulta');
	Route::post('registrar_conflicto','BienestarController@registrar_conflicto_consulta');
	
	Route::get('registrar_compromiso','BienestarController@buscar_compromiso_index')->name('bienestar.registrar_compromiso');
	Route::put('registrar_compromiso','BienestarController@buscar_ausencia_consulta');
	Route::post('registrar_compromiso','BienestarController@registrar_compromiso_consulta');

	Route::get('registrar_citacion','BienestarController@buscar_citacion_index')->name('bienestar.registrar_citacion');
	Route::put('registrar_citacion','BienestarController@buscar_ausencia_consulta');
	Route::post('registrar_citacion','BienestarController@registrar_citacion_consulta');

	Route::get('registrar_sesion','BienestarController@buscar_sesion_index')->name('bienestar.registrar_sesion');
	Route::put('registrar_sesion','BienestarController@buscar_ausencia_consulta');
	Route::post('registrar_sesion','BienestarController@registrar_sesion_consulta');	

	Route::get('registrar_entrevista','BienestarController@buscar_entrevista_index')->name('bienestar.registrar_entrevista');
	Route::put('registrar_entrevista','BienestarController@buscar_ausencia_consulta');
	Route::post('registrar_entrevista','BienestarController@registrar_entrevista_consulta');	
	});


Route::get('generate-pdf','BoletinController@generate_pdf')->name('generate-pdf');


//Auth::routes();






