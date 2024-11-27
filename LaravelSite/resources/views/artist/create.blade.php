@extends('layouts.generic-form')

@section('title')
Example Title
@endsection

@section('form-attributes')
action="{{ route('artist.store') }}" method="post" class="generic-form"
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
    <label for="bio">Bio</label>
    <textarea id="bio" name="bio" class="w-100"></textarea>
</div>

<p class="redirect">
    <a href="{{ route('artists.get') }}">All artists</a><br>
</p>
@endsection

@section("button")
<button type="submit">Create Artist</button>
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