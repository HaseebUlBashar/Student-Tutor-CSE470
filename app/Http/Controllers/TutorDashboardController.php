<?php

namespace App\Http\Controllers;

use App\Models\Solution;
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

        return view('tutor.dashboard', compact('notifications'));
    }
}
