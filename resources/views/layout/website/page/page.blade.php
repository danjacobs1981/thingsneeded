@extends('layout.website.master')
@inject('carbon', 'Carbon\Carbon')

@section('content')
    @component('schema')
        "@graph":[{
            "@type":"Article",
            "image":"{{ asset('storage/images/hero/'.$page->slug.'.jpg') }}",
            "datePublished":"{{ $carbon::parse($page->created_at)->toISOString() }}",
            "dateModified":"{{ $carbon::parse($page->updated_at)->toISOString() }}",
            "mainEntityOfPage":"{{ config('app.url').'/'.LaravelLocalization::getCurrentLocale().'/'.$page->slug }}",
            "headline":"{{ $page->title }}",
            "publisher":{
                "@type":"Organization",
                "name":"{{ config('app.name') }}",
                "logo":{
                    "@type":"ImageObject",
                    "url":"{{ asset('storage/logo.svg') }}",
                    "width":"312",
                    "height":"72"
                }
            },
            "author":{
                "@type":"Person",
                "name":"{{ $page->author()->name }}"
            }
        }]
    @endcomponent
    <article data-id="{{ $page->id }}">
        <header class="bg-slate-100 pt-6">
            <div class="grid justify-center w-full max-w-[800px] mx-auto">
                <div class="grid gap-2 md:gap-3 justify-center px-3">
                    <a class="mx-auto inline-block w-fit bg-teal-700 hover:bg-teal-800 rounded-full px-4 py-2 font-medium text-white text-center" href="{{ LaravelLocalization::localizeUrl(route('category', $page->category()->slug)) }}">
                        {{ $page->category()->category }}
                    </a>
                    <h1 class="text-center text-slate-950 text-3xl md:text-4xl xl:text-5xl font-extrabold capitalize">
                        {{ $page->title }}
                    </h1>
                    <ul class="mx-auto sm:marker:text-slate-400 sm:list-disc sm:space-x-5 items-center flex flex-col sm:flex-row text-slate-600">
                        <li class="list-none sm:pe-3">
                            {{ __('page.author') }} {{ $page->author()->name }}
                        </li>
                        <li>
                            {{ $carbon::parse($page->updated_at)->translatedFormat('j F, Y') }}
                        </li>
                    </ul>
                </div>
                @if($page->image)
                    <picture>
                        <source srcset="{{ asset('storage/images/hero/'.$page->slug.'.webp') }}" type="image/webp">
                        <source srcset="{{ asset('storage/images/hero/'.$page->slug.'.jpg') }}" type="image/jpeg">
                        <img fetchpriority="high" class="mt-3 md:mt-5 lg:h-[382px] block lg:rounded-md object-cover" width="800" height="382" src="{{ asset('storage/images/hero/'.$page->slug.'.jpg') }}" alt="Image representing {{ $page->title }}">
                    </picture>
                @else
                    <hr class="mt-3 md:mt-5 border-t border-slate-300" />
                @endif
                <div class="flex items-center justify-between p-3">
                    <span>
                        {{ __('page.read', ['minute' => $page->reading_time]) }}
                    </span>
                    <ul class="grid grid-cols-4 gap-4 [&_svg]:h-6 [&_svg]:w-6 lg:[&_svg]:h-7 lg:[&_svg]:w-7">
                        @include('layout.website.include.share')
                    </ul>
                </div>
            </div>
        </header>
        <div class="container mt-8 xl:mt-10">
            <p class="text-base font-medium md:text-xl xl:text-2xl">
                {{$page->introduction}}
            </p>
            @foreach($types as $type)
                @if(!$things->where('type_id', $type->id)->isEmpty())
                    <section id="{{$type->type}}" class="grid gap-3 xl:gap-6 mt-5 xl:mt-12">
                        <div class="mx-auto flex items-center">
                            <img src="{{ asset('storage/icons/box-type-'.$type->id.'.svg') }}" class="w-24 h-24 md:w-32 md:h-32" alt="{{ $type->title }} box" />
                            <h2 class="text-slate-950 text-2xl md:text-3xl lg:text-4xl font-bold capitalize pe-4">
                                {{ $type->id !== 1 && $things->where('type_id', $type->id)->count() > 1 ? $things->where('type_id', $type->id)->count() : null }} {{ $type->title }}
                            </h2>
                        </div>
                        <ol role="list" class="grid gap-4 {{ $things->where('type_id', $type->id)->count() === 1 ? '' : 'md:grid-cols-2' }} xl:gap-6">
                            @foreach($things->where('type_id', $type->id) as $thing)
                                <li class="mx-auto ring-1 ring-slate-300 bg-slate-100 shadow-md rounded-xl overflow-hidden flex flex-col justify-between w-full max-w-[556px]">
                                    <div class="p-3 xl:px-4 xl:py-3">
                                        <div class="flex items-center">
                                            @if($type->id !== 1)
                                                <span class="bg-teal-500 rounded-full text-white min-w-10 min-h-10 max-w-10 max-h-10 leading-10 inline-block text-center text-lg font-medium me-2.5">
                                                    {{ $loop->iteration }}
                                                </span>
                                            @endif
                                            <h3 class="text-slate-950 text-lg !leading-tight md:text-xl xl:text-2xl font-semibold">
                                                {{$thing->title}}
                                            </h3>
                                        </div>
                                        <p class="mt-2 leading-tight">
                                            {{$thing->subtext}}
                                        </p>
                                    </div>
                                    <div class="border-t border-slate-300 flex items-center justify-between text-sm">
                                        <a href="#" class="group bg-white hover:bg-yellow-50 w-full flex items-center justify-between p-3 xl:py-2.5 xl:px-4">
                                            <figure>
                                                <img loading="lazy" class="me-2 block rounded-md object-cover min-h-10 min-w-10 max-h-10 max-w-10" width="40" height="40" src="{{ asset('storage/images/hero/'.$page->slug.'.jpg') }}" alt="Product">
                                            </figure>
                                            <p class="w-full tracking-tight line-clamp-2 max-w-[260px] leading-tight me-2">
                                                ECO-WORTHY 1200W 24V Solar Power System 4.8kWh/Day with Battery and Hybrid Solar Inverter for Home Shed RV: 6pcs 195W Solar Panels+ 2pcs 100Ah Lithium Batteries+ 3000W 24V Hybrid Inverter
                                            </p>
                                            <span class="ms-auto text-center me-2 grid leading-tight">
                                                <del class="text-red-700">
                                                    &pound;199
                                                </del>
                                                <strong>
                                                    &pound;165
                                                </strong>
                                            </span>
                                            <span class="ms-auto inline-block leading-[1.125] bg-orange-600 group-hover:bg-orange-700 text-white px-2 py-1.5 rounded-md text-center text-base font-medium">
                                                {{ __('page.amazon.buy') }}
                                            </span>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                        @if($type->id === 1)
                            <p class="text-center text-slate-500">
                                {{ __('page.legal') }}
                            </p>
                        @endif
                    </section>
                @endif
            @endforeach
        </div>
        @if(!$tips->isEmpty())
            <section id="{{ __('page.tips.id') }}" class="bg-amber-50 py-10 mt-10 xl:mt-12">
                <div class="container">
                    @php
                        $cols = '';
                        if ($tips->count() === 2 || $tips->count() > 3) {
                            $cols = 'md:grid-cols-2';
                        } else if ($tips->count() === 3) {
                            $cols = 'md:grid-cols-2 xl:grid-cols-3';
                        }
                    @endphp
                    <ul class="grid gap-4 {{ $cols }} xl:gap-9">
                        @foreach($tips as $tip)
                            <li class="flex items-start w-full max-w-[500px] mx-auto">
                                <img src="{{ asset('storage/icons/bulb.svg') }}" width="70" height="70" alt="Tip" />
                                <div>
                                    <h3 class="text-slate-950 text-lg !leading-tight md:text-xl lg:text-2xl font-semibold">
                                        {{$tip->title}}
                                    </h3>
                                    <p class="mt-1.5 leading-tight">
                                        {{$tip->subtext}}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif
        @if(!$sections->isEmpty())
            <section id="{{ __('page.steps.id') }}" class="bg-teal-100 py-10 {{ $tips->isEmpty() ? 'mt-10 xl:mt-14' : 'mt-8 xl:mt-10' }} relative overflow-x-hidden">
                <div class="container lg:max-w-[800px] lg:px-0 grid gap-8">
                    <img src="{{ asset('storage/icons/steps.svg') }}" width="600" height="600" class="hidden 2xl:block absolute -top-28 -right-24" alt="Checklist" />
                    <img src="{{ asset('storage/icons/box-type-2.svg') }}" width="360" height="360" class="hidden 2xl:block absolute -bottom-0 -left-32" alt="Box" />
                    <h2 class="text-center text-slate-950 text-2xl md:text-3xl xl:text-4xl font-bold capitalize">
                        {{ __('page.steps.title') }}
                    </h2>
                    @php
                        $total = 0;
                    @endphp
                    @foreach($sections as $section)
                        <div>
                            <div class="flex items-center">
                                <h3 class="text-slate-950 text-xl md:text-2xl xl:text-3xl font-semibold">
                                    {{$section->title}}
                                </h3>
                            </div>
                            <ol class="mt-5 grid gap-5">
                                @foreach($steps->where('section_id', $section->id) as $step)
                                    <li class="{{ $loop->iteration < 3 ? '2xl:pe-48' : '' }}">
                                        <div class="flex items-start">
                                            <span class="bg-white rounded-full min-w-10 min-h-10 max-w-10 max-h-10 leading-10 inline-block text-center text-lg font-semibold me-2.5">
                                                {{ $total + $loop->iteration }}
                                            </span>
                                            <div>
                                                <h4 class="text-slate-950 text-lg md:text-xl font-medium mb-1 leading-tight">
                                                    {{$step->title}}
                                                </h4>
                                                <p>
                                                    {{$step->subtext}}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                        @php
                            $total = $steps->where('section_id', $section->id)->count();
                        @endphp
                    @endforeach
                </div>
            </section>
        @endif
        <div class="container mt-8 xl:mt-10">
            <p class="md:text-xl">
                {{$page->conclusion}}&nbsp; <span class="relative top-px inline-block w-4 h-4 bg-teal-500"></span>
            </p>
            <footer class="grid gap-3 mt-8 md:mt-10">
                @if(!$tags->isEmpty())
                    <section>
                        <ul class="flex flex-wrap items-center justify-start gap-2">
                            @foreach($tags as $tag)
                                <li>
                                    <a class="bg-teal-700 hover:bg-teal-800 rounded-md text-white py-2 px-2.5 inline-block lowercase" href="{{ LaravelLocalization::localizeUrl(route('tag', $tag->slug)) }}">
                                        {{$tag->tag}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif
                <section class="mt-6 md:mt-8">
                    <ul class="grid grid-cols-4 w-48 [&_svg]:h-8 [&_svg]:w-8">
                        @include('layout.website.include.share')
                    </ul>
                </section>
                <p class="mt-6 md:mt-8 text-slate-500">
                    {{ __('page.disclaimer') }}
                </p>
                <p class="text-slate-500">
                    {{ __('page.amazon.disclaimer') }}
                </p>
            </footer>
        </div>
    </article>
    @if(!$related->isEmpty())
        <aside id="{{ __('page.related.id') }}" class="bg-slate-100 py-10 mt-8 xl:mt-10">
            <div class="container grid gap-8 xl:gap-10">
                <h2 class="text-center text-slate-950 text-2xl md:text-3xl lg:text-4xl font-bold capitalize">
                    {{ __('page.related.title') }}
                </h2>
                @php
                    $cols = '';
                    if ($related->count() === 2) {
                        $cols = 'md:grid-cols-2 max-w-[800px]';
                    } else if ($related->count() === 3) {
                        $cols = 'md:grid-cols-2 xl:grid-cols-3';
                    }
                @endphp
                <div class="grid {{ $cols }} gap-y-5 gap-x-10 mx-auto">
                    @foreach($related as $item)
                        @include('layout.website.include.card')
                    @endforeach
                </div>
            </div>
        </aside>
    @endif
@endsection

{{-- @push('scripts')
    @vite('resources/js/website/thing/script.js')
@endpush --}}
