@extends('layout.admin.master')

@section('content')

    <h1>
        Generate Batch Pages
    </h1>

    <form action="{{ route('generate.start') }}" method="POST">
        @csrf
        Amount: <input type="text" id="amount" name="amount"> (default 10)
        <br />
        Further prompt: <input type="text" id="prompt" name="prompt"> (eg. "All topics should be in the theme of hobbies and interests.")
        <br />
        <input type="submit" />
        <input type="hidden" id="type" name="type" value="batch">
    </form>

@endsection
