@extends('layouts.generic-form')

@section('title')
Sign Up
@endsection

@section('form-attributes')
action="{{ route('signup') }}" method="POST" class="signup-form"
@endsection

@section("inputs")
@csrf
<div>
    <label  for="username">Username:</label>
    <input  type="text"      name="username" placeholder="Username"  class="w-100"  pattern="[a-zA-Z0-9]{1,}" title="Your username has to contain at least one letter or number.">
</div>
<div>
    <label  for="email">Email:</label>
    <input  type="email"     name="email"    placeholder="Email"     class="w-100"  pattern="[a-zA-Z]{3,}@[a-zA-Z]{3,}\.[a-zA-Z]{2,}" required>
</div>

<div>
    <label  for="password">Password:</label>
    <input  type="password"  name="password" placeholder="Password"  class="w-100"  pattern=".{8,}" title="Password must be at least 8 characters.">
</div>

<div>
    <label  for="password">Confirm password:</label>
    <input  type="password"  name="password2" placeholder="Password"  class="w-100">
</div>

<p class="redirect">Already have an account? <a href="{{ route('login') }}">Login</a></p>

@endsection

@section("button")
<button type="submit">Sign Up</button>
<script>
    document.querySelector('.signup-form').addEventListener('submit', function(e) {
        let password = document.querySelector('input[name="password"]');
        let password2 = document.querySelector('input[name="password2"]');
        if (password.value !== password2.value) {
            e.preventDefault();
            password2.setCustomValidity('Passwords do not match');
        }
    });
</script>
@endsection