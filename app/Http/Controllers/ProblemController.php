<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problem;
use Illuminate\Support\Facades\Auth;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $problems = Problem::where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('problems.index', compact('problems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('problems.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'department' => 'required|in:CSE,BBA,EEE',

        'course' => [
            'required',
            function ($attribute, $value, $fail) use ($request) {

                $courses = [
                    'CSE' => ['CSE220', 'CSE321', 'CSE420'],
                    'BBA' => ['BUS101', 'BUS201', 'MKT102'],
                    'EEE' => ['EEE201', 'EEE310', 'EEE420'],
                ];

                $department = $request->department;

                if (
                    !isset($courses[$department]) ||
                    !in_array($value, $courses[$department])
                ) {
                    $fail('The selected course does not belong to the selected department.');
                }
            },
        ],

        'chapter' => 'required|string|max:100',

        'difficulty' => 'required|in:Easy,Medium,Hard',

        'reward' => 'required|numeric|min:0',

        'deadline' => 'required|date',

        'title' => 'required|string|max:255',

        'description' => 'required|string',

        'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
    ]);

    $path = null;

    if ($request->hasFile('attachment')) {
        $path = $request->file('attachment')
            ->store('problems', 'public');
    }

    Problem::create([
        'user_id' => Auth::id(),
        'department' => $validated['department'],
        'course' => $validated['course'],
        'chapter' => $validated['chapter'],
        'difficulty' => $validated['difficulty'],
        'reward' => $validated['reward'],
        'deadline' => $validated['deadline'],
        'title' => $validated['title'],
        'description' => $validated['description'],
        'attachment' => $path,
        'status' => 'Open',
    ]);

    return redirect()
        ->route('problems.index')
        ->with('success', 'Problem posted successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
   {
    $problem = Problem::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    if ($problem->status !== 'Open') {
        return redirect()
            ->route('problems.index')
            ->with('error', 'This problem can no longer be edited.');
    }

    return view('problems.edit', compact('problem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $problem = Problem::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    if ($problem->status !== 'Open') {
        return redirect()
            ->route('problems.index')
            ->with('error', 'This problem can no longer be edited.');
    }

    $validated = $request->validate([
        'department' => 'required|string|max:100',
        'course' => 'required|string|max:100',
        'chapter' => 'required|string|max:100',
        'difficulty' => 'required|in:Easy,Medium,Hard',
        'reward' => 'required|numeric|min:0',
        'deadline' => 'required|date',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
    ]);

    if ($request->hasFile('attachment')) {
        $path = $request->file('attachment')->store('problems', 'public');

        $validated['attachment'] = $path;
    }

    $problem->update($validated);

    return redirect()
        ->route('problems.index')
        ->with('success', 'Problem updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $problem = Problem::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    if ($problem->status !== 'Open') {
        return redirect()
            ->route('problems.index')
            ->with('error', 'This problem can no longer be deleted.');
    }

    $problem->delete();

    return redirect()
        ->route('problems.index')
        ->with('success', 'Problem deleted successfully!');
}
}
