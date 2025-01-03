<header>
    <h1><a href="{{route('artist.index')}}">EyePod</a></h1>
    
    <div>
        @auth
        <span>Welcome, {{ Auth::user()->name }}</span>
        <span><a href="{{ route('user.change-name') }}">Change Name</a></span>
        @endauth
    </div>
    
    <div>
        <ul>
            @auth
            <li><a href="{{ route('artist.create') }}">Create Artist</a></li>
            <li><a href="{{ route('album.create') }}">Create Album</a></li>
            <li><a href="{{ route('song.create') }}">Create Song</a></li>
            <li><a href="{{ route('genre.create') }}">Create Genre</a></li>
            <li><a href="">Artist</a></li>
            @endauth
            <div class="auth">
                @guest
                <li><a href="{{ route('signup') }}" class = button>Sign Up</a></li>
                <li><a href="{{ route('login') }}" class = button>Login</a></li>
                @endguest
                
                @auth
                <li><a href="{{ route('logout') }}" class = button>Logout</a></li>
                @endauth
            </div>
        </ul>
    </div>
</header>