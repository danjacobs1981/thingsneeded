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
                {{ __('website.page.amazon.buy') }}
            </span>
        </a>
    </div>
</li>
