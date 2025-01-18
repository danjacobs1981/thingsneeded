@extends('layout.website.master')

@section('content')

    <h1 class="bg-red-500">{{ __('home.title') }}</h1>

    <a href="{{ route('login') }}">
        Login
    </a>

@endsection
