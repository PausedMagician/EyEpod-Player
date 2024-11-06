<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    
    public function signup(){
        return view("signup");
    }
    public function store(Request $request){
        
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'password2' => 'required|string|same:password'
        ]);
        
        //Create new user and saved to the database
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make( $validatedData['password'] ),
        ]);
        //Redirect to the login page
        return redirect()->route('login')->with('success','User succesfully created');
    }

    public function login(){
        return view('login');
    }

    public function authenticate(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();
            // Add the user id to the session
            $request->session()->put('user_id', Auth::id());
            return redirect()->route('artist.index')->with('success','Logged in successfully');
        }
        return back()->with('error','Something went wrong');
    }

    public function logout(){
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}
