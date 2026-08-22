<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use App\Models\Report;
use App\Models\UserWarning;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class TutorDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Get active conversations for this tutor's submitted solutions
        $conversations = Conversation::where('student_tutor_id', $user->id)
            ->whereHas('problem.solutions', function ($query) use ($user) {
                $query->where('student_tutor_id', $user->id)
                    ->where('status', 'submitted');
            })
            ->with([
                'problem',
                'student',
                'messages' => function ($query) {
                    $query->latest()->limit(1);
                },
            ])
            ->latest('updated_at')
            ->get();

        // 2. Get this tutor's accepted/rejected solutions
        $notifications = Solution::where('student_tutor_id', $user->id)
            ->whereIn('status', ['accepted', 'rejected'])
            ->with('problem')
            ->latest('updated_at')
            ->take(5)
            ->get();

        // 3. Get reviewed reports submitted by this tutor
        $reportUpdates = Report::where('reporter_id', $user->id)
            ->whereIn('status', ['dismissed', 'action_taken'])
            ->latest('updated_at')
            ->take(5)
            ->get();

        // 4. Get warnings issued to this tutor
        $warnings = UserWarning::where('user_id', $user->id)
            ->latest('created_at')
            ->take(5)
            ->get();

        // 5. Get recent reward payments credited to this tutor's wallet
        $receivedPayments = $user->wallet 
            ? $user->wallet->transactions()->where('type', 'earning')->latest()->take(5)->get()
            : collect();

        return view('tutor.dashboard', compact(
            'notifications',
            'reportUpdates',
            'warnings',
            'conversations',
            'receivedPayments'
        ));
    }
}
