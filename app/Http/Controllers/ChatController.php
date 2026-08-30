<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Problem;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function open(Solution $solution)
    {
        $problem = $solution->problem;

        $user = Auth::user();

        // Only the student who posted the problem
        // or the tutor who submitted this solution
        // can access the conversation.

        if ($user->id === $problem->user_id) {

            // Student can access the conversation.

        } elseif ($user->id === $solution->student_tutor_id) {

            // Tutor can access only while the solution is awaiting acceptance.
            if ($solution->status !== 'submitted') {
                abort(403);
            }

        } else {

            abort(403);

        }

        $conversation = Conversation::firstOrCreate(
            [
                'problem_id' => $problem->id,
                'student_id' => $problem->user_id,
                'student_tutor_id' => $solution->student_tutor_id,
            ]
        );

        $messages = $conversation->messages()
            ->with('sender')
            ->oldest()
            ->get();

        return view('chat.show', compact(
            'conversation',
            'problem',
            'solution',
            'messages'
        ));
    }

    public function send(Request $request, Conversation $conversation)
    {
        $user = Auth::user();

        if (
            $user->id !== $conversation->student_id &&
            $user->id !== $conversation->student_tutor_id
        ) {
            abort(403);
        }
        $activeSolution = Solution::where('problem_id', $conversation->problem_id)
            ->where('student_tutor_id', $conversation->student_tutor_id)
            ->where('status', 'submitted')
            ->exists();

        if (!$activeSolution) {
            return redirect()
                ->route('chat.show', $conversation->id)
                ->with('error', 'This conversation is no longer active.');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        $conversation->messages()->create([
            'sender_id' => $user->id,
            'message' => $validated['message'],
        ]);

        return redirect()
            ->route('chat.show', $conversation->id);
    }
    public function show($conversation)
{
    $conversation = Conversation::with([
        'messages.sender',
        'student',
        'studentTutor'
    ])->findOrFail($conversation);

    // Only participants can access the conversation
    if (
        auth()->id() !== $conversation->student_id &&
        auth()->id() !== $conversation->student_tutor_id
    ) {
        abort(403);
    }
    if (auth()->id() === $conversation->student_tutor_id) {

    $activeSolution = Solution::where('problem_id', $conversation->problem_id)
        ->where('student_tutor_id', $conversation->student_tutor_id)
        ->where('status', 'submitted')
        ->exists();

    if (!$activeSolution) {
        abort(403);
    }
}

    $problem = Problem::findOrFail($conversation->problem_id);

    $messages = $conversation->messages()
        ->with('sender')
        ->orderBy('created_at')
        ->get();

    return view('chat.show', compact(
        'conversation',
        'messages',
        'problem'
    ));
}
public function destroy(Conversation $conversation)
{
    // Only participants can delete the conversation
    if (
        auth()->id() !== $conversation->student_id &&
        auth()->id() !== $conversation->student_tutor_id
    ) {
        abort(403);
    }

    // Delete conversation.
    // Its messages will also be deleted automatically
    // because of cascadeOnDelete() on conversation_id.
    $conversation->delete();

    return redirect()
        ->route(
            auth()->user()->role === 'student'
                ? 'student.dashboard'
                : 'tutor.dashboard'
        )
        ->with('success', 'Conversation deleted successfully.');
}
}
