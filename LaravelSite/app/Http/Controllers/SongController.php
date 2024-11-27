<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Song;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Album;

class SongController extends Controller
{
    public function index()
    {
        return view('song.index');
    }

    public function create()
    {
        // Get all genres
        $genres = Genre::all(columns: ['id', 'name']);
        // Get all albums
        $albums = Album::all(columns: ['id', 'name']);

        return view('song.create', ["genres"=>$genres, "albums"=>$albums]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:songs',
            'album_id' => 'required|exists:albums,id',
            'genre_id' => 'required|exists:genres,id',
            'length' => 'required|numeric',
        ]);


        // Create a new song and save to the database
        Song::create($request->all());

        return redirect()->route('artist.index');
    }

    public function get($id)
    {
        // Get a song by id
        $song = Song::find($id);
        // Get the album of the song
        $song->album;
        // Get the album artist
        $song->album->artist;
        // Get the genre of the song
        $song->genre;
        // Define header content-type
        return response()->json($song);
    }

    public function gets()
    {
        // Get all songs
        $songs = Song::all(columns: ['id']);
        // Define header content-type
        return response()->json($songs);
    }
}
