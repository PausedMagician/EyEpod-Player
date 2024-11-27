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
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'genre' => 'required',
            'year' => 'required|integer',
        ]);

        return redirect()->route('artist.index');
    }

    public function get($id)
    {
        echo $id;
        // return view('songs.get');
    }

    public function gets()
    {
        // Get all songs
        $songs = Song::all(columns: ['id']);
        return view('songs.get', ["songs"=>$songs]);
    }
}
