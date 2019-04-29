<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Imports\AlumnoImport;
use Excel;
use App\Alumno;

class EstudianteController extends Controller
{
    public function ver_estudiante_index(){
      if (Auth::check()){
  			return view('estudiante.verestudiante',
  			[
  				'consulta'		=> null
  			]);
  		} else {
  		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
  		 return redirect()->route('home');
  		}
    }

    public function ver_estudiante_consulta(request $request)
	{
		if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'tipobusqueda' 	=> 'required|int',
				'busqueda' 	=> 'required'
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}
			//dd($request);
			switch ($request->tipobusqueda) {
				case 1:
					$sql = "SELECT NUMERODOC,PRIMERNOMBRE,SEGUNDONOMBRE,PRIMERAPELLIDO,SEGUNDOAPELLIDO,FECHANAC,DIRECCION,BARRIO,DEPARTAMENTO,MUNICIPIO, ACUDIENTE,PARENTESCO
						FROM alumnos al
						WHERE CONCAT(primernombre,' ',segundonombre) like '%$request->busqueda%'
						order by 1 asc";
					break;
				case 2:
					$sql = "SELECT NUMERODOC,PRIMERNOMBRE,SEGUNDONOMBRE,PRIMERAPELLIDO,SEGUNDOAPELLIDO,FECHANAC,DIRECCION,BARRIO,DEPARTAMENTO,MUNICIPIO, ACUDIENTE,PARENTESCO
						FROM alumnos
						WHERE numerodoc = $request->busqueda
						order by 1 asc";
					break;

				default:
					# code...
					break;
			}
      $sql2 = "select * from familia where numerodoc = $request->busqueda";
			$datos_consulta = DB::connection('mysql')->select( DB::raw($sql));
      $dato_familiares = DB::connection('mysql')->select( DB::raw($sql2));

			//dd($datos_consulta);
			//dd($consolidado);

			return view('estudiante.verestudiante',
			[
			    'tipobusqueda'  => $request->tipobusqueda,
			    'busqueda'     => $request->busqueda,
          'datofamilia' => $dato_familiares,
			    'consulta'      => $datos_consulta
			]);
		} else {
			return redirect()->route('home');
		}
	}

	public function ver_datos_estudiante(request $request){
		if (Auth::check()){
			$validacion = Validator::make($request->all(), [
				'ano' 	=> 'required|int',
				'curso' 	=> 'required'
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}
			$sql="SELECT CONCAT(primernombre,' ',segundonombre,' ',primerapellido,' ',segundoapellido) nombrecompleto
						,ma.ano,ma.curso,al.numerodoc,ma.codmatricula,ma.jornada
						FROM alumnos al LEFT JOIN matricula ma ON al.numerodoc = ma.codide
						WHERE al.numerodoc = $request->busqueda
						order by ma.ano desc";
			$datos_consulta = DB::connection('mysql')->select( DB::raw($sql));

			return view('estudiante.verestudiante',
			[
			    'tipobusqueda'  => $request->tipobusqueda,
			    'busqueda'     => $request->busqueda,
			    'consulta'      => $datos_consulta
			]);

			//dd($request);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');


		 return redirect()->route('home');
		}
	}

	public function edit_estudiante_update(request $request){
		if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'new_nombre1' 	=> 'required',
				'new_nombre2' 	=> 'required',
				'new_apellido1' 	=> 'required',
				'new_apellido2' 	=> 'required',
				'new_barrio' 	=> 'required',
				'new_direccion' 	=> 'required',
				'new_acudiente' 	=> 'required',
				'new_parentesco' 	=> 'required'
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}
			//dd($request);
			$n = DB::connection('mysql')->update(DB::RAW("
                update alumnos set primernombre= '$request->new_nombre1', segundonombre= '$request->new_nombre2', primerapellido= '$request->new_apellido1', segundoapellido = '$request->new_apellido2', direccion = '$request->new_direccion', barrio = '$request->new_barrio', acudiente = '$request->new_acudiente', parentesco = '$request->new_parentesco' where numerodoc = '$request->id_estudiante'"
            ));
            //dd($n);
			 if ($n){
			 	$flash = array(
                    'color'=> 'green',
                    'text' => 'Actualización de Datos Correcta'
                );
			 }
			 else{
			 	$flash = array(
                    'color'=> 'orange',
                    'text' => 'Error al actualizar, favor revisar datos'
                );
			 }

			//dd($datos_consulta);
			//dd($consulta);

			return view('estudiante.verestudiante',
			[
				'flash'		=> $flash
			]);
		} else {
			return redirect()->route('home');
		}
	}

	public function ver_estudiantexcurso_index(){
    	if (Auth::check()){
			return view('estudiante.verestudiantexcurso',
			[
				'consulta'		=> null
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }

    public function ver_estudiantexcurso_consulta(request $request)
	{
		if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'ano' 	=> 'required|int',
				'curso' 	=> 'required'
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}
			//dd($request);
			$sql = "SELECT m.*,CONCAT(al.primernombre,' ',al.segundonombre,' ',al.primerapellido,' ',al.segundoapellido) as NOMBRECOMPLETO
FROM matricula m LEFT JOIN alumnos al ON m.codide = al.numerodoc where m.ano = $request->ano and m.curso = '$request->curso'";

			$datos_consulta = DB::connection('mysql')->select( DB::raw($sql));

			//dd($datos_consulta);
			//dd($consolidado);

			return view('estudiante.verestudiantexcurso',
			[
			    'ano'  => $request->ano,
			    'curso'     => $request->curso,
			    'consulta'      => $datos_consulta
			]);
		} else {
			return redirect()->route('home');
		}
	}

	public function registrar_estudiante_index(){
    	if (Auth::check()){
			return view('estudiante.registrar_estudiante',
			[
				'consulta'		=> null
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }

    public function registrar_estudiante_consulta(request $request){
    	if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'tipodocumento' 	=> 'required',
				'identificacion' 	=> 'required|int',
				'expedicion' 	=> 'required',
				'primernombre' 	=> 'required',
				'primerapellido' 	=> 'required',
				'segundoapellido' 	=> 'required',
				'fechanac' 	=> 'required',
				'lugarnac' 	=> 'required',
				'telefono' 	=> 'required|int',
				'direccion' 	=> 'required',
				'barrio' 	=> 'required',
				'municipio' 	=> 'required',
				'departamento' 	=> 'required',
				'acudiente' 	=> 'required',
				'parentesco' 	=> 'required',
				'direccionfam' 	=> 'required',
				'telefonofam' 	=> 'required|int'
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}
			try{
				$alumno = new Alumno();
				$alumno->docide = $request->tipodocumento;
				$alumno->numerodoc = $request->identificacion;
				$alumno->primernombre = $request->primernombre;
				if(isset($request->segundonombre)){
					$alumno->segundonombre = $request->segundonombre;
				}
				$alumno->primerapellido = $request->primerapellido;
				$alumno->segundoapellido = $request->segundoapellido;
				$alumno->fechanac = $request->fechanac;
				$alumno->lugarnac = $request->lugarnac;
				$alumno->lugarexp = $request->expedicion;
				$alumno->direccion = $request->direccion;
				$alumno->departamento = $request->departamento;
				$alumno->municipio = $request->municipio;
				$alumno->barrio = $request->barrio;
				$alumno->telefono = $request->telefono;
				$alumno->acudiente = $request->acudiente;
				$alumno->parentesco = $request->parentesco;
				$alumno->telefonofami = $request->telefonofam;
				$alumno->direccionfami = $request->direccionfam;
				$alumno->save();
				$flash = array(
                    'color'=> 'green',
                    'text' => 'Registro de Estudiante realizado correctamente'
                );
                return view('estudiante.registrar_estudiante',
					[
						'flash'		=> $flash
					]);
			}catch(\Exception $ex){
				//dd($ex);
				if($ex->errorInfo[0]==23000){
					$errorMessage="Ya se encuentra un estudiante registrado con ese documento";
				}
				else{
					$errorMessage=$ex->message;
				}
				return redirect()->back()->withInput()->withErrors($errorMessage);
			}



		} else {
			return redirect()->route('home');
		}
    }

	public function upload_estudiante_index(){
    	if (Auth::check()){
			return view('estudiante.upload_estudiante',
			[
				'consulta'		=> null
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }

    public function upload_estudiante_consulta(request $request){
    	if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'archivo' 	=> 'required'
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}
			//dd($request);
			try{
				Excel::import(new AlumnoImport, request()->file('archivo'));
				$flash = array(
                    'color'=> 'green',
                    'text' => 'Información Ingresada Correctamente a BD'
                );
			}catch(\Exception $ex){
				$errorMessage = $ex->errorInfo[2];
				return redirect()->back()->withInput()->withErrors($errorMessage);
			}



			/*$array = Excel::toArray(new NotasPrimariaImport, request()->file('archivo'));

			dd($array);*/

			return view('estudiante.upload_estudiante',
			[
			    'flash'     => $flash,
			    'archivo'      => $request->archivo
			]);
		} else {
			return redirect()->route('home');
		}
    }

}
