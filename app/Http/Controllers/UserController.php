<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string',
        ]);

        $existingUser = User::all()->first(function ($user) use ($request) {
            return Hash::check($request->password, $user->password);
        });

        if ($existingUser) {
            return back()->withErrors([
                'password' => "Sorry, this password is already used by {$existingUser->username}",
            ])->withInput();
        }


        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return view('success', ['username' => $user->username]);
    }
}
