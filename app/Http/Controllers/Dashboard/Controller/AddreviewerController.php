<?php

namespace App\Http\Controllers\Dashboard\controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Invitation;
use Carbon\Carbon;


class AddreviewerController extends Controller
{
    public function index()
    {

        return view('2-dashboard.controller.add-reviewer');
    }

    public function sendInvitation(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Generate a unique token
        $token = Str::random(40);

        // Generate a secure invitation link
        $registrationLink = url("/login?token=$token");

        dd($registrationLink);

        // Store invitation data in database
        $invitation = Invitation::create([
            'email' => $request->email,
            'token' => $token,
            'expires_at' => Carbon::now()->addHours(24) // Link expires in 24 hours
        ]);



        // Send email with the invitation link
        Mail::to($request->email)->send(new \App\Mail\ReviewerInvitation($registrationLink));

        return response()->json(['message' => 'Invitation sent successfully!']);
    }
}
