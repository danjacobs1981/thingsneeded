@extends('layout.admin.master')

@section('content')

    <h1>
        Translate Page
    </h1>

    <form action="{{ route('translate.start') }}" method="POST">
        @csrf
        Page IDs: <input type="text" id="id" name="id"> (comma seperated IDs)
        <br />
        <input type="submit" />
    </form>

@endsection
