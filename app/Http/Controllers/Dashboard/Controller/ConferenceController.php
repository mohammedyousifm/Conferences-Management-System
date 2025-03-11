<?php

namespace App\Http\Controllers\Dashboard\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ConferenceController extends Controller
{
    public function conference()
    {
        // ✅ Get the logged-in controller ID
        $controllerId = Auth::id();

        $Conferences = Conference::where('controller_id', $controllerId)->latest()->paginate(10);
        return view('2-dashboard.controller.conference', compact('Conferences'));
    }

    public function store(Request $request)
    {

        try {
            // ✅ Validate Input
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'registration_deadline' => 'required|date|before:start_date',
                'location' => 'required|string|max:255',
            ]);

            // ✅ Store Data in Database
            Conference::create([
                'title' => $request->title,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'registration_deadline' => $request->registration_deadline,
                'location' => $request->location,
                'status' => 'upcoming',
                'controller_id' => auth()->id()
            ]);

            // ✅ Redirect Back with Success Message
            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'top-center',
                ])
                ->success('Conference added successfully!');
        } catch (\Exception $e) {
            // ✅ Log the Error Correctly
            Log::error('Conference Store Error: ' . $e->getMessage());

            // ✅ Redirect Back with Error Message
            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'top-center',
                ])
                ->error('Failed to add Conference! ' . $e->getMessage());
        }

        return back();
    }
}
