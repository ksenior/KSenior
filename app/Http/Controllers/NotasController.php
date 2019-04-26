<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\NotasPrimariaImport;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Excel;

class NotasController extends Controller
{
    public function ver_notaestudiante_index(){
    	if (Auth::check()){
			return view('notas.vernotaestudiante',
			[
				'consulta'		=> null	
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }

    public function ver_notaestudiante_consulta(request $request){
    	if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'busqueda' 	=> 'required'
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}	
			//dd($request);
			$sql = "SELECT np.*,CONCAT(al.primernombre,' ',al.segundonombre,' ',al.primerapellido,' ',al.segundoapellido) as NOMBRECOMPLETO FROM notas np LEFT JOIN alumnos al ON al.numerodoc = np.numerodoc where np.numerodoc = $request->busqueda";
			$datos_consulta = DB::connection('mysql')->select( DB::raw($sql));

			//dd($datos_consulta);
			//dd($consolidado);
			
			return view('notas.vernotaestudiante',
			[
			    'busqueda'     => $request->busqueda,
			    'consulta'      => $datos_consulta
			]);
		} else {
			return redirect()->route('home');
		}
    }

    public function ver_notacurso_index(){
    	if (Auth::check()){
			return view('notas.vernotacurso',
			[
				'consulta'		=> null	
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }

    public function ver_notacurso_consulta(request $request){
    	if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'ano' 	=> 'required',
				'curso' 	=> 'required'
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}	
			//dd($request);
			$sql = "SELECT np.*,CONCAT(al.primernombre,' ',al.segundonombre,' ',al.primerapellido,' ',al.segundoapellido) as NOMBRECOMPLETO FROM notas np LEFT JOIN alumnos al ON al.numerodoc = np.numerodoc where np.ano = $request->ano and np.curso = '$request->curso' order by np.NUMERODOC,np.PERIODO asc";
			$datos_consulta = DB::connection('mysql')->select( DB::raw($sql));

			//dd($datos_consulta);
			//dd($consolidado);
			
			return view('notas.vernotacurso',
			[
			    'ano'     => $request->ano,
			    'curso'     => $request->curso,
			    'consulta'      => $datos_consulta
			]);
		} else {
			return redirect()->route('home');
		}
    }

    public function ver_excel_index(){
    	if (Auth::check()){
			return view('notas.ver_excel',
			[
				'consulta'		=> null	
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }

    public function ver_excel_consulta(request $request){
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
				Excel::import(new NotasPrimariaImport, request()->file('archivo'));
				$flash = array(
                    'color'=> 'green',
                    'text' => 'Información Ingresada Correctamente a BD'
                );
			}catch(\Exception $ex){
				$errorMessage = $ex->errorInfo[2];
				return redirect()->back()->withInput()->withErrors($errorMessage);
			}
			
			return view('notas.ver_excel',
			[
			    'flash'     => $flash,
			    'archivo'      => $request->archivo
			]);
		} else {
			return redirect()->route('home');
		}
    }
}
