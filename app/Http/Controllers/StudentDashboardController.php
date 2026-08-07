<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problem;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalProblems = Problem::where('user_id', $user->id)->count();

        $openProblems = Problem::where('user_id', $user->id)
            ->where('status', 'Open')
            ->count();

        $inProgressProblems = Problem::where('user_id', $user->id)
            ->where('status', 'In Progress')
            ->count();

        $solvedProblems = Problem::where('user_id', $user->id)
            ->where('status', 'Solved')
            ->count();
        $recentProblems = Problem::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();


        return view('student.dashboard', compact(
            'totalProblems',
            'openProblems',
            'inProgressProblems',
            'solvedProblems',
            'recentProblems'
        ));
    }
}
