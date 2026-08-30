<?php

namespace App\Http\Controllers;

use App\Models\User;

class StudentTutorController extends Controller
{
    public function index()
    {
    $studentTutors = User::where('role', 'student_tutor')
        ->with(['reviewsReceived.reviewer'])
        ->withCount('reviewsReceived')
        ->withCount([
            'solutions as accepted_solutions_count' => function ($query) {
                $query->where('status', 'accepted');
            }
        ])
        ->orderByDesc('accepted_solutions_count')
        ->get();

    return view('student-tutors.index', compact('studentTutors'));
    }

    public function show(User $studentTutor)
    {
        abort_unless($studentTutor->role === 'student_tutor', 404);

        $studentTutor->load([
            'reviewsReceived.reviewer',
        ]);

        $averageRating = $studentTutor->reviewsReceived->avg('rating') ?? 0;

        return view('student-tutors.show', compact(
            'studentTutor',
            'averageRating'
        ));
    }
}
