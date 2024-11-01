@extends('layouts.login-signup-form')

@section('title')
Sign Up
@endsection

@section('form-attributes')
action="{{ route('signup') }}" method="post" class="signup-form"
@endsection

@section("inputs")
<div>
    <label  for="username">Username:</label>
    <input  type="text"      name="username" placeholder="Username"  class="w-100">
</div>
<div>
    <label  for="email">Email:</label>
    <input  type="email"     name="email"    placeholder="Email"     class="w-100">
</div>

<div>
    <label  for="password">Password:</label>
    <input  type="password"  name="password" placeholder="Password"  class="w-100">
</div>

<p class="redirect">Already have an account? <a href="{{ route('login') }}">Login</a></p>

@endsection

@section("button")
<button type="submit">Sign Up</button>
@endsection