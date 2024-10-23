<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Album;

class ArtistController extends Controller
{
    public function index(){
        
        return view('index');
    }

    public function create(){
        return view('create');
    }

    public function show(Request $request){
        
    }


    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'artist_desc' => 'nullable|string',
        ]);

        // Create a new artist and save to the database
        $artist = new Artist($validatedData);
        $artist->name = $validatedData['name'];
        $artist->genre = $validatedData['genre'];
        $artist->artist_desc = $validatedData['artist_desc'];
        $artist->save();

        // Redirect back to the index page with a success message
        return redirect('/')->with('success', 'Artist created successfully!');
    }
}
