<?php

namespace App\Http\Controllers;

use App\Models\Report;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pendingReports = Report::with([
            'reporter',
            'reportedUser',
            'problem',
            'solution'
        ])
        ->where('status', 'pending')
        ->latest()
        ->get();

        $totalReports = Report::count();

        $pendingReportsCount = Report::where('status', 'pending')->count();

        $resolvedReportsCount = Report::whereIn('status', [
            'dismissed',
            'action_taken'
        ])->count();

        return view('admin.dashboard', compact(
            'pendingReports',
            'totalReports',
            'pendingReportsCount',
            'resolvedReportsCount'
        ));
    }
}