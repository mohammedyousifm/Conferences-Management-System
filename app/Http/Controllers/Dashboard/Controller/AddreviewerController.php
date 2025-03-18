<?php

namespace App\Http\Controllers\Dashboard\controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\AddReviewer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Invitation;
use App\Models\User;
use App\Models\Activity;
use Carbon\Carbon;


class AddreviewerController extends Controller
{
    /**
     * Show the form to send a reviewer invitation.
     *
     * This method displays a form where the controller (admin or manager) can
     * enter the reviewer's email and a personalized message. Once submitted,
     * an invitation email will be sent to the reviewer with details on how to
     * accept the invitation and access the platform.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        return view('2-dashboard.controller.add-reviewer');
    }

    /**
     * Handle sending the reviewer invitation.
     *
     * This method processes the form submission by:
     * - Validating the provided email and message.
     * - Checking if the email exists in the database.
     * - Sending an invitation email containing a unique link for the reviewer to join.
     * - Storing the invitation details in the database for tracking.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        try {

            $request->validate([
                'email' => 'required|email|unique:invitations,email',
                'reviewer_name' => 'required|string|max:255',
                'message' => 'nullable|string',
            ]);

            $token = Str::random(32);
            $expiresAt = now()->addDays(7); // Set expiration time (7 days)


            // Store invitation in the database
            $invitation = Invitation::create([
                'controller_id' => auth()->id(),
                'email' => $request->email,
                'token' => $token,
                'expires_at' => $expiresAt,
                'used' => false,
            ]);

            // ✅ Insert Recent Activity
            if ($invitation) {
                Activity::create([
                    'paper_code' => $request->reviewer_name,
                    'user_id'    => auth::id(),
                    'activity_type' => 'send invitation',
                    'description' => 'have sent reviewer invitation To'
                ]);
            }


            $ControllerName =   Auth::user()->name;
            $invitationLink = route('reviewer.register', ['token' => $token]);

            // Send email
            Mail::to($request->email)->send(new AddReviewer($ControllerName,  $invitationLink, $request->reviewer_name, $request->message));

            // ✅ Redirect Back with Success Message
            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'top-center',
                ])
                ->success('send reviewer invitation successfully!');
        } catch (\Exception $e) {

            // ✅ Log the Error Correctly
            Log::error('Status updater: ' . $e->getMessage());

            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'top-center',
                ])
                ->error('Failed to send reviewer invitation' . $e->getMessage());
        }


        return back();
    }


    /**
     * Handles displaying the reviewer registration form.
     *
     * This method is triggered when a reviewer clicks on the invitation link.
     * It verifies the token's validity, checks if the invitation is unused,
     * and allows the reviewer to proceed with registration.
     *
     * @param string $token - Unique token sent in the invitation email.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function reviewer_register($token)
    {
        // Find the invitation using the token and ensure it's not used or expired
        $invitation = Invitation::where('token', $token)
            ->where('used', false)
            ->first();

        // If the invitation is not found or expired, redirect with an error message
        if (!$invitation || now()->greaterThan($invitation->expires_at)) {
            return redirect()->route('login')->with('error', 'Invalid or expired invitation.');
        }

        // Show the registration form, pre-filling the email field
        return view('2-Dashboard.controller.Invitation.register', ['invitation' => $invitation]);
    }

    /**
     * Stores the reviewer's details and completes the registration.
     *
     * This method processes the reviewer's registration by:
     * - Validating the form data
     * - Checking if the invitation exists and is unused
     * - Creating a new user with the role of 'reviewer'
     * - Marking the invitation as used
     * - Redirecting the reviewer to the login page with a success message
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_reviewer(Request $request)
    {
        try {

            // Validate the incoming request
            $request->validate([
                'token' => 'required|string|exists:invitations,token',
                'name' => 'required|string|max:255',
                'email' => 'required|email|exists:invitations,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Find the invitation based on the provided token and email
            $invitation = Invitation::where('token', $request->token)
                ->where('email', $request->email)
                ->where('used', false)
                ->first();

            // If the invitation is invalid or already used, redirect with an error
            if (!$invitation) {
                return redirect()->route('login')->with('error', 'Invalid or expired invitation.');
            }

            // Create the reviewer account
            $reviewer = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_role' => 'reviewer',
            ]);

            // Mark the invitation as used
            $invitation->update(['used' => true]);

            // ✅ Insert Recent Activity
            if ($reviewer) {
                Activity::create([
                    'paper_code' => $request->name,
                    'user_id'    => $reviewer->id,
                    'activity_type' => 'accept invitation',
                    'description' => 'has accept the invitation'
                ]);
            }

            // Redirect with a success message
            return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
        } catch (\Exception $e) {

            // ✅ Log the Error Correctly
            Log::error('Status updater: ' . $e->getMessage());

            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'top-center',
                ])
                ->error('Failed to Registration' . $e->getMessage());
        }


        return back();
    }
}
