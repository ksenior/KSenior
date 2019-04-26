@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message')
	<div class="row">
        <a class="btn waves-effect waves-light blue darken-4" href="{{ route('home') }}">Volver a inicio</a>
    </div>
@endsection
