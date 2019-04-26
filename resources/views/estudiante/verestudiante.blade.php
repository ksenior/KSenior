@extends('layouts.app')

@section('title','Consulta Estudiante')

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
                    <th>ACUDIENTE</th>
                    <th>PARENTESCO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consulta as $key)
                    <tr>
                        <td>{!! $key->NUMERODOC !!}</td>
                        <td>{!! $key->PRIMERNOMBRE !!}  {!!$key->SEGUNDONOMBRE !!} {!! $key->PRIMERAPELLIDO !!} {!! $key->SEGUNDOAPELLIDO  !!}</td>
                        <td>{!! $key->FECHANAC !!}</td>
                        <td>{!! $key->DIRECCION !!}</td>
                        <td>{!! $key->BARRIO !!}</td>
                        <td>{!! $key->DEPARTAMENTO !!}</td>
                        <td>{!! $key->MUNICIPIO !!}</td>
                        <td>{!! $key->ACUDIENTE !!}</td>
                        <td>{!! $key->PARENTESCO !!}</td>
                        <td>
                            <a class="tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Editar información de Estudiante" href="#modalestudiante"><i class="small material-icons">create</i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
            <div id="modalestudiante" class="modal">
                <div class="modal-content">
                <h4>Editar información de Estudiante "{!! $key->PRIMERNOMBRE !!} {!! $key->PRIMERAPELLIDO !!}"</h4>
                {{ Form::open(['action' => 'EstudianteController@edit_estudiante_update']) }}
                    <br>
                    @if ($errors->any())
                        <div class="help-block red-text">         
                        @foreach ($errors->all() as $error)
                            <strong>{{ $error }}<br></strong>
                        @endforeach
                        </div>
                    @endif

                    <input type="hidden" name="id_estudiante" id="id_estudiante" value="{{ $key->NUMERODOC }}">
                    <input type="hidden" name="fechanac" id="fechanac" value="{{ $key->FECHANAC }}">
                    <input type="hidden" name="departamento" id="departamento" value="{{ $key->DEPARTAMENTO }}">
                    <input type="hidden" name="municipio" id="municipio" value="{{ $key->MUNICIPIO }}">
                    <input type="hidden" name="old_consulta" id="old_consulta" value="{{ serialize($consulta) }}">

                    <center><h4 class="blue-text text-darken-4">Datos Estudiante</h4></center>
                    <div class="row">
                        <div class="col s3 m3 l3">
                            <h6 class="blue-text text-darken-4">PRIMER NOMBRE</h6>
                            <input type="text" name="new_nombre1" id="new_nombre1" value="{{ $key->PRIMERNOMBRE }}">
                        </div>
                        <div class="col s3 m3 l3">
                            <h6 class="blue-text text-darken-4">SEGUNDO NOMBRE</h6>
                            <input type="text" name="new_nombre2" id="new_nombre2" value="{{ $key->SEGUNDONOMBRE }}">
                        </div>
                        <div class="col s3 m3 l3">
                            <h6 class="blue-text text-darken-4">PRIMER APELLIDO</h6>
                            <input type="text" name="new_apellido1" id="new_apellido1" value="{{ $key->PRIMERAPELLIDO }}">
                        </div>
                        <div class="col s3 m3 l3">
                            <h6 class="blue-text text-darken-4">SEGUNDO APELLIDO</h6>
                            <input type="text" name="new_apellido2" id="new_apellido2" value="{{ $key->SEGUNDOAPELLIDO }}">
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col s3 m3 l3">
                            <h6 class="blue-text text-darken-4">DIREECION</h6>
                            <input type="text" name="new_direccion" id="new_direccion" value="{{ $key->DIRECCION }}">
                        </div>
                        <div class="col s3 m3 l3">
                            <h6 class="blue-text text-darken-4">BARRIO</h6>
                            <input type="text" name="new_barrio" id="new_barrio" value="{{ $key->BARRIO }}">
                        </div>
                        <div class="col s3 m3 l3">
                            <h6 class="blue-text text-darken-4">ACUDIENTE</h6>
                            <input type="text" name="new_acudiente" id="new_acudiente" value="{{ $key->ACUDIENTE }}">
                        </div>
                        <div class="col s3 m3 l3">
                            <h6 class="blue-text text-darken-4">PARENTESCO</h6>
                            <input type="text" name="new_parentesco" id="new_parentesco" value="{{ $key->PARENTESCO }}">
                        </div>    
                    </div>
                    
                    
                    <div class="row">
                       <center> <button class="btn waves-effect waves-light blue darken-4" type="submit" name="action">¡Actualizar información de Estudiante!</button></center>
                    </div>
                {{ Form::close()}}
            </div>
            </div>
        @endif
		<div class="fixed-action-btn">
    		<a href="{{ route('estudiante.verestudiante') }}" class="btn-floating btn-large blue darken-4">
    			<i class="large material-icons">mode_edit</i>
    		</a>
		</div>
	@endif

@endsection
