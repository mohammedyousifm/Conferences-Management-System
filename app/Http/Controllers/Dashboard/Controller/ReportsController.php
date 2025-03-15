<?php

namespace App\Http\Controllers\Dashboard\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Paper;
use App\Models\Reviewer;
use App\Models\Paper_controller;
use App\Models\User;

class ReportsController extends Controller
{

    public function reports($paperId)
    {
        $paper = Paper::findOrFail($paperId);
        $paper_reviewer = Reviewer::where('paper_id', $paperId)->first();
        return view('2-dashboard.controller.reports', compact('paper', 'paper_reviewer'));
    }

    /**
     * Store report and sent it to the Authar.
     *
     * @param Request $request The incoming HTTP request.
     * @param  $paper_id The paper Id.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($paper_id, Request $request)
    {
        DB::table('paper_controller')->delete(); // Delete all rows
        DB::statement("ALTER TABLE paper_controller AUTO_INCREMENT = 1"); // Reset auto-increment
        try {
            $validated = $request->validate([
                'report' => 'required',
                'paper_file' => 'nullable|file|max:2048'
            ]);

            $store = new Paper_controller();
            $store->paper_id = $paper_id;
            $store->controller_id = auth()->id();
            $store->report_comment = $request->input('report');

            // ✅ Handle File Upload
            if ($request->hasFile('paper_file') && $request->file('paper_file')->isValid()) {
                $file = $request->file('paper_file');

                // Get the next paper code (assuming it's stored as #00001 format)
                $latestPaper = Paper::latest()->first();
                $nextPaperCode = $latestPaper ? intval(ltrim($latestPaper->paper_code, '#')) + 1 : 1;
                $formattedCode = str_pad($nextPaperCode, 5, '0', STR_PAD_LEFT); // Ensures 5-digit format

                // Construct file name
                $filename = "paper_{$formattedCode}." . $file->getClientOriginalExtension();
                $filePath = 'reportFile/' . $filename;

                // Move file
                $file->move(public_path('reportFile'), $filename);

                // Store file path
                $store->report_file = $filePath;
            }

            $store->save();

            // ✅ Flash Message
            flash()->options(['timeout' => 5000, 'position' => 'top-center'])->success('Report submitted successfully!');
        } catch (\Exception $e) {
            Log::error('Error submitting report: ' . $e->getMessage());
            flash()->options(['timeout' => 5000, 'position' => 'top-center'])->error('Error: ' . $e->getMessage());
        }

        return back();
    }
}
