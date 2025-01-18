@extends('layout.admin.master')

@section('content')

    <h1>
        Pages ({{ $pages->count() }})
    </h1>

    Live / Translated / Editing / Image / Products

    @if(!$pages->isEmpty())
        <section>
            <ul>
                @foreach($pages as $page)
                    <li class="bg-red-100 ring-1 flex gap-3">
                        <a href="{{ route('page', $page->slug) }}">
                            <p>{{$page->id}}: {{$page->title}}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

@endsection
