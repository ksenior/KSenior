<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Imports\FallasImport;
use Excel;
use DB;
use Auth;
use Exception;

class FallasController extends Controller
{

	public function ver_fallasxestudiante_index  (){
    	if (Auth::check()){
			return view('fallas.ver_fallasxestudiante',
			[
				'consulta'		=> null	
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }


    public function ver_fallasxestudiante_consulta (request $request)
	{
		if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'busqueda' 	=> 'required|int',
				'ano' 	=> 'required|int',
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}	
			//dd($request);
			$sql="select getFullName(numerodoc) NOMBRECOMPLETO, f.* FROM FALLAS f where ano = $request->ano and numerodoc = $request->busqueda ";

			$datos_consulta = DB::connection('mysql')->select( DB::raw($sql));

			//dd($datos_consulta);
			//dd($consolidado);
			
			return view('fallas.ver_fallasxestudiante',
			[
			    'ano'  => $request->ano,
			    'busqueda'     => $request->busqueda,
			    'consulta'      => $datos_consulta
			]);
		} else {
			return redirect()->route('home');
		}
	}

	public function ver_fallasxcurso_index  (){
    	if (Auth::check()){
			return view('fallas.ver_fallasxcurso',
			[
				'consulta'		=> null	
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }


    public function ver_fallasxcurso_consulta (request $request)
	{
		if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'ano' 	=> 'required|int',
				'curso' 	=> 'required',
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}	
			//dd($request);
			$sql="select getFullName(numerodoc) NOMBRECOMPLETO, f.* FROM FALLAS f where ano = $request->ano and curso = '$request->curso' ";

			$datos_consulta = DB::connection('mysql')->select( DB::raw($sql));

			//dd($datos_consulta);
			//dd($consolidado);
			
			return view('fallas.ver_fallasxcurso',
			[
			    'curso'  => $request->curso,
			    'ano'     => $request->ano,
			    'consulta'      => $datos_consulta
			]);
		} else {
			return redirect()->route('home');
		}
	}

    public function upload_fallas_index(){
    	if (Auth::check()){
			return view('fallas.upload_fallas',
			[
				'consulta'		=> null	
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }

    public function upload_fallas_consulta(request $request){
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
				Excel::import(new FallasImport, request()->file('archivo'));	
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
			
			return view('fallas.upload_fallas',
			[
			    'flash'     => $flash,
			    'archivo'      => $request->archivo
			]);
		} else {
			return redirect()->route('home');
		}
    }
}
