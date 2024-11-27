@extends('layouts.generic-form')

@section('title')
Create Song
@endsection

@section('form-attributes')
action="{{ route('song.store') }}" method="post" class="generic-form"
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
    <label for="title">Title</label>
    <input type="text" id="title" name="title" class="w-100">
</div>
<div>
    <label for="album_id">Album</label>
    <select name="album_id" id="album_id" class="w-100">
        <option value="">Select album</option>
        <?php foreach ($albums as $album) : ?>
            <option value="<?= $album->id ?>"><?= $album->name ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div>
    <label for="genre_id">Genre</label>
    <select name="genre_id" id="genre_id" class="w-100">
        <option value="">Select genre</option>
        <?php foreach ($genres as $genre) : ?>
            <option value="<?= $genre->id ?>"><?= $genre->name ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div>
    <label for="length">Duration (seconds)</label>
    <input type="number" step="1" id="length" name="length" class="w-100">
</div>

<p class="redirect">
    <a href="{{ route('signup') }}">Forgot Password?</a><br>
    Don't have an account? <a href="{{ route('signup') }}">Sign up</a>
</p>
@endsection

@section("button")
<button type="submit">Create Song</button>
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