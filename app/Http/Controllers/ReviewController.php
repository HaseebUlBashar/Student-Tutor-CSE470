<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Solution $solution)
    {
        // Reviews are only allowed after the transaction is completed.
        // In this project, that means the solution must be accepted.
        if ($solution->status !== 'accepted') {
            return back()->with(
                'error',
                'You can only review after the solution has been accepted.'
            );
        }

        $problem = $solution->problem;
        $currentUserId = Auth::id();

        // Figure out who the other person in the transaction is.
        if ($currentUserId === $problem->user_id) {

            // Student is reviewing the Student Tutor.
            $reviewedUserId = $solution->student_tutor_id;

        } elseif ($currentUserId === $solution->student_tutor_id) {

            // Student Tutor is reviewing the Student.
            $reviewedUserId = $problem->user_id;

        } else {

            // Someone who was not involved in this transaction
            // is not allowed to review.
            abort(403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Prevent the same person from reviewing the same user
        // twice for the same completed solution.
        $alreadyReviewed = Review::where('solution_id', $solution->id)
            ->where('reviewer_id', $currentUserId)
            ->where('reviewed_user_id', $reviewedUserId)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with(
                'error',
                'You have already submitted a review for this transaction.'
            );
        }

        Review::create([
            'solution_id' => $solution->id,
            'reviewer_id' => $currentUserId,
            'reviewed_user_id' => $reviewedUserId,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return back()->with(
            'success',
            'Your rating and review have been submitted successfully.'
        );
    }
}
