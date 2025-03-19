<?php

namespace App\Http\Controllers\Dashboard\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ConferenceController extends Controller
{
    /**
     * Summary of conferences
     * @return \Illuminate\Contracts\View\View
     */
    public function conferences()
    {
        // ✅ Get the logged-in controller ID
        $controllerId = Auth::id();

        $Conferences = Conference::where('controller_id', $controllerId)->latest()->paginate(10);
        return view('2-dashboard.controller.conferences.conference', compact('Conferences'));
    }

    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {

        return view('2-dashboard.controller.conferences.create');
    }

    /**
     * Summary of store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        // DB::table('conferences')->delete(); // Delete all rows
        // DB::statement("ALTER TABLE conferences AUTO_INCREMENT = 1"); // Reset auto-increment
        try {
            // ✅ Validate Input
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'registration_deadline' => 'required|date|before_or_equal:end_date',
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
                ->success('Conference created successfully!');
        } catch (\Exception $e) {
            // ✅ Log the Error Correctly
            Log::error('Conference create Error: ' . $e->getMessage());

            // ✅ Redirect Back with Error Message
            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'top-center',
                ])
                ->error('Failed to create Conference! ' . $e->getMessage());
        }

        return back();
    }

    /**
     * Summary of view
     * @return \Illuminate\Contracts\View\View
     */
    public function view()
    {
        return view('2-dashboard.controller.conferences.view');
    }

    /**
     * Summary of destroy
     * @param \App\Models\Conference $conference
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Conference $conference)
    {
        try {
            $conference->delete();
            return redirect()->route('controller.conferences')->with('success', 'Conference deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('controller.conferences')->with('error', 'Failed to delete conference.');
        }
    }
}
