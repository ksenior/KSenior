@extends('layouts.app')

@section('title','Consulta Boletin')

@section('contenido')
    @if(isset($consulta))
    @endif

    <br>
	@if (!isset($ano))
        <center>
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 22px 32px 22px 32px; border: 1px solid #EEE; width: 50%">
            <h5 class="blue-text text-darken-4">Datos de Curso</h5><br>
            {{ Form::open(['action' => 'BoletinController@ver_boletinxcurso_consulta']) }}
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
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">AÑO</h6>
                        <input type="text" name="ano" id="ano" required="required">
                    </div>
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">CURSO</h6>
                        <input type="text" name="curso" id="curso" required="required">
                    </div>
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">Periodo</h6>
                        <select name="periodo" id="periodo" required="required">
                            <option value="1" selected>1</option>
                            <option value="2" >2</option>
                            <option value="3" >3</option>
                            <option value="4" >4</option>
                        </select>
                    </div>
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">FECHA ENTREGA</h6>
                        <input type="date" name="fecha" id="fecha" required="required">
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
                            <h6><b>Año: </b>{!! $ano !!}</h6>
                            <h6><b>Curso: </b>{!! $curso !!}</h6>
                            <h6><b>Periodo: </b>{!! $periodo !!}</h6>
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
                    <th># DOCUMENTO</th>
                    <th>NOMBRE COMPLETO</th>
                    <th>AÑO</th>
                    <th>CURSO</th>
                    <th>JORNADA</th>
                    <th>COD MATRICULA</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consulta as $key)
                    <tr>
                        <td>{!! $key->numerodoc !!}</td>
                        <td>{!! $key->nombrecompleto !!}</td>
                        <td>{!! $key->ano !!}</td>
                        <td>{!! $key->curso !!}</td>
                        <td>{!! $key->jornada !!}</td>
                        <td>{!! $key->codmatricula !!}</td>
                        <td>
                            <a class="btn success" target="_blank" href="{{ action('BoletinController@generate_pdf', ['documento' => $key->numerodoc, 'codmatricula' => $key->codmatricula, 'nombre' => $key->nombrecompleto, 'grado' => $key->curso, 'jornada' => $key->jornada, 'ano' => $key->ano]) }}">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        @endif
		<div class="fixed-action-btn">
    		<a href="{{ route('boletines.verboletin') }}" class="btn-floating btn-large blue darken-4">
    			<i class="large material-icons">mode_edit</i>
    		</a>
		</div>
	@endif

@endsection
