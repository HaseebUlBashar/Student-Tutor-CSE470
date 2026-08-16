<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function store(Problem $problem): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->bookmarkedProblems()
            ->syncWithoutDetaching([$problem->id]);

        return back()->with('success', 'Problem bookmarked successfully!');
    }

    public function destroy(Problem $problem): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->bookmarkedProblems()
            ->detach($problem->id);

        return back()->with('success', 'Bookmark removed.');
    }

    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $problems = $user->bookmarkedProblems()
            ->latest('bookmarks.created_at')
            ->get();

        return view('tutor.bookmarks', compact('problems'));
    }
}
