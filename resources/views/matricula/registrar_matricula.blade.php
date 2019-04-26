@extends('layouts.app')

@section('title','Registrar Matricula')

@section('contenido')
    <br>
    <center>
    <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 22px 32px 22px 32px; border: 1px solid #EEE; width: 80%">
        <h5 class="blue-text text-darken-4">Datos de Matricula</h5><br>
        {{ Form::open(['action' => 'MatriculaController@registrar_matricula_consulta']) }}
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
                <div class="col s2">
                    <h6 class="blue-text text-darken-4">año</h6>
                    <input type="number" name="ano" id="ano" required="required">
                </div>
                <div class="col s2">
                    <h6 class="blue-text text-darken-4">curso</h6>
                    <input type="text" name="curso" id="curso" required="required">
                </div>
                <div class="col s2">
                    <h6 class="blue-text text-darken-4">numero documento</h6>
                    <input type="number" name="identificacion" id="identificacion" required="required">
                </div>
                <div class="col s2">
                    <h6 class="blue-text text-darken-4">codigo matricula</h6>
                    <input type="number" name="codmatricula" id="codmatricula" required="required">
                </div>
                <div class="col s2">
                    <h6 class="blue-text text-darken-4">Jornada</h6>
                    <select name="jornada" id="jornada" ">
                        <option value="MAÑANA" >MAÑANA</option>
                        <option value="TARDE" >TARDE</option>
                    </select>
                </div>
            </div>
            <div class="row">
                    <button class="btn center waves-effect waves-light blue darken-4" type="submit" name="action">Subir</button>    
                </div>
        {{ Form::close()}}
    </div>
    </center>
@endsection
