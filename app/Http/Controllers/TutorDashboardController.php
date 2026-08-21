<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use App\Models\Report;
use App\Models\UserWarning;
use Illuminate\Support\Facades\Auth;

class TutorDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

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

        return view('tutor.dashboard', compact('notifications', 'reportUpdates', 'warnings'));
    }
}
