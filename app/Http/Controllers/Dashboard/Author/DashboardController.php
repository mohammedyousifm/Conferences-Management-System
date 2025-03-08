<?php

namespace App\Http\Controllers\Dashboard\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paper;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $Papers = Paper::where('user_id', auth::id())->latest()->get();
        return view('2-dashboard.author.index', compact('Papers'));
    }

    public function track_status()
    {
        $Papers = Paper::where('user_id', auth::id())->latest()->get();
        return view('2-dashboard.author.track-status', compact('Papers'));
    }
}
