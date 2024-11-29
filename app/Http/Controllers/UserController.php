<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;

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

        try {
            $existingUser = $this->userRepository->findByPassword($validated['password']);

            if ($existingUser) {
                return back()->withErrors([
                    'password' => "Sorry, this password is already used by {$existingUser->username}",
                ])->withInput();
            }

            $user = $this->userRepository->createUser($validated);

            return view('success', ['username' => $user->username]);

        } catch (\RuntimeException $e) {
            Log::error("Runtime exception during registration: " . $e->getMessage());
            return back()->withErrors([
                'general' => 'An error occurred during registration. Please try again later.',
            ])->withInput();
        } catch (\Exception $e) {
            Log::error("Unexpected exception: " . $e->getMessage());
            return back()->withErrors([
                'general' => 'An unexpected error occurred. Please contact support.',
            ])->withInput();
        }
    }
}
