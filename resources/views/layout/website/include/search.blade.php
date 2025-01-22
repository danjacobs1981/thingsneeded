<form action="{{ route('search') }}" method="GET">
    <div class="relative text-gray-600 max-w-[600px] mx-auto">
        <input type="text" name="q" placeholder="{{ __('common.search.placeholder') }}" class="bg-white h-14 px-5 pr-10 rounded-full focus:outline-none w-full text-xl font-medium" value="{{ request()->get('q', '') }}">
        <button type="submit" class="group absolute right-0 top-1/2 -translate-y-1/2 h-14 px-6" title="{{ __('common.search.button') }}">
            <svg class="w-6 h-6 fill-teal-500 group-hover:fill-teal-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
        </button>
    </div>
</form>
