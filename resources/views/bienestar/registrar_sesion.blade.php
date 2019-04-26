@extends('layouts.app')

@section('title','Registrar Sesión')

@section('contenido')
    @if(isset($consulta))
    @endif
    @if (!isset($identificacion))
    <br>
    <center>
    <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 22px 32px 22px 32px; border: 1px solid #EEE; width: 40%">
        <h5 class="blue-text text-darken-4">Datos de Sesión Estudiantil</h5><br>
        {{ Form::open(['action' => 'BienestarController@buscar_ausencia_consulta', 'method' => 'PUT']) }}
            {{csrf_field()}}
            <div class="row">
                @if (isset($flash))
                    <div class="card-panel notifications {{ $flash['color'] }}">
                    <span class="white-text">{{ $flash['text'] }}</span>
                    </div>
                    <br>
                @endif
                 @if ($errors->any())
                    <div class="help-block red-text">         
                    @foreach ($errors->all() as $error)
                            <strong>{{ $error }}<br></strong>
                    @endforeach
                    </div>
                @endif
                <div class="col s12">
                    <h6 class="blue-text text-darken-4">identificacion</h6>
                    <input type="number" name="identificacion" id="identificacion" required="required">
                </div>
                <input type="hidden" name="opcion" value="6"> <!-- 5 PARA REGISTRO CITACION -->
            </div>
            <div class="row">
                <button class="btn center waves-effect waves-light blue darken-4" type="submit" name="action">Consultar</button>    
            </div>
        {{ Form::close()}}
    </div>
    </center>
    @else
    
    <div class="row">
        <div class="col s6">
            <div class="card horizontal hoverable">
                <div class="card-stacked">
                    <div class="card-content">
                        <h6><b>DATOS DE CONSULTA:</b></h6>
                        <h6><b>Documento: </b>{!! $identificacion !!}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($consulta == null)
        <h4>No hay datos para mostrar</h4>
    @else
    <center>
    <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 22px 32px 22px 32px; border: 1px solid #EEE; width: 80%">
        <h5 class="blue-text text-darken-4">Datos de Sesión Estudiantil</h5><br>
        {{ Form::open(['action' => 'BienestarController@registrar_sesion_consulta', 'method' => 'POST']) }}
            {{csrf_field()}}
            <div class="row">
                @if (isset($flash))
                    <div class="card-panel notifications {{ $flash['color'] }}">
                    <span class="white-text">{{ $flash['text'] }}</span>
                    </div>
                    <br>
                @endif
                 @if ($errors->any())
                    <div class="help-block red-text">         
                    @foreach ($errors->all() as $error)
                            <strong>{{ $error }}<br></strong>
                    @endforeach
                    </div>
                @endif
                <div class="col s12">
                    @foreach ($consulta as $key)
                    @endforeach                    
                    <div class="row">
                        <div class="col s4 m4 l4">
                            <h6 class="blue-text text-darken-4">Numero Documento</h6>
                            <input type="text" name="documento" id="documento" value="{{ $key->numerodoc }}" readonly="readonly">
                        </div>
                        <div class="col s4 m4 l4">
                            <h6 class="blue-text text-darken-4">NOMBRE COMPLETO</h6>
                            <input type="text" name="nombre" id="nombre" value="{{ $key->nombrecompleto }}" readonly="readonly">
                        </div>
                        <div class="col s1 m1 l1">
                            <h6 class="blue-text text-darken-4">AÑO</h6>
                            <input type="text" name="ano" id="ano" value="{{ $key->ano }}" readonly="readonly">
                        </div>
                        <div class="col s1 m1 l1">
                            <h6 class="blue-text text-darken-4">CURSO</h6>
                            <input type="text" name="curso" id="curso" value="{{ $key->curso }}" readonly="readonly">
                        </div>
                        <div class="col s2 m2 l2">
                            <h6 class="blue-text text-darken-4">JORNADA</h6>
                            <input type="text" name="jornada" id="jornada" value="{{ $key->jornada }}" readonly="readonly">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l2">
                            <h6 class="blue-text text-darken-4">Fecha Sesión</h6>
                            <input type="date" name="fecha" id="fecha" required="required">
                        </div>
                        <div class="col l2">
                            <h6 class="blue-text text-darken-4">Período</h6>
                            <select name="periodo" id="periodo">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="col l3">
                            <h6 class="blue-text text-darken-4">Psicologa</h6>
                            <input type="text" name="docente" id="docente" required="required">
                        </div>
                        <div class="col l5">
                            <h6 class="blue-text text-darken-4">Motivo</h6>
                            <input type="text" name="motivo"  required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l6">
                            <h6 class="blue-text text-darken-4">Observaciones</h6>
                            <textarea name="observaciones" class="materialize-textarea"></textarea>
                        </div>
                        <div class="input-field col l6">
                            <h6 class="blue-text text-darken-4">COMPROMISO</h6>
                            <textarea name="compromiso" class="materialize-textarea"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <button class="btn center waves-effect waves-light blue darken-4" type="submit" name="action">Registrar</button>    
            </div>
        {{ Form::close()}}
    @endif
    </div>
    </center>
    <div class="fixed-action-btn">
        <a href="{{ route('bienestar.registrar_sesion') }}" class="btn-floating btn-large blue darken-4">
            <i class="large material-icons">mode_edit</i>
        </a>
    </div>
    @endif
            

@endsection
