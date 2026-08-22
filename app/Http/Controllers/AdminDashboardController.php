<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {   $students = User::where('role', 'student')
    ->withCount([
        'problems',
        'warnings',
    ])
    ->withCount([
        'reportsReceived',
    ])
    ->latest()
    ->take(5)
    ->get();

$studentTutors = User::where('role', 'student_tutor')
    ->withCount([
        'warnings',
        'reportsReceived',
        'solutions as solved_problems_count' => function ($query) {
            $query->whereIn('status', ['submitted', 'accepted']);
        },
    ])
    ->latest()
    ->take(5)
    ->get();
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
        'students',
        'studentTutors',
        'pendingReports',
        'totalReports',
        'pendingReportsCount',
        'resolvedReportsCount'
    ));
    }
}
