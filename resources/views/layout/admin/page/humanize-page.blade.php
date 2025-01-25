@extends('layout.admin.master')

@section('content')

    <h1>
        Humanize Page (intro &amp; conclusion)
    </h1>

    <form action="{{ route('humanize.start') }}" method="POST">
        @csrf
        Page IDs: <input type="text" id="id" name="id"> (comma seperated IDs)
        <br />
        <input type="submit" />
    </form>

@endsection
