<?php

namespace App\Http\Controllers\Dashboard\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('2-dashboard.author.index');
    }

    public function track_status()
    {
        return view('2-dashboard.author.track-status');
    }
}
