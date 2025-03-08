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
use App\Events\ReviewerComment;
use App\Models\Activity;



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
            $validatedData = $request->validate([
                'comment' => 'nullable|string|max:500',
                'paper_file' => 'file|max:2048',
            ]);

            // ✅ Begin Database Transaction
            DB::transaction(function () use ($validatedData, $request, $paper_id) {
                // ✅ Retrieve Paper Reviewer Record
                $paperReviewer = Reviewer::where('paper_id', $paper_id)->firstOrFail();
                $paperReviewer->comment = $validatedData['comment'] ?? null;
                $paperReviewer->status = 'Done';

                // ✅ Handle File Upload (if provided)
                if ($request->hasFile('paper_file')) {
                    $file = $request->file('paper_file');
                    $paperCode = optional($paperReviewer->paper)->paper_code ? ltrim($paperReviewer->paper->paper_code, '#') : '00001';

                    // Construct file name and path
                    $filename = "reviewer_comment_{$paperCode}." . $file->getClientOriginalExtension();
                    $filePath = public_path('paperFile/' . $filename);

                    // Move file
                    $file->move(public_path('paperFile'), $filename);

                    // Store file path
                    $paperReviewer->comment_file = 'paperFile/' . $filename;
                }

                // ✅ Save Reviewer Comment
                $paperReviewer->save();

                // ✅ Retrieve Paper Record
                $paper = Paper::findOrFail($paper_id);

                // ✅ Insert Recent Activity
                Activity::create([
                    'paper_code' => $paper->paper_code,
                    'user_id' => Auth::id(),
                    'activity_type' => 'Comments',
                    'description' => 'Commented on Paper ' . $paper->paper_code,
                ]);

                // ✅ Fire Event to Notify Reviewer
                event(new ReviewerComment(Auth::user()->name, $paper->paper_code));
            });

            // ✅ Success Notification
            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'top-center',
                ])
                ->success('Paper review submitted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to submit review: ' . $e->getMessage());

            // ✅ Error Notification
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
