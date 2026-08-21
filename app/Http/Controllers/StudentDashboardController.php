<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\Solution;
use App\Models\Report;

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

        $newSolutions = Solution::with(['problem', 'studentTutor'])
                ->whereHas('problem', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->where('status', 'submitted')
                ->latest('submitted_at')
                ->take(5)
                ->get();

        $newSolutionsCount = Solution::whereHas('problem', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->where('status', 'submitted')
                ->count();
        
        $reportUpdates = Report::where('reporter_id', $user->id)
            ->whereIn('status', ['dismissed', 'action_taken'])
            ->latest('updated_at')
            ->take(5)
            ->get();

        $warnings = $user->warnings()
            ->with('report')
            ->latest()
            ->take(5)
            ->get();

        return view('student.dashboard', compact(
            'totalProblems',
            'openProblems',
            'inProgressProblems',
            'solvedProblems',
            'recentProblems',
            'newSolutions',
            'newSolutionsCount',
            'reportUpdates',
            'warnings'
        ));
    }
}
