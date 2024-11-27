<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Genre;

class GenreController extends Controller
{
    public function create()
    {
        return view('genre.create');
    }

    public function store(Request $request)
    {
        error_log("store");
        $request = $request->validate([
            'name' => 'required|string|max:255|min:3|unique:genres',
        ]);
        Genre::create($request);
        error_log("Validated");
        return redirect()->route('artist.index');
    }

    public function get($id)
    {

    }

    public function gets()
    {
        $genres = Genre::all();
        return view('genres.get', ['genres' => $genres]);
    }
}
