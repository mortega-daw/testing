<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd($request); // dd() is a Laravel function that dumps the data and dies
        //dd($request->get('name'));

        //MODIFICAR EL REQUEST
        $request->request->add(['username' => Str::slug($request->username)]);

        // Validate the user
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|min:3|max:20|unique:users',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6|max:30',
        ]);

        User::create([
            'name' => Str::slug($request->name), // what slug does is it takes a string and converts it into a URL friendly string (e.g. "John Doe" becomes "john-doe")
            'username' => $request->username,
            'email' => strtolower($request->email),
            'password' => bcrypt($request->password),
            //'password' => Hash::make($request->password),
        ]);

        //AUTHENTICATE THE USER
        auth()->attempt($request->only('email', 'password'));

        //Redirect the user
        return redirect()->route('post.index');
    }

}
