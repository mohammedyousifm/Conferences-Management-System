<?php

namespace App\Http\Controllers\Dashboard\controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Invitation;
use Carbon\Carbon;


class AddreviewerController extends Controller
{
    public function index()
    {

        return view('2-dashboard.controller.add-reviewer');
    }

    /**
     * Send an invitation email with a unique registration link.
     *
     * This function generates a secure token, stores the invitation details in the database,
     * and sends an email with the invitation link to the specified recipient.
     * The link expires in 24 hours.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendInvitation(Request $request)
    {
        try {
            // ✅ Validate request input
            $request->validate([
                'email' => 'required|email',
            ]);

            $email = $request->email;

            // ✅ Check for existing invitations that haven't expired yet
            $existingInvitation = Invitation::where('email', $email)
                ->where('expires_at', '>', now()) // Active invitation exists
                ->where('used', false) // Ensure it hasn't been used
                ->first();

            if ($existingInvitation) {
                flash()->options([
                    'timeout'  => 5000,
                    'position' => 'top-center',
                ])->warning('An active invitation already exists for this email.');
                return back();
            }

            // ✅ Generate a unique and secure token
            $token = Str::random(40);
            $registrationLink = url("/register?token={$token}");

            // ✅ Store new invitation securely in the database
            Invitation::create([
                'email'         => $email,
                'controller_id' => auth()->id(),
                'token'         => $token,
                'expires_at'    => now()->addDay(), // Valid for 24 hours
            ]);

            // ✅ Send invitation email asynchronously
            Mail::to($email)->queue(new \App\Mail\ReviewerInvitation($registrationLink));

            // ✅ Display success message
            flash()->options([
                'timeout'  => 5000,
                'position' => 'top-center',
            ])->success('Invitation sent successfully!');
        } catch (\Exception $e) {
            // ✅ Handle errors and provide feedback
            flash()->options([
                'timeout'  => 5000,
                'position' => 'top-center',
            ])->error('Failed to send invitation: ' . $e->getMessage());
        }


        return back();
    }
}
