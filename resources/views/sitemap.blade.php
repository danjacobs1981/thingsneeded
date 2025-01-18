<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach ($general as $item)
        <url>
            <loc>{{ config('app.url').'/en/'.$item['slug'] }}</loc>
            @if($item['translated'])
                @foreach ($languages as $language)
                    <xhtml:link rel="alternate" hreflang="{{ $language->code }}" href="{{ config('app.url').'/'.$language->code.'/'.$item['slug'] }}" />
                @endforeach
            @endif
        </url>
        @if($item['translated'])
            @foreach ($languages->where('id', '!=', 1) as $language)
                <url>
                    <loc>{{ config('app.url').'/'.$language->code.'/'.$item['slug'] }}</loc>
                    @foreach ($languages as $language)
                        <xhtml:link rel="alternate" hreflang="{{ $language->code }}" href="{{ config('app.url').'/'.$language->code.'/'.$item['slug'] }}" />
                    @endforeach
                </url>
            @endforeach
        @endif
    @endforeach
    @foreach ($pages as $item)
        <url>
            <loc>{{ config('app.url').'/en/'.$item->slug }}</loc>
            @if($item->translated)
                @foreach ($languages as $language)
                    <xhtml:link rel="alternate" hreflang="{{ $language->code }}" href="{{ config('app.url').'/'.$language->code.'/'.$item->slug }}" />
                @endforeach
            @endif
        </url>
        @if($item->translated)
            @foreach ($languages->where('id', '!=', 1) as $language)
                <url>
                    <loc>{{ config('app.url').'/'.$language->code.'/'.$item->slug }}</loc>
                    @foreach ($languages as $language)
                        <xhtml:link rel="alternate" hreflang="{{ $language->code }}" href="{{ config('app.url').'/'.$language->code.'/'.$item->slug }}" />
                    @endforeach
                </url>
            @endforeach
        @endif
    @endforeach
    @foreach ($categories as $item)
        <url>
            <loc>{{ config('app.url').'/en/category/'.$item->slug }}</loc>
            @foreach ($languages as $language)
                <xhtml:link rel="alternate" hreflang="{{ $language->code }}" href="{{ config('app.url').'/'.$language->code.'/'.$item->slug }}" />
            @endforeach
        </url>
        @foreach ($languages->where('id', '!=', 1) as $language)
            <url>
                <loc>{{ config('app.url').'/'.$language->code.'/category/'.$item->slug }}</loc>
                @foreach ($languages as $language)
                    <xhtml:link rel="alternate" hreflang="{{ $language->code }}" href="{{ config('app.url').'/'.$language->code.'/'.$item->slug }}" />
                @endforeach
            </url>
        @endforeach
    @endforeach
    @foreach ($tags as $item)
        <url>
            <loc>{{ config('app.url').'/en/tag/'.$item->slug }}</loc>
            @foreach ($languages as $language)
                <xhtml:link rel="alternate" hreflang="{{ $language->code }}" href="{{ config('app.url').'/'.$language->code.'/'.$item->slug }}" />
            @endforeach
        </url>
        @foreach ($languages->where('id', '!=', 1) as $language)
            <url>
                <loc>{{ config('app.url').'/'.$language->code.'/tag/'.$item->slug }}</loc>
                @foreach ($languages as $language)
                    <xhtml:link rel="alternate" hreflang="{{ $language->code }}" href="{{ config('app.url').'/'.$language->code.'/'.$item->slug }}" />
                @endforeach
            </url>
        @endforeach
    @endforeach
</urlset>
