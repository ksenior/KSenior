@extends('layouts.app')

@section('title', 'Inicio de sesión')

@section('contenido')

<main><center>
    <br>
    <br>
    <div class="row">
        <div class="col s6">
            <div class="logo center-align">
            <img src="{{ generateURL('public/img/logo2.png') }}" alt="Logo RSIT" width="30%">
            <h4>
                <span class="blue-text text-darken-2">SISTEMA DE INFORMACIÓN DEL COLEGIO SANTA ROSA DE LIMA</span>
            </h4>
        </div>
        </div>
        <div class="col s6">
            <br>
            <br>
            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 32px 48px; border: 1px solid #EEE; width: 70%">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <h6>Inicio de sesión</h6>

                    @if ($errors->any())
                        <div class="help-block red-text">         
                        @foreach ($errors->all() as $error)
                                <strong>{{ $error }}<br></strong>
                        @endforeach
                        </div>
                    @endif

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' type='text' name='username' id='username' />
                            <label for='username'>Usuario</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='input-field col s12 '>
                            <input class='validate' type='password' name='password' id='password' />
                            <label for='password'>Contraseña</label>
                        </div>
                    </div>

                    <center>
                        <div class='row'>
                            <button class="btn waves-effect waves-light blue darken-4" type="submit" name="action">¡Iniciar sesión!</button>
                        </div>
                    </center>
                </form>
            </div>
        </div>
    </div>
</center>
</main>

@endsection
