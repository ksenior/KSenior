@extends('layouts.app')

@section('title','Registrar Estudiante')

@section('contenido')
    <br>
    <center>
    <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 22px 32px 22px 32px; border: 1px solid #EEE; width: 60%">
        <h5 class="blue-text text-darken-4">Datos de Estudiante</h5><br>
        {{ Form::open(['action' => 'EstudianteController@registrar_estudiante_consulta']) }}
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
                <div class="row centrado">
                    <div class="col s4">
                        <h6 class="blue-text text-darken-4">TIPO DOCUMENTO</h6>
                        <select name="tipodocumento" id="tipodocumento" required="required">
                            <option value="TI" >T. Identidad</option>
                            <option value="CC" >Cedula Ciudadanía</option>
                            <option value="RC" >Registro Civil</option>
                        </select>
                    </div>
                    <div class="col s4">
                        <h6 class="blue-text text-darken-4">numero documento</h6>
                        <input type="number" name="identificacion" id="identificacion" required="required">
                    </div> 
                    <div class="col s4">
                        <h6 class="blue-text text-darken-4">Lugar expedicion</h6>
                        <input type="text" name="expedicion" id="expedicion" required="required">
                    </div>    
                </div>
                <div class="row">
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">PRIMER NOMBRE</h6>
                        <input type="text" name="primernombre" id="primernombre" required="required">
                    </div>
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">SEGUNDO NOMBRE</h6>
                        <input type="text" name="segundonombre" id="segundonombre" >
                    </div>
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">PRIMER APELLIDO</h6>
                        <input type="text" name="primerapellido" id="primerapellido" required="required">
                    </div>
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">SEGUNDO APELLIDO</h6>
                        <input type="text" name="segundoapellido" id="segundoapellido" >
                    </div>
                     
                </div>
                <div class="row">
                    <div class="col s4">
                        <h6 class="blue-text text-darken-4">FECHA NACIMIENTO</h6>
                        <input type="date" name="fechanac" id="fechanac" required="required">
                    </div>
                    <div class="col s4">
                        <h6 class="blue-text text-darken-4">Lugar Nacimiento</h6>
                        <input type="text" name="lugarnac" id="lugarnac" required="required">
                    </div> 
                    <div class="col s4">
                        <h6 class="blue-text text-darken-4">Telefono</h6>
                        <input type="number" name="telefono" id="telefono" required="required">
                    </div> 
                </div>
                <div class="row">
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">direccion</h6>
                        <input type="text" name="direccion" id="direccion" required="required">
                    </div>
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">Barrio</h6>
                        <input type="text" name="barrio" id="barrio" required="required">
                    </div> 
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">municipio</h6>
                        <input type="text" name="municipio" id="municipio" required="required">
                    </div> 
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">departamento</h6>
                        <input type="text" name="departamento" id="departamento" required="required">
                    </div> 
                </div>
                <div class="row">
                    
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">nombre acudiente</h6>
                        <input type="text" name="acudiente" id="acudiente" required="required">
                    </div> 
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">parentesco</h6>
                        <input type="text" name="parentesco" id="parentesco" required="required">
                    </div> 
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">direccion familiar</h6>
                        <input type="text" name="direccionfam" id="direccionfam" required="required">
                    </div> 
                    <div class="col s3">
                        <h6 class="blue-text text-darken-4">telefono familiar</h6>
                        <input type="number" name="telefonofam" id="telefonofam" required="required">
                    </div>
                </div>
            </div>
            <div class="row">
                    <button class="btn center waves-effect waves-light blue darken-4" type="submit" name="action">Subir</button>    
                </div>
        {{ Form::close()}}
    </div>
    </center>
@endsection
