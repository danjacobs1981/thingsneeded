@extends('layout.website.master')

@section('content')
    <header class="bg-slate-100 py-8">
        <h1 class="text-center text-slate-950 text-3xl md:text-4xl xl:text-5xl font-extrabold capitalize">
            {{ __('common.search.title') }}
        </h1>
        <div class="container mt-6 xl:mt-8">
            @include('layout.website.include.search')
        </div>
    </header>
    <div class="container mt-8 xl:mt-10">
        @isset($pages)
            <section class="mt-8 xl:mt-10">
                @if(!$pages->isEmpty())
                    @php
                        $cols = '';
                        if ($pages->count() === 2) {
                            $cols = 'md:grid-cols-2 max-w-[800px]';
                        } else if ($pages->count() > 2) {
                            $cols = 'md:grid-cols-2 xl:grid-cols-3';
                        }
                    @endphp
                    <div class="grid {{ $cols }} gap-y-5 gap-x-10 mx-auto">
                        @foreach($pages as $item)
                            @include('layout.website.include.card')
                        @endforeach
                    </div>
                @else
                    <p class="text-center">
                        {{ __('common.search.noresults') }}
                    </p>
                @endif
            </section>
        @endisset
    </div>
@endsection
