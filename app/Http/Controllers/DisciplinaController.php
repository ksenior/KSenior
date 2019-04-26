<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Imports\DisciplinaImport;
use Excel;
use DB;
use Auth;
use Exception;

class DisciplinaController extends Controller
{
	public function ver_disciplinaxestudiante_index  (){
    	if (Auth::check()){
			return view('disciplina.ver_disciplinaxestudiante',
			[
				'consulta'		=> null	
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }


    public function ver_disciplinaxestudiante_consulta (request $request)
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
			$sql="select ANO,getCurso(ano,numerodoc) CURSO,NUMERODOC,getFullName(NUMERODOC) NOMBRECOMPLETO,PERIODO,getTipoObservacion(codobservacion) OBSERVACION FROM disciplina where ano = $request->ano and numerodoc = $request->busqueda ";

			$datos_consulta = DB::connection('mysql')->select( DB::raw($sql));

			//dd($datos_consulta);
			//dd($consolidado);
			
			return view('disciplina.ver_disciplinaxestudiante',
			[
			    'ano'  => $request->ano,
			    'busqueda'     => $request->busqueda,
			    'consulta'      => $datos_consulta
			]);
		} else {
			return redirect()->route('home');
		}
	}

    public function upload_disciplina_index(){
    	if (Auth::check()){
			return view('disciplina.upload_disciplina',
			[
				'consulta'		=> null	
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }

    public function upload_disciplina_consulta(request $request){
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
				Excel::import(new DisciplinaImport, request()->file('archivo'));	
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
			
			return view('disciplina.upload_disciplina',
			[
			    'flash'     => $flash,
			    'archivo'      => $request->archivo
			]);
		} else {
			return redirect()->route('home');
		}
    }
}
