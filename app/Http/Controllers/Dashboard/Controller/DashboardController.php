<?php

namespace App\Http\Controllers\Dashboard\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Paper;
use App\Models\User;
use App\Models\Paper_controller;

class DashboardController extends Controller
{
    public function index()
    {

        $papers = Paper::all();
        $Rejected_papers = Paper::where('status',  'Rejected')->count();
        $Accepted_papers = Paper::where('status',  'Accepted')->count();
        $Submitted_papers = Paper::where('status',  'Submitted')->count();
        $Under_reviwe = Paper::where('status',  'Under_reviwe')->count();

        $New_Paper = Paper::latest()->first();


        return view('2-dashboard.controller.index', compact('papers', 'Rejected_papers', 'Accepted_papers', 'Under_reviwe', 'Submitted_papers', 'New_Paper'));
    }

    public function papers_index()
    {

        $papers = Paper::all();
        $users = User::where('user_role', 'reviewer')->get();

        return view('2-dashboard.controller.papers', compact('papers', 'users'));
    }

    // Assign Users to a Paper
    public function assignReviewers(Request $request, Paper $paper)
    {

        try {
            $request->validate([
                'reviewers_id' => 'required|array',
                'reviewers_id.*' => 'exists:users,id',
            ]);

            // Attach multiple reviewers
            $paper->reviewers()->attach($request->reviewers_id, ['created_at' => now(), 'updated_at' => now()]);

            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'top-center',
                ])
                ->success('Users assigned successfully!');
        } catch (\Exception $e) {

            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'top-center',
                ])
                ->error('Failed to assign users');
        }

        return back();
    }

    public function review_paper($id)
    {

        $paper = Paper::findOrFail($id);
        $users = User::where('user_role', 'reviewer')->get();

        return view('2-dashboard.controller.review-status', compact('paper', 'users'));
    }

    public function report_commint(Request $request, $paper_id)
    {
        try {
            // ✅ Validate Input
            $request->validate([
                'report_comment' => 'nullable|string|max:500',
                'report_file' => 'nullable|file|max:2048',
            ]);

            // ✅ Handle File Upload
            $filePath = null;
            if ($request->hasFile('report_file')) {

                $latestReport = Paper_controller::where('paper_id', $paper_id)->latest()->first();
                $nextNumber = $latestReport ? intval(preg_replace('/[^0-9]/', '', $latestReport->report_file)) + 1 : 1;


                $fileName = "report_{$nextNumber}." . $request->file('report_file')->getClientOriginalExtension();


                $filePath = $request->file('report_file')->storeAs('controller_reports', $fileName, 'public');
            }

            // ✅ Create Report Record
            Paper_controller::create([
                'controller_id' => auth()->id(),
                'paper_id' => $paper_id,
                'report_comment' => $request->report_comment,
                'report_file' => $filePath,
            ]);

            // ✅ Flash Message
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
                ->error('Failed to submit review: ' . $e->getMessage());
        }

        return back();
    }
}
