@extends('layout.website.master')

@section('content')
    <header class="bg-slate-100 py-8">
        <h1 class="text-center text-slate-950 text-3xl md:text-4xl xl:text-5xl font-semibold text-teal-500 !text-slate-800">
            {!! __('website.home.title') !!}
        </h1>
        <div class="container mt-6 xl:mt-8">
            @include('layout.website.include.search')
        </div>
    </header>
    <div class="container mt-8 xl:mt-10">
        @if(!$pages->isEmpty())
            <section>
                <div class="container grid gap-8 xl:gap-10">
                    <div>
                        <p class="font-medium xl:text-xl mb-3">
                            Embarking on a new adventure, whether it's learning a new skill or tackling a home improvement project, can be exciting but also challenging. Things-Needed.com takes the guesswork out of preparation by providing curated lists of essential tools, materials, and resources.
                        </p>
                        <p class="font-semibold xl:text-2xl text-teal-600">
                            Discover everything you need to confidently begin and complete your next endeavor!
                        </p>
                    </div>
                    <h2 class="text-center text-slate-950 text-2xl md:text-3xl lg:text-4xl font-bold">
                        {{ __('website.home.recently') }}
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
