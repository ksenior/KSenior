@extends('layouts.app')

@section('title', 'Home')

@section('contenido')
    <div class="row"><center>
        <br>
        <div class="col-md-8 col-md-offset-2">
            
            <div class="logo center-align">
                <img src="{{ generateURL('public/img/logo2.png') }}" alt="Logo RSIT" width="15%">
                <br>
                <img src="{{ generateURL('public/img/titulo.png') }}" alt="Logo RSIT" width="40%">
            </div>
        </div></center>
    </div>
@endsection