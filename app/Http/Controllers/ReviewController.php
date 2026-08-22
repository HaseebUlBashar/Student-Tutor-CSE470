<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $problemId)
    {
        $request->validate([
            'reviewed_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $problem = Problem::findOrFail($problemId);
        $reviewerId = Auth::id();

        // Prevent self-reviews
        if ($reviewerId == $request->reviewed_id) {
            return back()->with('error', 'You cannot review yourself.');
        }

        // Prevent duplicate review submissions for this transaction
        $alreadyReviewed = Review::where('problem_id', $problem->id)
            ->where('reviewer_id', $reviewerId)
            ->where('reviewed_id', $request->reviewed_id)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'You have already submitted a review for this transaction.');
        }

        Review::create([
            'problem_id' => $problem->id,
            'reviewer_id' => $reviewerId,
            'reviewed_id' => $request->reviewed_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
}