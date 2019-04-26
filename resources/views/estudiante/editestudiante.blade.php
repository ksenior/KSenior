@extends('layouts.app')

@section('title','Consulta Estudiante')

@section('contenido')
    @if(isset($consulta))
    @endif

    <br>
	@if (!isset($busqueda))
        <center>
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 22px 32px 22px 32px; border: 1px solid #EEE; width: 50%">
            <h5 class="blue-text text-darken-4">Datos de Estudiante</h5><br>
            {{ Form::open(['action' => 'EstudianteController@ver_estudiante_consulta']) }}
                <div class="row">
                     @if ($errors->any())
                        <div class="help-block red-text">         
                        @foreach ($errors->all() as $error)
                                <strong>{{ $error }}<br></strong>
                        @endforeach
                        </div>
                    @endif
                    <div class="col s6">
                        <h6 class="blue-text text-darken-4">Tipo Busqueda</h6>
                        <select name="tipobusqueda" id="tipobusqueda" ">
                            <option value="0" selected>-- Elija una opción --</option>
                            <option value="1" >Nombre</option>
                            <option value="2" >Documento Identidad</option>
                        </select>
                    </div>
                    <div class="col s6">
                        <h6 class="blue-text text-darken-4">Dato a Buscar</h6>
                        <input type="text" name="busqueda" id="busqueda">
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
                    <th># DOCUMENTO</th>
                    <th>NOMBRE COMPLETO</th>
                    <th>FECHA NACIMIENTO</th>
                    <th>DIRECCION</th>
                    <th>BARRIO</th>
                    <th>DEPARTAMENTO</th>
                    <th>MUNICIPIO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consulta as $key)
                    <tr>
                        <td>{!! $key->NUMERODOC !!}</td>
                        <td>{!! $key->NOMBRECOMPLETO !!}</td>
                        <td>{!! $key->FECHANAC !!}</td>
                        <td>{!! $key->DIRECCION !!}</td>
                        <td>{!! $key->BARRIO !!}</td>
                        <td>{!! $key->DEPARTAMENTO !!}</td>
                        <td>{!! $key->MUNICIPIO !!}</td>
                        <td>
                            <a class="btn success" href="{{ action('EstudianteController@edit_estudiante_index', ['documento' => $key->NUMERODOC]) }}">Ver</a>
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
