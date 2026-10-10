<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the authenticated user's dashboard with their latest projects.
     */
    public function __invoke(Request $request): View
    {
        $projects = $request->user()
            ->projects()
            ->latest()
            ->get();

        return view('dashboard', [
            'projects' => $projects,
        ]);
    }
}