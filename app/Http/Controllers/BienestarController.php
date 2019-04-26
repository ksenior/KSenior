<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;
use Illuminate\Support\Facades\Validator;
use DB;
use App\helpers;
use App\Registros;

class BienestarController extends Controller
{
    
    public function buscar_ausencia_index()
    {
        if (Auth::check()){
            return view('bienestar.registrar_ausencia',
            [
                'hora_fin'      => null,
                'consulta'      => null 
            ]);
        } else {
         //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
         return redirect()->route('home');
        }
    }
    public function buscar_ausencia_consulta(request $request)
    {
        if (Auth::check()){
            //dd($request);
            $validacion = Validator::make($request->all(), [
                'identificacion' => 'required|int',
                'opcion' => 'required|int'
            ]);

            if ($validacion->fails())
            {
                //Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
                return redirect()->back()->withInput()->withErrors($validacion->errors());
            }   
            //dd($request);
            $ano = date("Y");
            $sql = "select getFullName(ma.codide) nombrecompleto, al.acudiente, al.parentesco 
                ,ma.ano,ma.curso,ma.codide numerodoc,ma.codmatricula,ma.jornada             
                FROM matricula ma 
                INNER JOIN alumnos al ON ma.codide = al.numerodoc 
                WHERE ma.codide = $request->identificacion
                and ma.ano = $ano
                order by ma.ano desc";
            $datos_consulta = DB::connection('mysql')->select( DB::raw($sql));

            //dd($datos_consulta);
            //dd($consolidado);
            switch ($request->opcion) {
                case 1:
                    return view('bienestar.registrar_ausencia',
                    [
                        'identificacion'  => $request->identificacion,
                        'consulta'      => $datos_consulta
                    ]);
                    break;
                case 2:
                    return view('bienestar.registrar_visita',
                    [
                        'identificacion'  => $request->identificacion,
                        'consulta'      => $datos_consulta
                    ]);
                    break;
                case 3:
                    return view('bienestar.registrar_compromiso',
                    [
                        'identificacion'  => $request->identificacion,
                        'consulta'      => $datos_consulta
                    ]);
                    break;
                case 4:
                    return view('bienestar.registrar_conflicto',
                    [
                        'identificacion'  => $request->identificacion,
                        'consulta'      => $datos_consulta
                    ]);
                    break;
                case 5:
                    return view('bienestar.registrar_citacion',
                    [
                        'identificacion'  => $request->identificacion,
                        'consulta'      => $datos_consulta
                    ]);
                case 6:
                    return view('bienestar.registrar_sesion',
                    [
                        'identificacion'  => $request->identificacion,
                        'consulta'      => $datos_consulta
                    ]);
                case 7:
                    return view('bienestar.registrar_entrevista',
                    [
                        'identificacion'  => $request->identificacion,
                        'consulta'      => $datos_consulta
                    ]);
                    break;
                default:
                    return redirect()->route('home');
                    break;
            }
        } else {
            return redirect()->route('home');
        }
    }
    public function registrar_ausencia_consulta(request $request)
    {
        //dd($request);
        if (Auth::check()){
            //dd($request);
            $validacion = Validator::make($request->all(), [
                'documento' => 'required|int',
                'nombre' => 'required',
                'jornada' => 'required',
                'curso' => 'required',
                'acudiente' => 'required',
                'parentesco' => 'required',
                'periodo' => 'required',
                'dias' => 'required|int',
                'fecha' => 'required',
                'motivo' => 'required'
            ]);

            if ($validacion->fails())
            {
                //Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
                return redirect()->back()->withInput()->withErrors($validacion->errors());
            }   
            //dd($request);
            $ausencia = new Registros;
            $ausencia->ano = $request->ano;
            $ausencia->curso = $request->curso;
            $ausencia->periodo = $request->periodo;
            $ausencia->docestudiante = $request->documento;
            $ausencia->acudiente = $request->acudiente;
            $ausencia->parentesco = $request->parentesco;
            $ausencia->numerodias = $request->dias;
            $ausencia->fecha = $request->fecha;
            $ausencia->motivo = $request->motivo;
            $ausencia->tiporeg = 'AUSENCIA';
            if($ausencia->save()){
                $flash = array(
                    'color'=> 'blue',
                    'text' => 'Ausencia registrada correctamente'
                );
            }
            else{
                $flash = array(
                    'color'=> 'red',
                    'text' => 'Error al registrar ausencia'
                );
            }
            
            return view('bienestar.registrar_ausencia',
            [
                'flash' => $flash,
                'identificacion'  => $request->identificacion
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function ver_registros_index()
    {
        if (Auth::check()){
            return view('bienestar.ver_registros',
            [
                'consulta'      => null 
            ]);
        } else {
         //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
         return redirect()->route('home');
        }
    }

    public function buscar_registros_consulta(request $request)
    {
        if (Auth::check()){
            //dd($request);
            $validacion = Validator::make($request->all(), [
                'identificacion' => 'required|int',
                'ano' => 'required|int'
            ]);

            if ($validacion->fails())
            {
                //Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
                return redirect()->back()->withInput()->withErrors($validacion->errors());
            }   
            //dd($request);
            $sql_ausencia = "SELECT * FROM registros
                WHERE docestudiante = $request->identificacion
                AND ano = $request->ano";

            $datos_registros = DB::connection('mysql')->select( DB::raw($sql_ausencia));
            //dd($datos_ausencia);
            //dd($datos_consulta);
            //dd($consolidado);
            
            return view('bienestar.ver_registros',
            [
                'identificacion'  => $request->identificacion,
                'ano'  => $request->ano,
                'registros'      => $datos_registros,
                'otros' => null
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function view_registros_consulta(request $request)
    {
        if (Auth::check()){
            //dd($request);
            $validacion = Validator::make($request->all(), [
                'documento'   => 'required|int',
                'ano'   => 'required|int',
                'fecha' => 'required',
                'opcion' => 'required|int',
                'tiporeg' => 'required',
            ]);

            if ($validacion->fails())
            {
                //Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
                return redirect()->back()->withInput()->withErrors($validacion->errors());
            }
            $sql="SELECT getFullName(docestudiante) nombrecompleto, m.jornada,b.* FROM registros b
                    RIGHT JOIN matricula m ON (m.codide = b.docestudiante AND m.curso = b.curso AND m.ano = b.ano)
                    WHERE b.docestudiante = $request->documento
                    AND b.ano = $request->ano
                    AND b.tiporeg = '$request->tiporeg'
                    and b.fecha = '$request->fecha'";
            $dato_estudiante = DB::connection('mysql')->select(  DB::raw($sql));
            if(count($dato_estudiante)>0){
                switch ($request->opcion) {
                    case 1:
                        $data = ['datoausencia' => $dato_estudiante];
                        $pdf = PDF::loadView('formatos.ausencia', $data);     
                        $pdf->setPaper("letter", "portrait");
                        return $pdf->stream('Formato_Ausencia_'.$request->documento.'_'.$request->fecha.'.pdf'); 
                        break;
                    case 2:
                        $data = ['datovisita' => $dato_estudiante];
                        $pdf = PDF::loadView('formatos.visita', $data);        
                        $pdf->setPaper("letter", "portrait");
                        return $pdf->stream('Formato_Visita_'.$request->documento.'_'.$request->fecha.'.pdf'); 
                        break;
                    case 3:
                        $data = ['datocompromiso' => $dato_estudiante];
                        $pdf = PDF::loadView('formatos.compromiso', $data);        
                        $pdf->setPaper("letter", "portrait");
                        return $pdf->stream('Formato_Compromiso_'.$request->documento.'_'.$request->fecha.'.pdf'); 
                        break;
                    case 4:
                        $data = ['datoconflicto' => $dato_estudiante];
                        $pdf = PDF::loadView('formatos.conflictos', $data);        
                        $pdf->setPaper("letter", "portrait");
                        return $pdf->stream('Formato_Conflictos_'.$request->documento.'_'.$request->fecha.'.pdf'); 
                        break;
                    case 5:
                        $data = ['datocitacion' => $dato_estudiante];
                        $pdf = PDF::loadView('formatos.citacion', $data);        
                        $pdf->setPaper("letter", "portrait");
                        return $pdf->stream('Formato_Citacion_'.$request->documento.'_'.$request->fecha.'.pdf'); 
                        break;
                    case 6:
                        $data = ['datosesion' => $dato_estudiante];
                        $pdf = PDF::loadView('formatos.sesiones', $data);        
                        $pdf->setPaper("letter", "portrait");
                        return $pdf->stream('Formato_Sesion_'.$request->documento.'_'.$request->fecha.'.pdf'); 
                        break;
                    case 7:
                        $data = ['datosesion' => $dato_estudiante];
                        $pdf = PDF::loadView('formatos.entrevista', $data);        
                        $pdf->setPaper("letter", "portrait");
                        return $pdf->stream('Formato_Entrevista_'.$request->documento.'_'.$request->fecha.'.pdf'); 
                        break;
                    default:
                        # code...
                        break;
                }
            }
            else{
                $flash = array(
                    'color'=> 'red',
                    'text' => 'No hay registros para este estudiante'
                );
                return view('bienestar.ver_registros',
                [
                    'flash'     => $flash,
                    'consulta'      => null 
                ]);
            }
            
            
        } else {
            return redirect()->route('home');
        }
    }

    public function buscar_visita_index()
    {
        if (Auth::check()){
            return view('bienestar.registrar_visita',
            [
                'hora_fin'      => null,
                'consulta'      => null 
            ]);
        } else {
         //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
         return redirect()->route('home');
        }
    }
    

    public function registrar_visita_consulta(request $request)
    {
        //dd($request);
        if (Auth::check()){
            //dd($request);
            $validacion = Validator::make($request->all(), [
                'documento' => 'required|int',
                'nombre' => 'required',
                'curso' => 'required',
                'acudiente' => 'required',
                'periodo' => 'required',
                'fecha' => 'required',
                'motivo' => 'required',
            ]);

            if ($validacion->fails())
            {
                //Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
                return redirect()->back()->withInput()->withErrors($validacion->errors());
            }   
            //dd($request);
            $visita = new Registros;
            $visita->ano = $request->ano;
            $visita->curso = $request->curso;
            $visita->periodo = $request->periodo;
            $visita->docestudiante = $request->documento;
            $visita->acudiente = $request->acudiente;
            $visita->fecha = $request->fecha;
            $visita->motivo = $request->motivo;
            $visita->tiporeg = 'DOMICILIARIO';
            if($visita->save()){
                $flash = array(
                    'color'=> 'blue',
                    'text' => 'Visita registrada correctamente'
                );
            }
            else{
                $flash = array(
                    'color'=> 'red',
                    'text' => 'Error al registrar visita'
                );
            }
            
            return view('bienestar.registrar_visita',
            [
                'flash' => $flash,
                'identificacion'  => $request->identificacion
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function buscar_compromiso_index()
    {
        if (Auth::check()){
            return view('bienestar.registrar_compromiso',
            [
                'hora_fin'      => null,
                'consulta'      => null 
            ]);
        } else {
         //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
         return redirect()->route('home');
        }
    }

    public function registrar_compromiso_consulta(request $request)
    {
        //dd($request);
        if (Auth::check()){
            //dd($request);
            $validacion = Validator::make($request->all(), [
                'documento' => 'required|int',
                'nombre' => 'required',
                'curso' => 'required',
                'periodo' => 'required|int',
                'fecha' => 'required',
                'compromiso' => 'required',
                'correctivo' => 'required',
            ]);

            if ($validacion->fails())
            {
                //Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
                return redirect()->back()->withInput()->withErrors($validacion->errors());
            }   
            //dd($request);
            $visita = new Registros;
            $visita->ano = $request->ano;
            $visita->curso = $request->curso;
            $visita->periodo = $request->periodo;
            $visita->docestudiante = $request->documento;
            $visita->fecha = $request->fecha;
            $visita->compromiso = $request->compromiso;
            $visita->tiporeg = $request->correctivo;
            if($visita->save()){
                $flash = array(
                    'color'=> 'blue',
                    'text' => 'Compromiso registrado correctamente'
                );
            }
            else{
                $flash = array(
                    'color'=> 'red',
                    'text' => 'Error al registrar Compromiso'
                );
            }
            
            return view('bienestar.registrar_compromiso',
            [
                'flash' => $flash,
                'identificacion'  => $request->identificacion
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function buscar_conflicto_index()
    {
        if (Auth::check()){
            return view('bienestar.registrar_conflicto',
            [
                'hora_fin'      => null,
                'consulta'      => null 
            ]);
        } else {
         //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
         return redirect()->route('home');
        }
    }

    public function registrar_conflicto_consulta(request $request)
    {
        //dd($request);
        if (Auth::check()){
            //dd($request);
            $validacion = Validator::make($request->all(), [
                'documento' => 'required|int',
                'nombre' => 'required',
                'curso' => 'required',
                'periodo' => 'required|int',
                'fecha' => 'required',
                'vestudiante' => 'required',
                'vdocente' => 'required',
                'vfamilia' => 'required',
                'observacion' => 'required',
                'correctivo' => 'required',
            ]);

            if ($validacion->fails())
            {
                //Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
                return redirect()->back()->withInput()->withErrors($validacion->errors());
            }   
            //dd($request);
            $visita = new Registros;
            $visita->ano = $request->ano;
            $visita->curso = $request->curso;
            $visita->periodo = $request->periodo;
            $visita->docestudiante = $request->documento;
            $visita->fecha = $request->fecha;
            $visita->versionestudiante = $request->vestudiante;
            $visita->versiondocente = $request->vdocente;
            $visita->versionfamilia = $request->vfamilia;
            $visita->observacion = $request->observacion;
            $visita->correctivo = $request->correctivo;
            $visita->motivo = $request->motivo;
            $visita->docente = $request->docente;
            $visita->tiporeg = 'CONFLICTO';
            if($visita->save()){
                $flash = array(
                    'color'=> 'blue',
                    'text' => 'Compromiso registrado correctamente'
                );
            }
            else{
                $flash = array(
                    'color'=> 'red',
                    'text' => 'Error al registrar Compromiso'
                );
            }
            
            return view('bienestar.registrar_compromiso',
            [
                'flash' => $flash,
                'identificacion'  => $request->identificacion
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function buscar_citacion_index()
    {
        if (Auth::check()){
            return view('bienestar.registrar_citacion',
            [
                'hora_fin'      => null,
                'consulta'      => null 
            ]);
        } else {
         //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
         return redirect()->route('home');
        }
    }

    public function registrar_citacion_consulta(request $request)
    {
        //dd($request);
        if (Auth::check()){
            //dd($request);
            $validacion = Validator::make($request->all(), [
                'documento' => 'required|int',
                'nombre' => 'required',
                'curso' => 'required',
                'periodo' => 'required|int',
                'fecha' => 'required',
                'acudiente' => 'required',
                'citacion' => 'required',
                'correctivo' => 'required',
                'compromiso' => 'required',
                'motivo' => 'required',
            ]);

            if ($validacion->fails())
            {
                //Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
                return redirect()->back()->withInput()->withErrors($validacion->errors());
            }   
            //dd($request);
            $citacion = new Registros;
            $citacion->ano = $request->ano;
            $citacion->curso = $request->curso;
            $citacion->periodo = $request->periodo;
            $citacion->docestudiante = $request->documento;
            $citacion->acudiente = $request->acudiente;
            $citacion->fecha = $request->fecha;
            $citacion->tiporeg = 'CITACION';
            $citacion->tipocit = $request->citacion;
            $citacion->correctivo = $request->correctivo;
            $citacion->compromiso = $request->compromiso;
            $citacion->motivo = $request->motivo;
            if($citacion->save()){
                $flash = array(
                    'color'=> 'blue',
                    'text' => 'Citación registrada correctamente'
                );
            }
            else{
                $flash = array(
                    'color'=> 'red',
                    'text' => 'Error al registrar citación'
                );
            }
            
            return view('bienestar.registrar_citacion',
            [
                'flash' => $flash,
                'identificacion'  => $request->identificacion
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function buscar_sesion_index()
    {
        if (Auth::check()){
            return view('bienestar.registrar_sesion',
            [
                'hora_fin'      => null,
                'consulta'      => null 
            ]);
        } else {
         //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
         return redirect()->route('home');
        }
    }

    public function registrar_sesion_consulta(request $request)
    {
        //dd($request);
        if (Auth::check()){
            //dd($request);
            $validacion = Validator::make($request->all(), [
                'documento' => 'required|int',
                'nombre' => 'required',
                'curso' => 'required',
                'periodo' => 'required|int',
                'fecha' => 'required',
                'docente' => 'required',
                'observaciones' => 'required',
                'compromiso' => 'required',
                'motivo' => 'required',
            ]);

            if ($validacion->fails())
            {
                //Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
                return redirect()->back()->withInput()->withErrors($validacion->errors());
            }   
            //dd($request);
            $sesion = new Registros;
            $sesion->ano = $request->ano;
            $sesion->curso = $request->curso;
            $sesion->periodo = $request->periodo;
            $sesion->docestudiante = $request->documento;
            $sesion->docente = $request->docente;
            $sesion->fecha = $request->fecha;
            $sesion->tiporeg = 'SESION';
            $sesion->observacion = $request->observaciones;
            $sesion->compromiso = $request->compromiso;
            $sesion->motivo = $request->motivo;
            if($sesion->save()){
                $flash = array(
                    'color'=> 'blue',
                    'text' => 'Sesión registrada correctamente'
                );
            }
            else{
                $flash = array(
                    'color'=> 'red',
                    'text' => 'Error al registrar sesión'
                );
            }
            
            return view('bienestar.registrar_citacion',
            [
                'flash' => $flash,
                'identificacion'  => $request->identificacion
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function buscar_entrevista_index()
    {
        if (Auth::check()){
            return view('bienestar.registrar_entrevista',
            [
                'hora_fin'      => null,
                'consulta'      => null 
            ]);
        } else {
         //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
         return redirect()->route('home');
        }
    }

    public function registrar_entrevista_consulta(request $request)
    {
        //dd($request);
        if (Auth::check()){
            //dd($request);
            $validacion = Validator::make($request->all(), [
                'documento' => 'required|int',
                'nombre' => 'required',
                'curso' => 'required',
                'periodo' => 'required|int',
                'fecha' => 'required',
                'docente' => 'required',
                'acudiente' => 'required',
                'observaciones' => 'required',
                'conclusiones' => 'required',
                'motivo' => 'required',
            ]);

            if ($validacion->fails())
            {
                //Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|SIRBQ/Gerencia Operativa/Recarga x dia x Medio de Pago|Acceso a reporte '.$validacion->errors());
                return redirect()->back()->withInput()->withErrors($validacion->errors());
            }   
            //dd($request);
            $entrevista = new Registros;
            $entrevista->ano = $request->ano;
            $entrevista->curso = $request->curso;
            $entrevista->periodo = $request->periodo;
            $entrevista->docestudiante = $request->documento;
            $entrevista->docente = $request->docente;
            $entrevista->acudiente = $request->acudiente;
            $entrevista->fecha = $request->fecha;
            $entrevista->tiporeg = 'ENTREVISTA';
            $entrevista->observacion = $request->observaciones;
            $entrevista->compromiso = $request->conclusiones;
            $entrevista->motivo = $request->motivo;
            if($entrevista->save()){
                $flash = array(
                    'color'=> 'blue',
                    'text' => 'Entrevista registrada correctamente'
                );
            }
            else{
                $flash = array(
                    'color'=> 'red',
                    'text' => 'Error al registrar entrevista'
                );
            }
            
            return view('bienestar.registrar_entrevista',
            [
                'flash' => $flash,
                'identificacion'  => $request->identificacion
            ]);
        } else {
            return redirect()->route('home');
        }
    }

}
