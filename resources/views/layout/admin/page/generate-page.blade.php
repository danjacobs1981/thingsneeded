@extends('layout.admin.master')

@section('content')

    <h1>
        Generate Page
    </h1>

    <form action="{{ route('generate.start') }}" method="POST">
        @csrf
        Topic: <input type="text" id="topic" name="topic">
        <br />
        Further prompt: <input type="text" id="prompt" name="prompt">
        <br />
        Overwrite Page ID: <input type="text" id="page_id" name="page_id"> (this will take existing topic)
        <br />
        <input type="submit" />
        <input type="hidden" id="type" name="type" value="page">
    </form>

@endsection
