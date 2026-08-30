<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use App\Models\Report;
use App\Models\UserWarning;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TutorDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Get unread deadline notifications for bookmarked problems
        $deadlineNotifications = $user->bookmarkedProblems()
        ->whereNull('bookmarks.read_at')
        ->whereDate('deadline', '>=', Carbon::today())
        ->whereDate('deadline', '<=', Carbon::today()->addDays(3))
        ->orderBy('deadline', 'asc')
        ->get();
        // Get active conversations for this tutor's submitted solutions
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

        // Get this tutor's accepted/rejected solutions
        $notifications = Solution::where('student_tutor_id', $user->id)
            ->whereIn('status', ['accepted', 'rejected'])
            ->with('problem')
            ->latest('updated_at')
            ->take(5)
            ->get();

        // Get reviewed reports submitted by this tutor
        $reportUpdates = Report::where('reporter_id', $user->id)
            ->whereIn('status', ['dismissed', 'action_taken'])
            ->latest('updated_at')
            ->take(5)
            ->get();

        // Get warnings issued to this tutor
        $warnings = UserWarning::where('user_id', $user->id)
            ->latest('created_at')
            ->take(5)
            ->get();

return view('tutor.dashboard', compact(
    'notifications',
    'reportUpdates',
    'warnings',
    'conversations',
    'deadlineNotifications'
));
}
}
