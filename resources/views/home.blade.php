@extends('layouts.app')

@section('content')
    <home-component token_csrf="{{ @csrf_token() }}" route-logout="{{ route('logout') }}"></home-component>
@endsection
