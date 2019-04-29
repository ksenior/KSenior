<?php

namespace App\Http\Controllers;

use App\Familiar;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;


class FamiliarController extends Controller
{
  public function registrar_familiar(Request $request){
    if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'identificacion' 	=> 'required|int',
				'nombre' 	=> 'required',
        'apellido1' 	=> 'required',
        'apellido2' 	=> 'required',
        'docpadre' 	=> 'required|int',
        'direccion' => 'required',
        'parentesco' => 'required',
        'telefono' => 'required|int'
			]);

			if ($validacion->fails())
			{
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}
      try{
				$familia = new Familiar();
				$familia->numerodoc = $request->identificacion;
				$familia->nombre = $request->nombre;
				if(isset($request->apellido2)){
					$familia->segundoapellido = $request->apellido2;
				}
				$familia->primerapellido = $request->apellido1;
				$familia->direccion = $request->direccion;
				$familia->docpadre = $request->docpadre;
				$familia->direccion = $request->direccion;
				$familia->telefono1 = $request->telefono;
        $familia->parentesco = $request->parentesco;
				$familia->save();
				$flash = array(
                    'color'=> 'green',
                    'text' => 'Registro de Padre realizado correctamente'
                );
                return view('estudiante.verestudiante',
					[
						'flash'		=> $flash
					]);
			}catch(\Exception $ex){
				dd($ex);
				if($ex->errorInfo[0]==23000){
					$errorMessage="Este familiar ya se encuentra registrado";
				}
				else{
					$errorMessage=$ex->message;
				}
				return redirect()->back()->withInput()->withErrors($errorMessage);
			}

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
}
