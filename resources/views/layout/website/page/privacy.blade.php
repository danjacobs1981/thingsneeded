@extends('layout.website.master')

@section('content')

    <header class="bg-slate-100 py-8">
        <h1 class="text-center text-slate-950 text-3xl md:text-4xl xl:text-5xl font-extrabold">
            {{ __('website.privacy.title') }}
        </h1>
    </header>
    <div class="container mt-8 xl:mt-10 text-base">
        @include('layout.website.include.privacy.'.LaravelLocalization::getCurrentLocale())
    </div>

@endsection
