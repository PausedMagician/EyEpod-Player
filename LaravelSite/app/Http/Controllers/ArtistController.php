<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Album;
use Log;
class ArtistController extends Controller
{
    public function index(){
        
        $artist = Artist::all();
        return view('index', compact('artist'));
        
    }

    public function create(){
        return view('create');
    }


    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        // Create a new artist and save to the database
        Artist::create($request->all());

        // Redirect back to the index page
        return redirect()->route('artist.index')->with(   'success','Artist succesfully created');
    }

    public function show($id){
        $artist = Artist::findOrFail($id);
        return view('artist.show', compact('artist'));
    }
}
