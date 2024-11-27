@extends('layouts.generic-form')

@section('title')
Create Genre
@endsection

@section('form-attributes')
action="{{ route('genre.store') }}" method="post" class="generic-form"
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
    <input type="text" id="name" name="name">
</div>
<p class="redirect">
    <a href="{{ route('signup') }}">Forgot Password?</a><br>
    Don't have an account? <a href="{{ route('signup') }}">Sign up</a>
</p>
@endsection

@section("button")
<button type="submit">Create Genre</button>
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