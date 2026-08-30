<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Report;
use App\Models\Solution;
use App\Models\Message;
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
            'message' => null,
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
            'message' => null,
        ]);
    }

    /**
     * Show the report form for a message.
     */
    public function createForMessage(Message $message)
    {
        $message->load([
            'sender',
            'conversation',
        ]);

        return view('reports.create', [
            'problem' => null,
            'solution' => null,
            'message' => $message,
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
            'conversation_id' => 'nullable|exists:conversations,id',
            'message_id' => 'nullable|exists:messages,id',
            'reason' => 'required|in:inappropriate,misleading,plagiarized,abusive',
            'description' => 'required|string|min:10|max:2000',
        ]);

        /*
         * Message report
         */
        if (!empty($validated['message_id'])) {

            $message = Message::with('conversation')
                ->findOrFail($validated['message_id']);

            // Make sure the conversation ID matches the message
            if (
                empty($validated['conversation_id']) ||
                $message->conversation_id != $validated['conversation_id']
            ) {
                return back()
                    ->withErrors([
                        'report' => 'Invalid message report.',
                    ])
                    ->withInput();
            }

            $reportedUserId = $message->sender_id;

            // Prevent users from reporting their own messages
            if ($reportedUserId == auth()->id()) {
                return back()
                    ->withErrors([
                        'report' => 'You cannot report your own messages.',
                    ])
                    ->withInput();
            }

            Report::create([
                'reporter_id' => auth()->id(),
                'reported_user_id' => $reportedUserId,
                'conversation_id' => $message->conversation_id,
                'message_id' => $message->id,
                'reason' => $validated['reason'],
                'description' => $validated['description'],
                'status' => 'pending',
            ]);

            return redirect()
                ->route('chat.show', $message->conversation_id)
                ->with('success', 'Your report has been submitted successfully.');
        }

        /*
         * Problem / Solution report
         */

        // Report must target either a problem or a solution
        if (empty($validated['problem_id']) && empty($validated['solution_id'])) {
            return back()
                ->withErrors([
                    'report' => 'Please select something to report.',
                ])
                ->withInput();
        }

        // Report cannot target both
        if (!empty($validated['problem_id']) && !empty($validated['solution_id'])) {
            return back()
                ->withErrors([
                    'report' => 'A report can only target one item.',
                ])
                ->withInput();
        }

        // Determining reported user automatically
        if (!empty($validated['problem_id'])) {

            $problem = Problem::findOrFail($validated['problem_id']);

            $reportedUserId = $problem->user_id;

        } else {

            $solution = Solution::findOrFail($validated['solution_id']);

            $reportedUserId = $solution->student_tutor_id;
        }

        // Prevent users from reporting their own problems or solutions
        if ($reportedUserId == auth()->id()) {
            return back()
                ->withErrors([
                    'report' => 'You cannot report your own problems or solutions.',
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