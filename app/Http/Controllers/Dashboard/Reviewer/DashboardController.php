<?php

namespace App\Http\Controllers\Dashboard\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Paper;
use App\Models\User;
use App\Models\Reviewer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $Rejected_papers = Paper::where('status',  'Rejected')->count();
        $Accepted_papers = Paper::where('status',  'Accepted')->count();
        $Allocated_papers = Reviewer::where('reviewer_id',  auth::id())->count();
        $Under_reviwe = Paper::where('status',  'Under_reviwe')->count();
        return view('2-dashboard.reviewer.index', compact('Rejected_papers', 'Allocated_papers', 'Under_reviwe'));
    }

    public function papers_index()
    {

        $papers = Reviewer::where('reviewer_id', auth::id())->get();
        $users = User::where('user_role', 'reviewer')->get();

        return view('2-dashboard.reviewer.papers', compact('papers', 'users'));
    }

    public function review_paper($id)
    {

        $paper = Paper::findOrFail($id);
        $users = User::where('user_role', 'reviewer')->get();

        return view('2-dashboard.reviewer.review-paper', compact('paper', 'users'));
    }

    public function papers_commint(Request $request, $paper_id)
    {

        try {
            // ✅ Validate Input
            $request->validate([
                'comment' => 'nullable|string|max:500',
                'paper_file' => 'file|max:2048',
            ]);

            // ✅ Retrieve Paper Record
            $paperReviewer = Reviewer::where('paper_id', $paper_id)->firstOrFail();
            $paperReviewer->comment = $request->comment;
            $paperReviewer->status = 'Completed';

            // ✅ Handle File Upload
            if ($request->hasFile('paper_file')) {
                $file = $request->file('paper_file');

                // Retrieve the paper code from the database
                if ($paperReviewer->paper->paper_code) {
                    $paperCode = ltrim($paperReviewer->paper->paper_code, '#'); // Remove '#' from paper_code
                } else {
                    // Fallback: Generate a new paper code
                    $latestPaper = Paper::latest()->first();
                    $nextPaperCode = $latestPaper ? intval(ltrim($latestPaper->paper_code, '#')) + 1 : 1;
                    $paperCode = str_pad($nextPaperCode, 5, '0', STR_PAD_LEFT);
                }

                // Construct file name as "reviewer_comment_00001.pdf"
                $filename = "reviewer_comment_{$paperCode}." . $file->getClientOriginalExtension();
                $filePath = 'paperFile/' . $filename;

                // Move file to public/paperFile
                $file->move(public_path('paperFile'), $filename);

                // Store in database
                $paperReviewer->comment_file = $filePath;
            }

            $paperReviewer->save();

            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'top-center',
                ])
                ->success('Paper review submitted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to submit review: ' . $e->getMessage());
            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'top-center',
                ])
                ->error('Failed to submit review' . $e->getMessage());
        }


        return back();
    }
}
