@extends('layout.website.master')

@section('content')
    <header class="bg-slate-100 py-8">
        <h1 class="text-center text-slate-950 text-3xl md:text-4xl xl:text-5xl font-semibold text-teal-500 !text-slate-800">
            {!! __('common.home.title') !!}
        </h1>
        <div class="container mt-6 xl:mt-8">
            @include('layout.website.include.search')
        </div>
    </header>
    <div class="container mt-8 xl:mt-10">
        <a href="https://www.amazon.fr/dp/B09P844HWW?tag=danjacobscreations-21" target="_blank">amazon</a>
        @if(!$pages->isEmpty())
            <section>
                <div class="container grid gap-8 xl:gap-10">
                    <h2 class="text-center text-slate-950 text-2xl md:text-3xl lg:text-4xl font-bold">
                        {{ __('common.home.recently') }}
                    </h2>
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
                </div>
            </section>
        @endif
    </div>
@endsection
