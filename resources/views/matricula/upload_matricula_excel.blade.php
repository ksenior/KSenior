@extends('layouts.app')

@section('title','Subir Matricula')

@section('contenido')
    <br>
    <center>
    <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 22px 32px 22px 32px; border: 1px solid #EEE; width: 50%">
        <h5 class="blue-text text-darken-4">SUBIR MATRICULA - EXCEL</h5><br>
        {{ Form::open(['action' => 'MatriculaController@upload_excel_consulta', 'enctype' => 'multipart/form-data']) }}
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
                    <h6 class="blue-text text-darken-4">Ubicación Archivo </h6>
                    <input type="file" name="archivo" id="archivo">
                </div>
            </div>
            <div class="row">
                    <button class="btn center waves-effect waves-light blue darken-4" type="submit" name="action">Subir</button>    
                </div>
        {{ Form::close()}}
    </div>
    </center>
@endsection
