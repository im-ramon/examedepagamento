@extends('layouts.app')

<h1>dada</h1>
@foreach ($pg_info as $indice => $pg)
    <option @if ($pg['pg_abrev'] == ' - Selecione uma opção -')
        selected
@endif

value="{{ $pg['id'] }}">{{ $pg['pg_abrev'] }}</option>
@endforeach
@section('content')
    <formulario-component token_csrf="{{ @csrf_token() }}""></formulario-component>
@endsection
