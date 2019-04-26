@extends('layouts.app')

@section('title','Subir Notas')

@section('contenido')
    @if(isset($consulta))
    @endif

    <br>
	@if (!isset($archivo))
        <center>
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 22px 32px 22px 32px; border: 1px solid #EEE; width: 50%">
            <h5 class="blue-text text-darken-4">Archivo</h5><br>
            {{ Form::open(['action' => 'NotasController@ver_excel_consulta', 'enctype' => 'multipart/form-data']) }}
                {{csrf_field()}}
                <div class="row">
                     @if ($errors->any())
                        <div class="help-block red-text">         
                        @foreach ($errors->all() as $error)
                                <strong>{{ $error }}<br></strong>
                        @endforeach
                        </div>
                    @endif
                    <div class="col s6">
                        <h6 class="blue-text text-darken-4">Ubicación Archivo </h6>
                        <input type="file" name="archivo" id="archivo">
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
                    <th>NUMERODOC</th>
                    <th>NOMBRE COMPLETO</th>
                    <th>AÑO</th>
                    <th>CURSO</th>
                    <th>PERIODO</th>
                    <th>CASTELLANO</th>
                    <th>MATEMATICA</th>
                    <th>NATURALES</th>
                    <th>SOCIALES</th>
                    <th>INGLES</th>
                    <th>COMERCIALES</th>
                    <th>RELIGION</th>
                    <th>VALORES</th>
                    <th>E. FISICA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consulta as $key)
                    <tr>
                        <td>{!! $key->NUMERODOC !!}</td>
                        <td>{!! $key->NOMBRECOMPLETO !!}</td>
                        <td>{!! $key->ANO !!}</td>
                        <td>{!! $key->CURSO !!}</td>
                        <td>{!! $key->PERIODO !!}</td>
                        <td>{!! $key->CASTELLANO !!}</td>
                        <td>{!! $key->MATEMATICA !!}</td>
                        <td>{!! $key->NATURALES !!}</td>
                        <td>{!! $key->SOCIALES !!}</td>
                        <td>{!! $key->INGLES !!}</td>
                        <td>{!! $key->COMERCIALES !!}</td>
                        <td>{!! $key->RELIGION !!}</td>
                        <td>{!! $key->VALORES !!}</td>
                        <td>{!! $key->EDFISICA !!}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        @endif
		<div class="fixed-action-btn">
    		<a href="{{ route('notas.vernotaestudiante') }}" class="btn-floating btn-large blue darken-4">
    			<i class="large material-icons">mode_edit</i>
    		</a>
		</div>
	@endif

@endsection
