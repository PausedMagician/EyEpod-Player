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
    <label for="name">Title</label>
    <input type="text" id="name" name="name" class="w-100">
</div>
<div>
    <label for="album">Album</label>
    <select name="album" id="album" class="w-100">
        <option value="">Select album</option>
        <?php foreach ($albums as $album) : ?>
            <option value="<?= $album->id ?>"><?= $album->name ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div>
    <label for="genre">Genre</label>
    <select name="genre" id="genre" class="w-100">
        <option value="">Select genre</option>
        <?php foreach ($genres as $genre) : ?>
            <option value="<?= $genre->id ?>"><?= $genre->name ?></option>
        <?php endforeach; ?>
    </select>
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