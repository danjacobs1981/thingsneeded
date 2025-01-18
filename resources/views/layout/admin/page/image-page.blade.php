@extends('layout.admin.master')

@section('content')

    <h1>
        Generate Image
    </h1>

    <form action="{{ route('image.start') }}" method="POST">
        @csrf
        Page IDs: <input type="text" id="id" name="id"> (comma seperated IDs)
        <br />
        <input type="submit" />
    </form>

@endsection
