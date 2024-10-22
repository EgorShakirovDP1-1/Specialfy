<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserAuthenticateRequest;

class AuthController extends Controller
{
    public function register() {
        $film = asset(Storage::url('filmImages/82hM0Dk62kt4U1TYcZfduRYviyHXAO9uKxeGQhCf.png'));

        return Inertia::render('Auth/Register', ['film' => $film]);
    }

    public function store(UserCreateRequest $request) {

        User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),]);

        // Mail::to($user->email)
        // ->send(new WelcomeEmail($user));

        return redirect()->route('home')->with('message', 'Please log in!');
    }

    public function login() {
        $film = asset(Storage::url('filmImages/82hM0Dk62kt4U1TYcZfduRYviyHXAO9uKxeGQhCf.png'));

        return Inertia::render('Auth/Login', ['film' => $film]);
    }

    public function authenticate(UserAuthenticateRequest $request){

        if(auth()->attempt($request->validated())){
            request()->session()->regenerate();

            return redirect()->route('home')->with('message', 'Logged in successfully!');
        };

        return redirect()->route('login')->withErrors([
            'email'=> "Failed to log in! Please try again!"
        ]);
    }

    public function logout(){
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home')->with('message', 'Logged Out successfully!');
    }
}
