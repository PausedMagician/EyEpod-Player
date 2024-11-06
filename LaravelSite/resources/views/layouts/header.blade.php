<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your App Title')</title>
    <link rel="stylesheet" href={{asset('css/style.css')}}>
</head>

<body>
    <header>
        <h1><a href="{{route('artist.index')}}">EyePod</a></h1>
        <div>
            <ul>
                <li><a href="{{ route('artist.create') }}">Create Artist</a></li>
                <li><a href="">Create Album</a></li>
                <li><a href="">Artist</a></li>
                <li><a href="{{ route('signup') }}">Sign Up</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </header>

    <main>
        @yield('content')  <!-- Placeholder for content -->
    </main>

    <footer>
    </footer>
</body>

</html>