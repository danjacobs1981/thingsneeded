<article class="w-full max-w-[380px] mx-auto">
    <a class="flex flex-col ring-1 ring-slate-300 bg-white rounded-xl overflow-hidden h-full" href="{{ LaravelLocalization::localizeUrl(route('page', $item->slug)) }}">
        <div class="h-44 bg-slate-100">
            @if($item->image)
                <picture>
                    <source srcset="{{ asset('storage/images/card/'.$item->slug.'.webp') }}" type="image/webp">
                    <source srcset="{{ asset('storage/images/card/'.$item->slug.'.jpg') }}" type="image/jpeg">
                    <img loading="lazy" class="w-full block object-cover h-44 min-w-80" height="176" src="{{ asset('storage/images/card/'.$item->slug.'.jpg') }}" alt="{{ __('common.image.representing', ['image' => strtolower($item->title)]) }}">
                </picture>
            @else
                <picture>
                    <source srcset="{{ asset('storage/images/card/placeholder.webp') }}" type="image/webp">
                    <source srcset="{{ asset('storage/images/card/placeholder.jpg') }}" type="image/jpeg">
                    <img loading="lazy" class="w-full block object-cover h-44 min-w-80" height="176" src="{{ asset('storage/images/card/placeholder.jpg') }}" alt="Placeholder image">
                </picture>
            @endif
        </div>
        <div class="p-4">
            <strong class="text-lg lg:text-xl font-semibold leading-tight capitalize">
                {{$item->title}}
            </strong>
        </div>
    </a>
</article>
