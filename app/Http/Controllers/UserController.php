<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(UserRequest $request)
    {
        $validated = $request->validated();

        // Check if password is already used by another user
        $existingUser = $this->userRepository->findByPassword($validated['password']);

        if ($existingUser) {
            return back()->withErrors([
                'password' => "Sorry, this password is already used by {$existingUser->username}",
            ])->withInput();
        }

        // Create new user
        $user = $this->userRepository->createUser($validated);

        return view('success', ['username' => $user->username]);
    }
}
