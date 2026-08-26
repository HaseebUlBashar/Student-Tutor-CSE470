<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Problem;
use Illuminate\Http\Request;
use App\Models\Solution;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{   public function students()
{
    $students = User::where('role', 'student')
        ->withCount([
            'problems',
            'warnings',
            'reportsReceived',
        ])
        ->latest()
        ->paginate(15);

    return view('admin.users.students', compact('students'));
}


public function tutors()
{
    $studentTutors = User::where('role', 'student_tutor')
        ->withCount([
            'warnings',
            'reportsReceived',
            'solutions as solved_problems_count' => function ($query) {
                $query->whereIn('status', ['submitted', 'accepted']);
            },
        ])
        ->latest()
        ->paginate(15);

    return view('admin.users.tutors', compact('studentTutors'));
}
public function show(User $user)
{
    if ($user->role === 'student') {

        $user->load([
            'problems' => function ($query) {
                $query->latest();
            },
            'warnings',
            'reportsReceived' => function ($query) {
                $query->with('reporter')
                    ->latest();
            },
        ]);

        return view('admin.users.student', compact('user'));
    }

    if ($user->role === 'student_tutor') {

        $user->load([
            'solutions' => function ($query) {
                $query->with('problem')
                    ->whereIn('status', ['submitted', 'accepted'])
                    ->latest();
            },
            'warnings',
            'reportsReceived' => function ($query) {
                $query->with('reporter')
                    ->latest();
            },
        ]);

        return view('admin.users.tutor', compact('user'));
    }

    abort(404);
}
    public function editProblem(Problem $problem)
    {
        return view('admin.users.edit-problem', compact('problem'));
    }
    public function editSolution(Solution $solution)
{
    $solution->load('problem');

    return view('admin.users.edit-solution', compact('solution'));
}
public function updateSolution(Request $request, Solution $solution)
{
    $validated = $request->validate([
        'description' => 'required|string',
        'reward' => 'required|numeric|min:0',
        'status' => 'required|in:submitted,accepted,rejected',
    ]);

    $solution->update($validated);

    return redirect()
        ->route('admin.users.show', $solution->student_tutor_id)
        ->with('success', 'Solution updated successfully.');
}
public function deleteSolution(Solution $solution)
{
    $tutorId = $solution->student_tutor_id;

    $solution->delete();

    return redirect()
        ->route('admin.users.show', $tutorId)
        ->with('success', 'Solution deleted successfully.');
}

    public function updateProblem(Request $request, Problem $problem)
    {
        $validated = $request->validate([
            'department' => 'required|string|max:100',
            'course' => 'required|string|max:100',
            'chapter' => 'required|string|max:100',
            'difficulty' => 'required|in:Easy,Medium,Hard',
            'reward' => 'required|numeric|min:0',
            'deadline' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Open,In Progress,Solved',
        ]);

        $problem->update($validated);

        return redirect()
            ->route('admin.users.show', $problem->user_id)
            ->with('success', 'Problem updated successfully.');
    }

    public function deleteProblem(Problem $problem)
    {
        $userId = $problem->user_id;

        $problem->delete();

        return redirect()
            ->route('admin.users.show', $userId)
            ->with('success', 'Problem deleted successfully.');
    }
    public function viewSolutionAttachment(Solution $solution)
{
    if (!$solution->attachment) {
        abort(404);
    }

    $disk = Storage::disk('public');

    if (!$disk->exists($solution->attachment)) {
        abort(404, 'Solution attachment not found.');
    }

    return response()->file(
        $disk->path($solution->attachment)
    );
}
public function viewProblemAttachment(Problem $problem)
{
    if (!$problem->attachment) {
        abort(404);
    }

    $disk = Storage::disk('public');

    if (!$disk->exists($problem->attachment)) {
        abort(404, 'Problem attachment not found.');
    }

    return response()->file(
        $disk->path($problem->attachment)
    );
}
}
