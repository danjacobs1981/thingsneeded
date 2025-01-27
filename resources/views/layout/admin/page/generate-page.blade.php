@extends('layout.admin.master')

@section('content')

    <div class="container">

        <h1 class="text-xl mb-4 font-bold">
            Generate Page
        </h1>

        <form action="{{ route('generate.start') }}" method="POST">
            @csrf
            <div class="grid gap-3">
                <div class="flex gap-4 items-center">
                    Topic: <input type="text" id="topic" name="topic" class="ring-1 ring-slate-500">
                </div>
                <div class="flex gap-4 items-center">
                    Further prompt: <input type="text" id="prompt" name="prompt" class="ring-1 ring-slate-500">
                </div>
                <div class="flex gap-4 items-center">
                    Overwrite Page ID: <input type="text" id="page_id" name="page_id" class="ring-1 ring-slate-500"> (this will take existing topic &amp; keep image (if it exists))
                </div>
                <input type="submit" class="bg-teal-600 text-white p-2.5 rounded-xl cursor-pointer text-lg w-fit" />
            </div>
            <input type="hidden" id="type" name="type" value="page">
        </form>

    </div>

@endsection
