<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href={{asset('css/style.css')}}>
</head>

@extends('layouts.header')

@section('Create Artist', 'Create Artist')
@section('content')

<body>

    <div class="container">
        <form action="/" method="POST">
            @csrf
            <div class="container_input">
                <div>
                    <label for="artist_name">Artist Name</label>
                    <input type="text" id="artist_name">
                </div>
                <div>
                    <label for="genre">Genre</label>
                    <select name="genre" id="genre">
                        <option value="">Select genre</option>
                        <option value="rock">Rock</option>
                        <option value="rap">Rap</option>
                    </select>
                </div>
                <div>
                    <label for="artist_desc">Description</label>
                    <textarea name="artist_desc" id="desc"></textarea>
                </div>
                <div>
                    <button type="button" class="add-button" onclick="addFn()">Add Input Field</button>
                    <div id="tracks_field"></div>
                </div>
                <div class="button_div">
                    <button type="submit">Create Artist</button>
                </div>
        </form>
    </div>
</body>
@endsection

<script defer src={{asset("js/create.js")}}></script>

</html>