@extends('layouts.app')

@section('content')
    <formulario-component token_csrf="{{ @csrf_token() }}""></formulario-component>
@endsection
