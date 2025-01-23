@extends('layout.website.master')

@section('content')

    <header class="bg-slate-100 py-8">
        <h1 class="text-center text-slate-950 text-3xl md:text-4xl xl:text-5xl font-extrabold">
            {{ $category->category }}
        </h1>
    </header>
    <div class="container mt-8 xl:mt-10">
        <p class="text-base font-medium md:text-xl xl:text-2xl text-center">
            {!! __('website.category.intro', ['count' => $pages->count(), 'category' => $category->category]) !!}
        </p>
        @if(!$pages->isEmpty())
            <section class="mt-8 xl:mt-10">
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
            </section>
        @endif
    </div>

@endsection
