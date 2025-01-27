@extends('layout.admin.master')

@section('content')

    <h1>
        Humanize Page (intro &amp; conclusion)
    </h1>

    <form action="{{ route('humanize.start') }}" method="POST">
        @csrf
        Page IDs: <input type="text" id="id" name="id"> (comma seperated IDs)
        <br />
        <label for="introduction">
            introduction
            <input type="checkbox" id="introduction" name="introduction" value="1" checked />
        </label>
        <br />
        <label for="conclusion">
            conclusion
            <input type="checkbox" id="conclusion" name="conclusion" value="1" checked />
        </label>
        <br />
        <input type="submit" />
    </form>

@endsection
