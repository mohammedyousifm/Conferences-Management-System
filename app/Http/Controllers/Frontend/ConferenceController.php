<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\Paper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\NewActivity;
use App\Models\Activity;
use App\Events\NewPaper;

class ConferenceController extends Controller
{
    public function index()
    {

        // ✅ Pring all conferences date from  Conference tabe and store in $conferences
        $conferences = Conference::all();
        return view('1-frontend.home', compact('conferences'));
    }

    public function show($id)
    {

        // ✅ Find conference by Id from Conference table  and store the date in $Conference
        $Conference = Conference::findOrFail($id);
        return view('1-frontend.conference-details', compact('Conference'));
    }

    /**
     * Store the paper .
     *
     * @param Request $request The incoming HTTP request.
     * @event // Fire event to new paper
     * @param Paper $id The paper to Id  are being assigned.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        try {

            // DB::table('papers')->delete(); // Delete all rows
            // DB::statement("ALTER TABLE papers AUTO_INCREMENT = 1"); // Reset auto-increment


            // ✅ Validate Input
            $validatedData = $request->validate([
                'author_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'number_of_authors' => 'required|integer|min:1',
                'paper_title' => 'required|string|max:255',
                'abstract' => 'required|string',
                'keywords' => 'required|string',
                'paper_file' => 'required|max:2048',
            ]);

            // ✅ Generate Paper ID with leading zeros (e.g., 000001, 000002)
            $paperId = '#' . str_pad(Paper::max('id') + 1, 6, '0', STR_PAD_LEFT);
            // ✅ Store paper details in the database
            $paper = new Paper();
            $paper->user_id = auth::id();
            $paper->paper_code = $paperId;
            $paper->conference_id = $request['conference_id'];
            $paper->author_name = $validatedData['author_name'];
            $paper->email = $validatedData['email'];
            $paper->phone = $validatedData['phone'];
            $paper->address = $validatedData['address'];
            $paper->number_of_authors = $validatedData['number_of_authors'];
            $paper->paper_title = $validatedData['paper_title'];
            $paper->abstract = $validatedData['abstract'];
            $paper->keywords = $validatedData['keywords'];

            // ✅ Handle File Upload
            if ($request->hasFile('paper_file')) {
                $file = $request->file('paper_file');

                // Get the next paper code (assuming it's stored as #00001 format)
                $latestPaper = Paper::latest()->first();
                $nextPaperCode = $latestPaper ? intval(ltrim($latestPaper->paper_code, '#')) + 1 : 1;
                $formattedCode = str_pad($nextPaperCode, 5, '0', STR_PAD_LEFT); // Ensures 5-digit format

                // Construct file name as "paper_00001.pdf"
                $filename = "paper_{$formattedCode}." . $file->getClientOriginalExtension();
                $filePath = 'paperFile/' . $filename;

                // Move file to public/paperFile
                $file->move(public_path('paperFile'), $filename);

                // Store in database
                $paper->paper_code = "#{$formattedCode}"; // Save formatted code like "#00001"
                $paper->paper_file = $filePath; // Save file path
            }

            $paper->save();


            // ✅ Insert Recent Activity
            Activity::create([
                'paper_code' => $paperId,
                'user_id'    => auth::id(),
                'activity_type' => 'New Paper',
                'description' => 'submitted Paper ID'
            ]);

            // ✅ Get the controller ID of the conference
            $controllerId = Conference::where('id', $paper->conference_id)->value('controller_id');

            // Fire event to new paper
            event(new NewPaper($paperId));

            // ✅ Redirect Back with Success Message
            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'bottom-right',
                ])
                ->success('Paper submitted successfully!!');
        } catch (\Exception $e) {
            // ✅ Log the error
            Log::error('Paper submission failed: ' . $e->getMessage());

            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'bottom-right',
                ])
                ->error('Failed to submit paper. Please try again.' . $e->getMessage());
        }

        // ✅Redirect back with an error message
        return redirect()->back();
    }
}
