<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\Solution;
use App\Models\Report;
use App\Models\Conversation;

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
        $activeConversations = Conversation::where('student_id', $user->id)
        ->whereHas('problem.solutions', function ($query) {
            $query->where('status', 'submitted')
                ->whereColumn(
                    'solutions.student_tutor_id',
                    'conversations.student_tutor_id'
                );
        })
        ->with([
            'problem',
            'studentTutor',
            'messages' => function ($query) {
                $query->latest()->limit(1);
            },
        ])
        ->latest('updated_at')
        ->get();

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
        'activeConversations',
        'reportUpdates',
        'warnings'
    ));
    }
}
