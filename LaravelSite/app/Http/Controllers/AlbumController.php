<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function create(){
        // Get artists and genres
        $artists = Artist::all(columns: ['id', 'name']);
        $genres = Genre::all();

        return view('album.create', compact('artists', 'genres'));
    }

    public function store(Request $request){
        error_log("store");
        error_log($request);

        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:albums',
            'artist_id' => 'required|exists:artists,id',
            'genre_id' => 'required|exists:genres,id',
            'release_date' => 'required|date',
        ]);

        // Create a new album and save to the database
        Album::create($validatedData);

        // Redirect back to the index page
        return redirect()->route('artist.index')->with('success','Album succesfully created');
    }

    public function get($id){
        $album = Album::findOrFail($id);
        return view('album.get', compact('album'));
    }

    public function gets(){
        $albums = Album::all();
        return view('albums.get', compact('albums'));
    }
}
