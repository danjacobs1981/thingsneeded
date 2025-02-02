@extends('layout.admin.master')

@section('content')

    <div class="container">

        <div class="flex gap-5 items-center">
            <h1 class="text-xl font-bold">
                Edit Page ({{ $page->id }}) - {{ $page->title }}
            </h1>
            <button type="submit" form="update" class="ms-auto bg-teal-600 text-white px-3 py-1 rounded-xl cursor-pointer text-lg w-fit">Save Text</button>
        </div>

        <form id="update" action="{{ route('save.page', $page->slug) }}" method="POST" class="mt-8">

            @csrf

            <div class="grid gap-8 mt-8">
                <div class="grid gap-3">
                    Introduction:
                    <textarea name="introduction" id="introduction" class="ring-2 ring-teal-600 p-2 w-full h-40">{{ $page->introduction }}</textarea>
                </div>
                <div class="grid gap-3">
                    <div class="flex gap-5 items-center">
                        Humanized:
                        <span id="introduction_humanized_regen" class="bg-orange-500 text-white px-3 py-1 rounded-xl cursor-pointer text-lg w-fit">Regenerate</span>
                    </div>
                    <textarea name="introduction_humanized" id="introduction_humanized" class="ring-1 ring-slate-500 p-2 w-full h-40">{{ $page->introduction_humanized }}</textarea>
                </div>
                <div class="grid gap-3">
                    Gemini:
                    <textarea name="introduction_gemini" id="introduction_gemini" class="ring-1 ring-slate-500 p-2 w-full h-40">{{ $page->introduction_gemini }}</textarea>
                </div>
            </div>
            <div class="grid gap-8 mt-8">
                <div class="grid gap-3">
                    Conclusion:
                    <textarea name="conclusion" id="conclusion" class="ring-2 ring-teal-600 p-2 w-full h-40">{{ $page->conclusion }}</textarea>
                </div>
                <div class="grid gap-3">
                    <div class="flex gap-5 items-center">
                        Humanized:
                        <span id="conclusion_humanized_regen" class="bg-orange-500 text-white px-3 py-1 rounded-xl cursor-pointer text-lg w-fit">Regenerate</span>
                    </div>
                    <textarea name="conclusion_humanized" id="conclusion_humanized" class="ring-1 ring-slate-500 p-2 w-full h-40">{{ $page->conclusion_humanized }}</textarea>
                </div>
                <div class="grid gap-3">
                    Gemini:
                    <textarea name="conclusion_gemini" id="conclusion_gemini" class="ring-1 ring-slate-500 p-2 w-full h-40">{{ $page->conclusion_gemini }}</textarea>
                </div>
            </div>

        </form>

    </div>

    <script>
        function run() {

            let xhr = new XMLHttpRequest();

            let url = "{{ route('humanize.page', $page->slug) }}";
            xhr.open("POST", url, true);

            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            }

            xhr.send("introduction=1&conclusion=0");
        }

        run();

    </script>

@endsection
