<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Album;
use Log;
use Illuminate\Support\Facades\Auth;
class ArtistController extends Controller
{
    public function index(){
        
        $artist = Artist::all();
        return view('index', compact('artist'));
        
    }

    public function create(){
        return view('artist.create');
    }


    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string'
        ]);

        $validatedData['user_id'] = Auth::user()->id;

        // Create a new artist and save to the database
        Artist::create($validatedData);

        // Redirect back to the index page
        return redirect()->route('artist.index')->with(   'success','Artist succesfully created');
    }

    public function show($id){
        $artist = Artist::findOrFail($id);
        return view('artist.show', compact('artist'));
    }
}
