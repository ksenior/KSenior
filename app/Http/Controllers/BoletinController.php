<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;
use Illuminate\Support\Facades\Validator;
use DB;
use App\helpers;


class BoletinController extends Controller
{
    public function ver_boletin_index(){
    	if (Auth::check()){
			return view('boletines.verboletin',
			[
				'hora_fin'		=> null,
				'consulta'		=> null	
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }
    public function ver_boletin_consulta(request $request)
	{
		if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'busqueda' 	=> 'required',
				'periodo' => 'required|int',
				'entrega' => 'required'
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}	
			//dd($request);
			$sql = "select getFullName(ma.codide) nombrecompleto
				,ma.ano,ma.curso,ma.codide numerodoc,ma.codmatricula,ma.jornada				
				FROM matricula ma 
				WHERE ma.codide = $request->busqueda
				order by ma.ano desc";
			$datos_consulta = DB::connection('mysql')->select( DB::raw($sql));

			//dd($datos_consulta);
			//dd($consolidado);
			
			return view('boletines.verboletin',
			[
			    'periodo'  => $request->periodo,
			    'busqueda'     => $request->busqueda,
			    'fechaentrega' => $request->entrega,
			    'consulta'      => $datos_consulta
			]);
		} else {
			return redirect()->route('home');
		}
	}
    	
    public function ver_boletinxcurso_index(){
    	if (Auth::check()){
			return view('boletines.verboletinxcurso',
			[
				'hora_fin'		=> null,
				'consulta'		=> null	
			]);
		} else {
		 //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
		 return redirect()->route('home');
		}
    }

    public function ver_boletinxcurso_consulta(request $request)
	{
		if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'ano' 	=> 'required|int',
				'periodo' 	=> 'required|int',
				'curso' 	=> 'required',
				'fecha' => 'required'
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}	
			//dd($request);
			$cant=strlen($request->curso);
			$numcurso = substr($request->curso,0,$cant-1);
			if($numcurso==1 || $numcurso==2){
				$cantmateria=5;
			}
			else{
				$cantmateria=6;
			}	
			$sql="SELECT getFullName(ma.codide) nombrecompleto
						,ma.ano,ma.curso,ma.codide numerodoc,ma.codmatricula,ma.jornada				
						FROM matricula ma 
						WHERE ma.curso = '$request->curso'
						and ma.ano = $request->ano
						order by 1 ASC";
			$dato_estudiante = DB::connection('mysql')->select(  DB::raw($sql));

			//dd($sql);
			//dd($consolidado);
			if(count($dato_estudiante)>0){
				$data = ['curso' => $numcurso, 'cantmateria' => $cantmateria, 'datoestudiante' => $dato_estudiante,'fecha' => $request->fecha,'periodo' => $request->periodo];
				if($numcurso<6){
					$pdf = PDF::loadView('myPDFPrim_curso', $data);	
				}
				else{
					$pdf = PDF::loadView('myPDFBachi_curso', $data);	
				}
		        $pdf->setPaper("legal", "portrait");
		        //$pdf->set_paper(array(0,0,500,1000));
				//$pdf->render();
		        return $pdf->stream('Boletin_curso_'.$request->ano.'_'.$request->curso.'.pdf');	
			}
			else{
				$flash = array(
                    'color'=> 'blue',
                    'text' => 'No hay estudiantes matriculados para este curso'
                );
				return view('boletines.verboletinxcurso',
				[
					'flash'		=> $flash,
					'consulta'		=> null	
				]);
			}
			
			
		} else {
			return redirect()->route('home');
		}
	}

	public function generate_pdf(request $request)
	{
		if (Auth::check()){
			//dd($request);
			$validacion = Validator::make($request->all(), [
				'ano' 	=> 'required|int',
				'periodo' 	=> 'required|int',
				'curso' 	=> 'required',
				'fecha' => 'required',
				'documento' => 'required|int'
			]);

			if ($validacion->fails())
			{
				//Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
				return redirect()->back()->withInput()->withErrors($validacion->errors());
			}	
			//dd($request);
			$cant=strlen($request->curso);
			$numcurso = substr($request->curso,0,$cant-1);
			if($numcurso==1 || $numcurso==2){
				$cantmateria=5;
			}
			else{
				$cantmateria=6;
			}	
			$sql="SELECT getFullName(ma.codide) nombrecompleto
						,ma.ano,ma.curso,ma.codide numerodoc,ma.codmatricula,ma.jornada				
						FROM matricula ma 
						WHERE ma.curso = '$request->curso' 
						and ma.ano = $request->ano 
						and ma.codide = $request->documento 
						order by 1 ASC";
			$dato_estudiante = DB::connection('mysql')->select(  DB::raw($sql));

			if(count($dato_estudiante)>0){
				$data = ['curso' => $numcurso, 'cantmateria' => $cantmateria, 'datoestudiante' => $dato_estudiante,'fecha' => $request->fecha,'periodo' => $request->periodo];
				if($numcurso<6){
					$pdf = PDF::loadView('myPDFPrim_curso', $data);	
				}
				else{
					$pdf = PDF::loadView('myPDFBachi_curso', $data);	
				}
		        $pdf->setPaper("legal", "portrait");
		        //$pdf->set_paper(array(0,0,500,1000));
				//$pdf->render();
		        return $pdf->stream('Boletin_curso_'.$request->ano.'_'.$request->curso.'.pdf');	
			}
			else{
				$flash = array(
                    'color'=> 'blue',
                    'text' => 'No hay registro de matricula para este estudiante'
                );
				return view('boletines.verboletin',
				[
					'flash'		=> $flash,
					'consulta'		=> null	
				]);
			}
			
			
		} else {
			return redirect()->route('home');
		}	
	}
	public function generate_pdf2(request $request)
	{
		//dd($request);



		$datonotas = DB::connection('mysql')->select(  DB::raw("
            SELECT VW_notas.*,VW_FALLAS.fallasp1,VW_FALLAS.fallasp2,VW_FALLAS.fallasp3,VW_FALLAS.fallasp4 FROM (
			SELECT n.ano,n.idcurso,CONCAT(cu.numerocurso,gr.nombre) curso,n.numerodoc,n.idasignatura,ar.id idarea,ar.nombre,periodo1,periodo2,periodo3,periodo4
			FROM notas n 
			LEFT JOIN cursos cu ON cu.id = n.idcurso
			LEFT JOIN grupo gr ON gr.id = n.idgrupo
			LEFT JOIN asignaturas asi ON asi.id = n.idasignatura
			LEFT JOIN areas ar ON asi.idarea = ar.id) VW_NOTAS
			, (
				SELECT n.ano,n.idcurso,CONCAT(cu.numerocurso,gr.nombre) curso,n.numerodoc,n.idasignatura,ar.id idarea,ar.nombre,periodo1 fallasp1,periodo2 fallasp2,periodo3 fallasp3,periodo4 fallasp4
				FROM fallas n 
				LEFT JOIN cursos cu ON cu.id = n.idcurso
				LEFT JOIN grupo gr ON gr.id = n.idgrupo
				LEFT JOIN asignaturas asi ON asi.id = n.idasignatura
				LEFT JOIN areas ar ON asi.idarea = ar.id
			) VW_FALLAS
			WHERE VW_NOTAS.ano = VW_FALLAS.ano
			AND VW_NOTAS.idcurso = VW_FALLAS.idcurso
			AND VW_NOTAS.curso = VW_FALLAS.curso
			AND VW_NOTAS.numerodoc = VW_FALLAS.numerodoc
			AND VW_NOTAS.idasignatura = VW_FALLAS.idasignatura
			"));
		$sql = "SELECT * FROM observaciones
			WHERE numerodoc = $request->documento and ano = $request->ano";
		//dd($sql);

		$observaciones=DB::connection('mysql')->select(  DB::raw($sql));
		$data = ['nombre' => $request->nombre, 'codmatricula' => $request->codmatricula, 'jornada' => $request->jornada, 'grado' => $request->grado, 'datonotas' => $datonotas, 'observaciones' => $observaciones];
        $pdf = PDF::loadView('myPDFPrim', $data);
        //$pdf->setPaper("legal", "portrait");
        $pdf->set_paper(array(0,0,500,1000));
		$pdf->render();
        return $pdf->stream('Boletin.pdf');
	}
}
