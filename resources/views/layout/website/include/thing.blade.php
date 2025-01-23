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
</li>
