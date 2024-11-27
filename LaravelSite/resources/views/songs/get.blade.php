<div>
    <h1>Get Songs</h1>
    <ul>
        @foreach ($songs as $song)
            <li>{{ $song->title }}</li>
        @endforeach
    </ul>
    <a href="{{ route('song.create') }}">Create a new song</a>
</div>
