@extends('layouts.app')

@section('title','Consulta Fallas x Curso')

@section('contenido')
    @if(isset($consulta))
    @endif

    <br>
	@if (!isset($ano))
        <center>
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 22px 32px 22px 32px; border: 1px solid #EEE; width: 50%">
            @if (isset($flash))
                <div class="card-panel notifications {{ $flash['color'] }}">
                <span class="white-text">{{ $flash['text'] }}</span>
                </div>
                <br>
            @endif
            <h5 class="blue-text text-darken-4">Datos de Curso</h5><br>
            {{ Form::open(['action' => 'FallasController@ver_fallasxcurso_consulta']) }}
                <div class="row">
                     @if ($errors->any())
                        <div class="help-block red-text">         
                        @foreach ($errors->all() as $error)
                                <strong>{{ $error }}<br></strong>
                        @endforeach
                        </div>
                    @endif
                    <div class="col s6">
                        <h6 class="blue-text text-darken-4">AÑO</h6>
                        <input type="number" name="ano" id="ano" required="required">
                    </div>
                    <div class="col s6">
                        <h6 class="blue-text text-darken-4">CURSO</h6>
                        <input type="text" name="curso" id="curso" required="required">
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
                            <h6><b>Curso: </b>{!! $curso !!}</h6>
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
                    <th>PERIODO</th>
                    <th>NUMERODOCUMENTO</th>
                    <th>NOMBRECOMPLETO</th>
                    <th>CASTELLANO</th>
                    <th>MATEMATICA</th>
                    <th>NATURALES</th>
                    <th>SOCIALES</th>
                    <th>INGLES</th>
                    <th>COMERCIALES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consulta as $key)
                    <tr>
                        <td>{!! $key->ANO !!}</td>
                        <td>{!! $key->CURSO  !!}</td>
                        <td>{!! $key->PERIODO !!}</td>
                        <td>{!! $key->NUMERODOC !!}</td>
                        <td>{!! $key->NOMBRECOMPLETO !!}</td>
                        <td>{!! $key->CASTELLANO !!}</td>
                        <td>{!! $key->MATEMATICA !!}</td>
                        <td>{!! $key->NATURALES !!}</td>
                        <td>{!! $key->SOCIALES !!}</td>
                        <td>{!! $key->INGLES !!}</td>
                        <td>{!! $key->COMERCIALES !!}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        @endif
		<div class="fixed-action-btn">
    		<a href="{{ route('estudiante.verestudiante') }}" class="btn-floating btn-large blue darken-4">
    			<i class="large material-icons">mode_edit</i>
    		</a>
		</div>
	@endif

@endsection
