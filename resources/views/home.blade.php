@extends('layouts.app')

@section('content')
    <home-component csrf_token="{{ @csrf_token() }}" route-logout="{{ route('logout') }}"></home-component>
@endsection
