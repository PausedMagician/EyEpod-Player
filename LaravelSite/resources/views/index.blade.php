<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
    <script src={{ asset('js/eyepod.js') }}></script>
</head>

@extends('layouts.stencil')

@section('content')

<body>
    <div>
        <div class="eyepod">
            <div class="screen-container">
                <div style="width: 100%; position: relative;">
                    <div class="screen">
                    </div>
                    <div class="player">
                        <div class="album">
                            <img src="{{ asset('images/album.jpg') }}" alt="">
                        </div>
                        <div class="other">
                            <div class="info">
                                <div class="info-text">
                                    <div class="title">Title</div>
                                    <div class="artist">Artist</div>
                                </div>
                            </div>
                            <div class="progress">
                                <progress value="0" max="100"></progress>
                            </div>
                            <div class="controls">
                                <div class="button"><img style="transform: rotate(180deg)"
                                        src="{{ asset('icons/Forward.svg') }}" alt=""></div>
                                <div class="button"><img src="{{ asset('icons/PauseResume.svg') }}" alt="">
                                </div>
                                <div class="button"><img src="{{ asset('icons/Forward.svg') }}" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wheel-container">
                <div class="wheel">
                    <div onclick="menuClick()" class="button"><img src="{{ asset('icons/Menu.svg') }}" draggable="false"
                            alt="">
                    </div>
                    <div onclick="skipClick()" class="button"><img src="{{ asset('icons/Forward.svg') }}"
                            draggable="false" alt=""></div>
                    <div onclick="pickClick()" class="button"><img src="{{ asset('icons/Forward.svg') }}"
                            draggable="false" alt=""></div>
                    <div onclick="playClick()" class="button"><img src="{{ asset('icons/PauseResume.svg') }}"
                            draggable="false" alt=""></div>
                    <div onclick="middClick()" class="middle-button"></div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection