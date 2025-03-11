<?php

namespace App\Http\Controllers\Dashboard\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Paper;
use App\Models\Reviewer;
use App\Models\Conference;
use App\Models\User;
use App\Models\Paper_controller;
use App\Models\Activity;
use App\Events\ReviewerAlocet;
use App\Events\StatusUpdated;

class DashboardController extends Controller
{
    public function index()
    {


        $papers = Paper::all();
        $all_papers_count = Paper::count();
        $Rejected_papers_count = Paper::where('status',  'Rejected')->count();
        $Approved_papers_count = Paper::where('status',  'Approved')->count();
        $In_Process_papers_count = Paper::where('status',  'In Process')->count();

        $New_Paper = Paper::latest()->first();

        $Recent_Activity = Activity::latest()->take(3)->get();

        $Paper_Comment_Done = Reviewer::orderBy('updated_at', 'desc')->first();



        return view('2-dashboard.controller.index', compact('all_papers_count', 'papers', 'Rejected_papers_count', 'Approved_papers_count', 'New_Paper', 'Recent_Activity', 'In_Process_papers_count', 'Paper_Comment_Done'));
    }

    /**
     * Controller the papers.
     *
     * @param $users Retrieve the users where the user_roles is reviewer
     * @param  $paper used to Retrieve the conference is managed by the logged-in controller
     * @return // to 2-dashboard.controller.papers
     */
    public function papers_index()
    {
        // ✅ Get the logged-in controller ID
        $controllerId = Auth::id();

        // ✅ Retrieve papers where the conference is managed by the logged-in controller
        $papers = Paper::whereHas('conference', function ($query) use ($controllerId) {
            $query->where('controller_id', $controllerId);
        })->latest()->paginate(10);

        $all_papers_count = Paper::count();
        $Approved_papers_count = Paper::where('status',  'Approved')->count();
        $Rejected_papers_count = Paper::where('status',  'Rejected')->count();
        $In_Process_papers_count = Paper::where('status',  'In Process')->count();

        // ✅ Retrieve the users where the user_roles is reviewer
        $users = User::where('user_role', 'reviewer')->get();

        return view('2-dashboard.controller.papers', compact('papers', 'users', 'Approved_papers_count', 'Rejected_papers_count', 'In_Process_papers_count', 'all_papers_count'));
    }

    /**
     * Assign multiple reviewers to a paper.
     *
     * @param Request $request The incoming HTTP request.
     * @param Paper $paper The paper to which reviewers are being assigned.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignReviewers(Request $request, Paper $paper)
    {
        try {
            // Validate input data
            $validated = $request->validate([
                'reviewers_id'   => 'required|array',
                'reviewers_id.*' => 'exists:users,id',
            ]);

            // Start a transaction to ensure database consistency
            DB::beginTransaction();

            // Attach multiple reviewers to the paper
            $paper->reviewers()->syncWithoutDetaching($validated['reviewers_id']);

            // Update timestamps manually
            foreach ($validated['reviewers_id'] as $reviewerId) {
                $paper->reviewers()->updateExistingPivot($reviewerId, ['updated_at' => now()]);
            }

            // Retrieve the logged-in user (controller assigning reviewers)
            $controllerName = Auth::user()->name;

            // Fetch assigned reviewer names
            $reviewerNames = User::whereIn('id', $validated['reviewers_id'])->pluck('name')->toArray();
            $reviewerNamesStr = implode(', ', $reviewerNames);

            // Retrieve the paper code
            $paperCode = $paper->paper_code;

            // Commit transaction after successful database update
            DB::commit();

            // Fire event to notify about reviewer assignment
            event(new ReviewerAlocet($controllerName, $reviewerNamesStr, $paperCode));

            // Flash success message
            flash()
                ->options([
                    'timeout'  => 5000,
                    'position' => 'top-center',
                ])
                ->success('Users assigned successfully!');
        } catch (ValidationException $e) {
            // Rollback transaction in case of validation failure
            DB::rollBack();

            // Log validation errors
            Log::error('Validation failed while assigning reviewers', [
                'errors' => $e->errors(),
            ]);

            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            // Rollback transaction in case of other failures
            DB::rollBack();

            // Log the exception for debugging
            Log::error('Failed to assign reviewers', [
                'error' => $e->getMessage(),
            ]);

            // Flash error message
            flash()
                ->options([
                    'timeout'  => 5000,
                    'position' => 'top-center',
                ])
                ->error('Failed to assign users');
        }

        return back();
    }

    /**
     * Review The status of a paper.
     *
     * @param $users Retrieve the users where the user_roles is reviewe
     * @param  $id The ID of the Paper.
     * @param  $paper Find The paper By the id
     * @return // to 2-dashboard.controller.review-status
     */
    public function review_paper($id)
    {

        $paper = Paper::findOrFail($id);
        $users = User::where('user_role', 'reviewer')->get();

        return view('2-dashboard.controller.review-status', compact('paper', 'users'));
    }


    /**
     * Update Status O a paper.
     *
     * @param Request $request The incoming HTTP request.
     * @param Paper $id The paper to Id  are being assigned.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        try {

            // ✅ Validate Input
            $request->validate([
                'status' => 'required|in:Submitted,Accepted,Under_review,Rejected',
            ]);

            // ✅ Store Data in Database
            $StatusUpdate = Paper::findOrFail($id);
            $StatusUpdate->status = $request->status;
            $StatusUpdate->save();


            // ✅ Redirect Back with Success Message
            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'top-center',
                ])
                ->success('Status updated successfully!');
        } catch (\Exception $e) {

            // ✅ Log the Error Correctly
            Log::error('Status updater: ' . $e->getMessage());

            flash()
                ->options([
                    'timeout' => 5000,
                    'position' => 'top-center',
                ])
                ->error('Failed to updated Status' . $e->getMessage());
        }
        return back();
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
