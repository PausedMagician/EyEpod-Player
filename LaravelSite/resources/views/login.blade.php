@extends('layouts.login-signup-form')

@section('title')
Login
@endsection

@section('form-attributes')
action="{{ route('login') }}" method="post" class="login-form"
@endsection

@section("inputs")
<div>
    <label for="username">Username:</label>
    <input type="text"      name="username" placeholder="Username" class="w-100">
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