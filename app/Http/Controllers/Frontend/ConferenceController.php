<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\Paper;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\NewActivity;
use App\Models\Activity;
use App\Models\Paper_controller;
use App\Events\NewPaper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ControllerReport;
use App\Mail\NewPaper as PaperNew;

class ConferenceController extends Controller
{
    public function index()
    {

        // ✅ Pring all conferences date from  Conference tabe and store in $conference
        $conferences = Conference::all();
        return view('1-frontend.home', compact('conferences'));
    }

    public function show($id)
    {

        // ✅ Find conference by Id from Conference table  and store the date in $Conference
        $Conference = Conference::findOrFail($id);
        return view('1-frontend.conference-details', compact('Conference'));
    }

    public function create($id)
    {
        $Conference = Conference::findOrFail($id);
        return view('1-frontend.apply', compact('Conference'));
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

            DB::beginTransaction();

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

            DB::commit();

            // Fire event to new paper
            event(new NewPaper($paperId));

            // ✅ Get the controller ID of the conference
            $controllerId = Conference::where('id', $paper->conference_id)->value('controller_id');
            $Controller = User::findOrFail($controllerId);

            // ✅ send mail
            mail::to($Controller->email)->send(new PaperNew($Controller,  $paperId));

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
        return redirect()->route('conference.profile_papers');
    }

    public function profile($username)
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Fetch the user using their ID
        $user = User::findOrFail($userId);

        // Extract the first name (before the space) from the user's name
        $firstName = Str::before($user->name, ' ');

        $user = auth()->user(); // Get the authenticated user
        $papers = Paper::where('user_id, $userId'); // Assuming a relation exists: User hasMany Paper

        return view('1-frontend.account', compact('user', 'papers'));
    }

    public function profile_papers()
    {

        // Get the authenticated user's ID
        $userId = Auth::id();

        $papers = Paper::where('user_id', $userId)->latest()->get();

        return view('1-frontend.papers', compact('papers'));
    }

    public function paper_view($encrypted_id)
    {
        // Extract the encoded ID from the slug
        try {
            // Decrypt the ID
            $paper_id = decrypt($encrypted_id);

            // Fetch the paper
            $paper = Paper::findOrFail($paper_id);

            // Fatch the reports
            $report = Paper_controller::where('paper_id', $paper_id)->first();

            return view('1-frontend.view-paper', compact('paper', 'report', 'paper_id'));
        } catch (\Exception $e) {
            abort(404); // Return 404 if decryption fails
        }
    }

    public function updateFile(Request $request, $paper_id)
    {
        try {
            $request->validate([
                'paper_file' => 'required|file|max:2048' // Max file size: 2MB
            ]);

            $paper = Paper::findOrFail($paper_id);

            // $paper->version =  $paper->version + 1;
            if ($request->hasFile('paper_file') && $request->file('paper_file')->isValid()) {
                $file = $request->file('paper_file');

                // ✅ Get the latest paper entry
                $latestPaper = Paper::latest()->first();
                $nextCode = $latestPaper ? intval(ltrim($latestPaper->paper_code, '#')) + 1 : 1;

                // ✅ Format to 5-digit number (e.g., #00001)
                $formattedCode = str_pad($nextCode, 5, '0', STR_PAD_LEFT);

                // ✅ Construct new file name
                $paper->increment('version'); // Increment version before using
                $filename = "paperV{$paper->version}_{$formattedCode}." . $file->getClientOriginalExtension();

                $filePath = 'paperFile/' . $filename;

                // ✅ Move file to public/paperFiles
                $file->move(public_path('paperFile'), $filename);

                // ✅ Delete old file (if exists)
                if ($paper->paper_file && file_exists(public_path($paper->paper_file))) {
                    unlink(public_path($paper->paper_file));
                }

                // ✅ Update paper_file column
                $paper->paper_file = $filePath;
                $paper->save();
            }


            // ✅ Redirect Back with Success Message
            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'bottom-right',
                ])
                ->success('Paper file updated successfully!');
        } catch (\Exception $e) {
            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'bottom-right',
                ])
                ->error('Error updating file:.' . $e->getMessage());
        }
        // ✅Redirect back with an error message
        return redirect()->back();
    }
}
