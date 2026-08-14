<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Report;
use App\Models\Solution;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Show the report form for a problem.
     */
    public function createForProblem(Problem $problem)
    {
        return view('reports.create', [
            'problem' => $problem,
            'solution' => null,
        ]);
    }

    /**
     * Show the report form for a solution.
     */
    public function createForSolution(Solution $solution)
    {
        $solution->load('problem');

        return view('reports.create', [
            'problem' => $solution->problem,
            'solution' => $solution,
        ]);
    }

    /**
     * Store a new report.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'problem_id' => 'nullable|exists:problems,id',
            'solution_id' => 'nullable|exists:solutions,id',
            'reason' => 'required|in:inappropriate,misleading,plagiarized,abusive',
            'description' => 'required|string|min:10|max:2000',
        ]);

        // A report must target either a problem or a solution.
        if (empty($validated['problem_id']) && empty($validated['solution_id'])) {
            return back()
                ->withErrors([
                    'report' => 'Please select something to report.',
                ])
                ->withInput();
        }

        // A report cannot target both.
        if (!empty($validated['problem_id']) && !empty($validated['solution_id'])) {
            return back()
                ->withErrors([
                    'report' => 'A report can only target one item.',
                ])
                ->withInput();
        }

        // Determine the reported user automatically.
        if (!empty($validated['problem_id'])) {

            $problem = Problem::findOrFail($validated['problem_id']);

            $reportedUserId = $problem->user_id;

        } else {

            $solution = Solution::findOrFail($validated['solution_id']);

            $reportedUserId = $solution->student_tutor_id;
        }

        // Prevent users from reporting themselves.
        if ($reportedUserId == auth()->id()) {
            return back()
                ->withErrors([
                    'report' => 'You cannot report yourself.',
                ])
                ->withInput();
        }

        Report::create([
            'reporter_id' => auth()->id(),
            'reported_user_id' => $reportedUserId,
            'problem_id' => $validated['problem_id'] ?? null,
            'solution_id' => $validated['solution_id'] ?? null,
            'reason' => $validated['reason'],
            'description' => $validated['description'],
            'status' => 'pending',
        ]);

        if (auth()->user()->role === 'student') {
            return redirect()
                ->route('student.dashboard')
                ->with('success', 'Your report has been submitted successfully.');
        }

        return redirect()
            ->route('tutor.dashboard')
            ->with('success', 'Your report has been submitted successfully.');
    }
}