<?php

namespace App\Http\Controllers\Dashboard\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paper;
use App\Models\User;

class ReportsController extends Controller
{

    public function reports($paperId)
    {
        $paper = Paper::findOrFail($paperId);
        return view('2-dashboard.controller.reports', compact('paper'));
    }
}
