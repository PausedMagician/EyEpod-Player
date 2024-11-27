@extends('layouts.generic-form')

@section('title')
Example Title
@endsection

@section('form-attributes')
action="{{ route('/') }}" method="post" class="generic-form"
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
    <label for="example_value">Example Value</label>
    <input type="text" id="example_value" name="example_value" class="w-100">
</div>

<p class="redirect">
    <a href="{{ route('/') }}">Example Redirect</a><br>
    Example Question <a href="{{ route('/') }}">Example Link</a>
</p>
@endsection

@section("button")
<button type="submit">Example Submit</button>
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