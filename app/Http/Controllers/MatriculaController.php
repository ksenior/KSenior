<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Imports\MatriculasImport;
use Excel;
use DB;
use Auth;
use Exception;
use App\Matricula;

class MatriculaController extends Controller
{
    public function upload_excel_index(){
    	if (Auth::check()){
			return view('matricula.upload_matricula_excel',
			[
				'consulta'		=> null	
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }

    public function upload_excel_consulta(request $request){
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
				Excel::import(new MatriculasImport, request()->file('archivo'));	
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
			
			return view('matricula.upload_matricula_excel',
			[
			    'flash'     => $flash,
			    'archivo'      => $request->archivo
			]);
		} else {
			return redirect()->route('home');
		}
    }

    public function registrar_matricula_index(){
    	if (Auth::check()){
			return view('matricula.registrar_matricula',
			[
				'consulta'		=> null	
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }

    public function registrar_matricula_consulta(request $request){
    	if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'ano' 	=> 'required|int',
				'curso' 	=> 'required',
				'identificacion' 	=> 'required|int',
				'codmatricula' 	=> 'required|int',
				'jornada' 	=> 'required',
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}
			try{
				$matricula = new Matricula();
				$matricula->ano = $request->ano;
				$matricula->curso = $request->curso;
				$matricula->codide = $request->identificacion;
				$matricula->codmatricula = $request->codmatricula;
				$matricula->jornada = $request->jornada;
				$matricula->save();
				$flash = array(
                    'color'=> 'green',
                    'text' => 'Registro de Matricula realizado correctamente'
                );
                return view('matricula.registrar_matricula',
					[
						'flash'		=> $flash
					]);
			}catch(\Exception $ex){
				return redirect()->back()->withInput()->withErrors($errorMessage);
			}

			

		} else {
			return redirect()->route('home');
		}
    }
}
