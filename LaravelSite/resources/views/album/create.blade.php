@extends('layouts.generic-form')

@section('title')
Create Album
@endsection

@section('form-attributes')
action="{{ route('album.store') }}" method="post" class="generic-form"
@endsection

@section('header')
@extends('layouts.header')
@endsection

{{-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}

@section("inputs")
@csrf
<div>
    <label for="name">Name</label>
    <input type="text" id="name" name="name" class="w-100">
</div>
<div>
    <label for="artist_id">Artist</label>
    <select id="artist_id" name="artist_id" class="w-100">
        @foreach ($artists as $artist)
        <option value="{{ $artist->id }}">{{ $artist->name }}</option>
        @endforeach
    </select>
</div>
<div>
    <label for="genre_id">Genre</label>
    <select id="genre_id" name="genre_id" class="w-100">
        @foreach ($genres as $genre)
        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
    </select>
</div>
<div>
    <label for="release_date">Release Date</label>
    <input type="date" id="release_date" name="release_date" class="w-100">
</div>

<p class="redirect">
    <a href="{{ route('signup') }}">Forgot Password?</a><br>
    Don't have an account? <a href="{{ route('signup') }}">Sign up</a>
</p>
@endsection

@section("button")
<button type="submit">Create Album</button>
@endsection

@section("logs")
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@endsection