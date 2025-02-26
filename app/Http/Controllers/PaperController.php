<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paper;
use Illuminate\Support\Facades\Log;

class PaperController extends Controller
{
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
}
