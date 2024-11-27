<div>
    <h1>Get Genres</h1>
    <ul>
        @foreach ($genres as $genre)
            <li>{{ $genre->title }}</li>
        @endforeach
    </ul>
    <a href="{{ route('genre.create') }}">Create a new genre</a>
</div>
