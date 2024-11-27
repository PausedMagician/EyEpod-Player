@extends('layouts.generic-form')

@section('title')
Login
@endsection

@section('form-attributes')
action="{{ route('login') }}" method="post" class="login-form"
@endsection

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@section("inputs")
@csrf
<div>
    <label for="name">Username:</label>
    <input type="text"      name="name" placeholder="Username" class="w-100">
</div>
<div>
    <label for="password">Password:</label>
    <input type="password"  name="password" placeholder="Password" class="w-100">
</div>

<p class="redirect">
    <a href="{{ route('signup') }}">Forgot Password?</a><br>
    Don't have an account? <a href="{{ route('signup') }}">Sign up</a>
</p>
@endsection

@section("button")
<button type="submit">Login</button>
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