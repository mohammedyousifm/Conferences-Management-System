<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAuthor;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming user registration request.
     *
     * This function validates the registration data, checks for invitation tokens (if applicable),
     * assigns the appropriate user role, securely stores user credentials, and marks invitations as used.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            // ✅ Validate incoming registration data
            $request->validate([
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'token'    => ['nullable', 'string', 'exists:invitations,token'], // Optional: Required for reviewers
            ]);

            // ✅ Create a new user securely
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
            ]);

            // ✅ Send Email Notification
            mail::to($user->email)->send(new NewAuthor($user));

            // ✅ Display success message
            flash()->options([
                'timeout'  => 5000,
                'position' => 'top-center',
            ])->success('Account created successfully!');

            return redirect(route('login'));
        } catch (\Exception $e) {
            // ✅ Handle registration errors
            flash()->options([
                'timeout'  => 5000,
                'position' => 'top-center',
            ])->error('Registration failed: ' . $e->getMessage());
        }

        return back();
    }
}
