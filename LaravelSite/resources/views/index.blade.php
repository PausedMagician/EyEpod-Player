<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src={{ asset('js/eyepod.js') }}></script>
</head>

@extends('layouts.stencil')

@section('content')

<body>
    <div>
        <div class="eyepod">
            <div class="screen-container">
                <div class="bounding-box">
                    <div class="screen">
                    </div>
                    <div class="status-bar">
                        <div class="status-icon">
                            <img src="{{ asset('icons/Play.svg') }}" draggable="false" alt="">
                        </div>
                        {{-- Title --}}
                        <div class="status-text">
                        </div>
                        <div class="status-icon">
                            <img src="{{ asset('icons/Volume.svg') }}" draggable="false" alt="">
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