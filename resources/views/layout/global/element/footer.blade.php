<footer class="mt-auto">
    <div class="mt-8 xl:mt-10">
        <div class="bg-teal-100 py-6 sm:py-10 relative">
            <div class="container">
                <img loading="lazy" src="{{ asset('storage/logo-box.svg') }}" width="200" height="200" class="hidden sm:block absolute right-0 bottom-0" alt="Box" />
                <div class="flex flex-col items-center sm:flex-row">
                    <a href="/" class="whitespace-nowrap sm:pe-8 hover:underline">
                        &copy; ThingsNeeded.com
                    </a>
                    <ul class="flex marker:text-slate-400 list-disc space-x-5 mt-2 sm:mt-0">
                        <li class="list-none pe-3 sm:list-disc">
                            <a href="{{ LaravelLocalization::localizeUrl(route('privacy')) }}" class="hover:underline">
                                {{ __('footer.privacy') }}
                            </a>
                        </li>
                        {{-- <li>
                            <a href="#" class="hover:underline">
                                {{ __('footer.terms') }}
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
