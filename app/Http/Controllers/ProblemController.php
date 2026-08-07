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
        'department' => 'required|string|max:100',
        'course' => 'required|string|max:100',
        'chapter' => 'required|string|max:100',
        'difficulty' => 'required',
        'reward' => 'required|numeric|min:0',
        'deadline' => 'required|date',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
    ]);
    $path = null;
    if ($request->hasFile('attachment')) {
        $path = $request->file('attachment')->store('problems', 'public');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
