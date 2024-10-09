<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href={{asset('css/style.css')}}>
</head>

<header>
    <h1><a href="">EyePod</a></h1>
    <div>
        <ul>
            <li><a href="./Create Artist">Create Artist</a></li>
            <li><a href="">Create Album</a></li>
            <li><a href="">Artist</a></li>
        </ul>
    </div>
</header>
<body>
    <div>
        <div class="eyepod">
            <div class="screen-container">
                <div class="screen"></div>
            </div>
            <div class="wheel-container">
                <div class="wheel">
                    <button><img src="{{asset('icons/Menu.svg')}}" alt=""></button>
                    <button><img src="{{asset('icons/Forward.svg')}}" alt=""></button>
                    <button><img src="{{asset('icons/Forward.svg')}}" alt=""></button>
                    <button><img src="{{asset('icons/PauseResume.svg')}}" alt=""></button>
                    <button class="middle-button"></button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>