@extends('layouts.app')

@section('title','Consulta Observaciones Estudiante')

@section('contenido')
    @if(isset($consulta))
    @endif

    <br>
	@if (!isset($busqueda))
        <center>
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 22px 32px 22px 32px; border: 1px solid #EEE; width: 50%">
            @if (isset($flash))
                <div class="card-panel notifications {{ $flash['color'] }}">
                <span class="white-text">{{ $flash['text'] }}</span>
                </div>
                <br>
            @endif
            <h5 class="blue-text text-darken-4">Datos de Estudiante</h5><br>
            {{ Form::open(['action' => 'ObservacionesController@ver_observacionesxestudiante_consulta']) }}
                <div class="row">
                     @if ($errors->any())
                        <div class="help-block red-text">         
                        @foreach ($errors->all() as $error)
                                <strong>{{ $error }}<br></strong>
                        @endforeach
                        </div>
                    @endif
                    <div class="col s6">
                        <h6 class="blue-text text-darken-4">Identificacion Estudiante</h6>
                        <input type="number" name="busqueda" id="busqueda" required="required">
                    </div>
                    <div class="col s6">
                        <h6 class="blue-text text-darken-4">Año</h6>
                        <input type="number" name="ano" id="ano" required="required">
                    </div>
                </div>
                <div class="row">
                        <button class="btn center waves-effect waves-light blue darken-4" type="submit" name="action">Consultar</button>    
                    </div>
            {{ Form::close()}}
        </div>
        </center>
	@else<div class="row">
            <div class="col s6">
                <div class="card horizontal hoverable">
                    <div class="card-stacked">
                        <div class="card-content">
                            <h6><b>DATOS DE CONSULTA:</b></h6>
                            <h6><b>Documento: </b>{!! $busqueda !!}</h6>
                            <h6><b>Año: </b>{!! $ano !!}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="divider"></div>
        
        @if ($consulta == null)
            <h4>No hay datos para mostrar</h4>
        @else
            <table id="tabla_datos" class="striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>AÑO</th>
                    <th>CURSO</th>
                    <th>NUMERO DOCUMENTO</th>
                    <th>NOMBRE COMPLETO</th>
                    <th>PERIODO</th>
                    <th>OBSERVACION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consulta as $key)
                    <tr>
                        <td>{!! $key->ANO !!}</td>
                        <td>{!! $key->CURSO !!}</td>
                        <td>{!! $key->NUMERODOC  !!}</td>
                        <td>{!! $key->NOMBRECOMPLETO !!}</td>
                        <td>{!! $key->PERIODO !!}</td>
                        <td>{!! $key->OBSERVACION !!}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        @endif
		<div class="fixed-action-btn">
    		<a href="{{ route('observaciones.ver_observacionesxestudiante') }}" class="btn-floating btn-large blue darken-4">
    			<i class="large material-icons">mode_edit</i>
    		</a>
		</div>
	@endif

@endsection
