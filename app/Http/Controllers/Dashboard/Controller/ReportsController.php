<?php

namespace App\Http\Controllers\Dashboard\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ControllerReport;
use App\Models\Paper;
use App\Models\Conference;
use App\Models\Reviewer;
use App\Models\Paper_controller;
use App\Models\User;

class ReportsController extends Controller
{

    public function create($PaperId)
    {
        $paper = Paper::findOrFail($PaperId);
        $paper_reviewer = Reviewer::where('paper_id', $PaperId)->first();
        return view('2-dashboard.controller.reports.reports', compact('paper', 'paper_reviewer'));
    }

    /**
     * Store report and send it to the Author.
     *
     * @param int $paper_id The paper ID.
     * @param Request $request The incoming HTTP request.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($PaperId, Request $request)
    {
        try {
            // ✅ Validate Input
            $validated = $request->validate([
                'report' => 'required',
                'paper_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
            ]);

            // ✅ Start Transaction
            DB::beginTransaction();

            $store = new Paper_controller();
            $store->paper_id = $PaperId;
            $store->controller_id = auth()->id();
            $store->report_comment = $validated['report'];

            // ✅ Handle File Upload Securely
            if ($request->hasFile('paper_file') && $request->file('paper_file')->isValid()) {
                $file = $request->file('paper_file');

                // Get next paper code
                $latestPaper = Paper::latest()->first();
                $nextPaperCode = $latestPaper ? intval(ltrim($latestPaper->paper_code, '#')) + 1 : 1;
                $formattedCode = str_pad($nextPaperCode, 5, '0', STR_PAD_LEFT);

                // Construct file name
                $filename = "paper_{$formattedCode}." . $file->getClientOriginalExtension();
                $filePath = "reportFile/{$filename}";

                // Store file in Laravel's storage
                $file->storeAs('public/reportFile', $filename);

                // Save file path in the database
                $store->report_file = $filePath;
            }

            $store->save();

            // ✅ Retrieve Author Details Securely
            $Author = User::where('id', Paper::where('id', $PaperId)->value('user_id'))->firstOrFail();

            // ✅ Send Email Notification
            Mail::to($Author->email)->send(new ControllerReport($Author->name, $validated['report'], $PaperId));

            // ✅ Commit Transaction
            DB::commit();

            // ✅ Flash Message
            flash()->options(['timeout' => 5000, 'position' => 'top-center'])->success('Report submitted successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error submitting report: ' . $e->getMessage());
            flash()->options(['timeout' => 5000, 'position' => 'top-center'])->error('Error: Something went wrong.');
        }

        return back();
    }
}
