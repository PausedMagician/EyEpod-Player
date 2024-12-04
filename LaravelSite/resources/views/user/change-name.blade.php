@extends('layouts.generic-form')

@section('title')
Example Title
@endsection

@section('form-attributes')
action="{{ route('user.change-name') }}" method="" class="generic-form" id="change-name-form"
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
    <label for="username">Name</label>
    <input type="text" id="username" name="username" class="w-100" value="{{ Auth::user()->name }}"">
</div>
@endsection

@section("button")
<button type="submit">Change Name</button>
<script>
    var form = document.getElementById("change-name-form");
    function handleForm(event) {
        event.preventDefault();
        var username = document.getElementById("username").value;
        let res = fetch("{{ route('user.change-name') }}", {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ username: username })
        })
        // Return a redirect
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
            }
        })
    } 
    form.addEventListener('submit', handleForm);
</script>
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