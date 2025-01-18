<header>
    <div class="container relative h-[66px] flex items-center">
        <a href="/" class="block absolute top-0 left-0 px-4 sm:px-8 xl:px-4 2xl:px-8 min-h-[72px]" title="Home">
            <img src="{{ asset('storage/logo.svg') }}" width="312" height="72" class="hidden md:block min-h-[72px]" alt="Logo" />
        </a>
        <ul class="h-[66px] ms-auto flex items-center [&>li]:ms-6">
            <li>
                <a href="{{ route('search') }}" class="flex items-center justify-center w-9 h-9 rounded-full ring-2 ring-slate-300 hover:ring-slate-400 bg-slate-50" title="Search">
                    <svg class="w-5 h-5 fill-slate-400 relative -top-px -left-px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                </a>
            </li>
            <li>
                <label for="language" class="block cursor-pointer" title="Language">
                    <img src="{{ asset('storage/flags/'.LaravelLocalization::getCurrentLocale().'.svg') }}" alt="{{ LaravelLocalization::getCurrentLocaleNative() }}" class="w-9 h-9 rounded-full ring-2 ring-slate-300 hover:ring-slate-400 bg-slate-100" />
                </label>
                <input id="language" class="hidden peer/language" type="checkbox" />
                <ul class="absolute top-[66px] right-8 ring-1 ring-inset ring-slate-300 shadow-md rounded-lg p-4 bg-white hidden peer-checked/language:grid gap-1.5">
                    @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                        <li>
                            <a class="group flex items-center hover:underline" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                <img src="{{ asset('storage/flags/'.$localeCode.'.svg') }}" alt="" class="min-w-6 min-h-6 max-w-6 max-h-6 rounded-full ring-2 ring-slate-300 group-hover:ring-slate-400 block me-2.5" />{{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
</header>
