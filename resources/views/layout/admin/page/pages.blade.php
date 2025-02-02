@extends('layout.admin.master')

@section('content')

<div class="container">

    <h1 class="text-xl mb-4 font-bold">
        All Pages ({{ $allPages->count() }})
    </h1>

    <ul class="flex flex-wrap gap-x-6 gap-y-2 border-b border-slate-300 pb-3 mb-3">
        <li>
            <strong>
                Filter by:
            </strong>
        </li>
        <li>
            <a href="{{ route('pages') }}" class="{{ !count($_GET) ? 'text-teal-600 font-bold' : ''}}">
                All ({{ $allPages->count() }})
            </a>
        </li>
        <li>
            <a href="?live=true" class="{{ Request::get('live') ? 'text-teal-600 font-bold' : ''}}">
                Live ({{ $allPages->where('live', 1)->count() }})
            </a>
        </li>
        <li>
            <a href="?notlive=true" class="{{ Request::get('notlive') ? 'text-teal-600 font-bold' : ''}}">
                Not Live ({{ $allPages->where('live', 0)->count() }})
            </a>
        </li>
        <li>
            <a href="?translated=true" class="{{ Request::get('translated') ? 'text-teal-600 font-bold' : ''}}">
                Translated ({{ $allPages->where('translated', 1)->count() }})
            </a>
        </li>
        <li>
            <a href="?nottranslated=true" class="{{ Request::get('nottranslated') ? 'text-teal-600 font-bold' : ''}}">
                Not Translated ({{ $allPages->where('translated', 0)->count() }})
            </a>
        </li>
        <li>
            <a href="?image=true" class="{{ Request::get('image') ? 'text-teal-600 font-bold' : ''}}">
                Image ({{ $allPages->where('image', 1)->count() }})
            </a>
        </li>
        <li>
            <a href="?noimage=true" class="{{ Request::get('noimage') ? 'text-teal-600 font-bold' : ''}}">
                No Image ({{ $allPages->where('image', 0)->count() }})
            </a>
        </li>
        <li>
            <a href="?products=true" class="{{ Request::get('products') ? 'text-teal-600 font-bold' : ''}}">
                Products ({{ $allPages->where('products', 1)->count() }})
            </a>
        </li>
        <li>
            <a href="?noproducts=true" class="{{ Request::get('noproducts') ? 'text-teal-600 font-bold' : ''}}">
                No Products ({{ $allPages->where('products', 0)->count() }})
            </a>
        </li>
        <li>
            <a href="?edited=true" class="{{ Request::get('edited') ? 'text-teal-600 font-bold' : ''}}">
                Edited ({{ $allPages->where('edited', 1)->count() }})
            </a>
        </li>
        <li>
            <a href="?notedited=true" class="{{ Request::get('notedited') ? 'text-teal-600 font-bold' : ''}}">
                Not Edited ({{ $allPages->where('edited', 0)->count() }})
            </a>
        </li>
        <li>
            <a href="?editmode=true" class="{{ Request::get('editmode') ? 'text-teal-600 font-bold' : ''}}">
                In Editmode ({{ $allPages->where('editmode', 1)->count() }})
            </a>
        </li>
        <li>
            <a href="?noteditmode=true" class="{{ Request::get('noteditmode') ? 'text-teal-600 font-bold' : ''}}">
                Not in Editmode ({{ $allPages->where('editmode', 0)->count() }})
            </a>
        </li>
    </ul>

    <form action="{{ route('pages.save') }}" method="POST">

        @csrf

        <ul class="flex gap-6 border-b border-slate-300 pb-3 mb-3 items-center">
            <li>
                <strong>
                    Selected action:
                </strong>
            </li>
            <li>
                <label>
                    <input type="radio" name="action" value="live">
                    Make Live
                </label>
            </li>
            <li>
                <label>
                    <input type="radio" name="action" value="offline">
                    Take Offline
                </label>
            </li>
            <li>
                <label>
                    <input type="radio" name="action" value="translate">
                    Translate (job)
                </label>
            </li>
            <li>
                <label>
                    <input type="radio" name="action" value="image">
                    Generate Image (job)
                </label>
            </li>
            <li>
                <label>
                    <input type="radio" name="action" value="regenerate">
                    Regenerate Page Text (job)
                </label>
            </li>
            <li>
                <input type="submit" class="bg-teal-600 text-white px-2 py-1 rounded-md cursor-pointer" />
            </li>
        </ul>

        @if(!$pages->isEmpty())
            <ul>
                @foreach($pages as $page)
                    <li class="flex items-center ring-1 ring-slate-200 gap-3 p-3 mt-3 rounded-md">
                        <input type="checkbox" name="ids[]" value="{{ $page->id }}" />
                        <span class="{{ $page->live ? 'bg-green-500' : 'bg-red-500' }} text-white p-1 rounded-md min-w-12 text-center">
                            {{ $page->id }}
                        </span>
                        {{ $page->title }}
                        <div class="ms-auto flex gap-3 items-center">
                            @if($page->translated)
                                <span class="px-2 py-1 bg-slate-100 text-sm rounded-md">
                                    Translated
                                </span>
                            @endif
                            @if($page->image)
                                <span class="px-2 py-1 bg-slate-100 text-sm rounded-md">
                                    Image
                                </span>
                            @endif
                            @if($page->products)
                                <span class="px-2 py-1 bg-slate-100 text-sm rounded-md">
                                    Products
                                </span>
                            @endif
                            @if($page->edited)
                                <span class="px-2 py-1 bg-slate-100 text-sm rounded-md">
                                    Edited
                                </span>
                            @endif
                            @if($page->editmode)
                                <span class="px-2 py-1 bg-red-100 text-sm rounded-md">
                                    In Editmode
                                </span>
                            @endif
                            <a href="{{ route('edit.page', $page->slug) }}" class="text-teal-600 underline">
                                Edit
                            </a>
                            <a href="{{ route('page', $page->slug) }}" target="_blank" class="text-teal-600 underline">
                                Visit
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

    </form>

</div>

@endsection
