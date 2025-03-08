<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Invitation;
use Illuminate\Support\Facades\Log;

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

            $invitation = null;

            // ✅ Check if the user is registering as a reviewer
            if ($request->filled('token')) {
                $invitation = Invitation::where('token', $request->token)
                    ->where('expires_at', '>', now()) // Ensure the invitation is still valid
                    ->where('used', false)           // Ensure it hasn't been used
                    ->first();

                // ✅ Validate invitation details
                if (!$invitation || $invitation->email !== $request->email) {
                    flash()->options([
                        'timeout'  => 5000,
                        'position' => 'top-center',
                    ])->error('Invalid or expired invitation');

                    return back();
                }
            }

            // ✅ Assign appropriate user role
            $role = $invitation ? 'reviewer' : 'author';

            // ✅ Create a new user securely
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'user_role' => $role, // Dynamically assign role
            ]);

            // ✅ Fire the registered event
            event(new Registered($user));

            // ✅ Mark the invitation as used (if applicable)
            if ($invitation) {
                $invitation->update(['used' => true]);
            }

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
