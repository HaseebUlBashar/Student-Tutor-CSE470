<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Solution;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = Problem::where('user_id', auth()->id());

    if ($request->filled('status')) {
        $request->validate([
            'status' => 'in:Open,In Progress,Solved',
        ]);

        $query->where('status', $request->status);
    }

    $problems = $query
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

    public function tutorShow(Problem $problem)
{
    return view('tutor.problems.show', compact('problem'));
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
public function startWorking(Problem $problem)
{
    $studentTutorId = Auth::id();

    return DB::transaction(function () use ($problem, $studentTutorId) {

        $problem = Problem::where('id', $problem->id)
            ->lockForUpdate()
            ->firstOrFail();

        // A solved problem cannot receive new solutions
        if ($problem->status === 'Solved') {
            return redirect()
                ->route('tutor.problems.show', $problem->id)
                ->with('error', 'This problem has already been solved.');
        }

        // Check whether THIS tutor already has a solution
        $existingSolution = Solution::where('problem_id', $problem->id)
            ->where('student_tutor_id', $studentTutorId)
            ->first();

        if ($existingSolution) {

            // If they started but have not submitted yet,
            // take them back to their solution form
            if ($existingSolution->status === 'draft') {
                return redirect()
                    ->route('tutor.solutions.create', $existingSolution->id);
            }

            // They already submitted a solution
            return redirect()
                ->route('tutor.problems.show', $problem->id)
                ->with(
                    'error',
                    'You have already submitted a solution for this problem.'
                );
        }

        // Create a NEW solution for THIS tutor
        $solution = Solution::create([
            'problem_id' => $problem->id,
            'student_tutor_id' => $studentTutorId,
            'reward' => $problem->reward,
            'status' => 'draft',
        ]);

        // The first tutor changes Open → In Progress.
        // Other tutors leave it In Progress.
        if ($problem->status === 'Open') {
            $problem->status = 'In Progress';
            $problem->save();
        }

        return redirect()
            ->route('tutor.solutions.create', $solution->id)
            ->with(
                'success',
                'You have started working on this problem.'
            );
    });
}
public function createSolution(Solution $solution)
{
    if ($solution->student_tutor_id !== Auth::id()) {
        abort(403);
    }

    if ($solution->status !== 'draft') {
        return redirect()
            ->route('tutor.problems.show', $solution->problem_id)
            ->with('error', 'This solution has already been submitted.');
    }

    $problem = $solution->problem;

    return view('tutor.solutions.create', compact('solution', 'problem'));
}
public function submitSolution(Request $request, Solution $solution)
{
    if ($solution->student_tutor_id !== Auth::id()) {
        abort(403);
    }

    if ($solution->status !== 'draft') {
        return redirect()
            ->route('tutor.problems.show', $solution->problem_id)
            ->with('error', 'This solution has already been submitted.');
    }

    $validated = $request->validate([
        'description' => 'required|string',
        'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240',
    ]);

    return DB::transaction(function () use ($request, $solution, $validated) {

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request
                ->file('attachment')
                ->store('solutions', 'public');
        }

        $solution->update([
            'description' => $validated['description'],
            'attachment' => $validated['attachment'] ?? $solution->attachment,
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        // IMPORTANT:
        // Do NOT change the problem to Solved here.
        // The student must accept a solution first.

        $problem = $solution->problem;

        if ($problem->status !== 'Solved') {
            $problem->status = 'In Progress';
            $problem->save();
        }

        return redirect()
            ->route('tutor.problems.show', $problem->id)
            ->with('success', 'Your solution has been submitted successfully! The student will review it.');
    });
}
public function acceptSolution(Solution $solution)
{
    $problem = $solution->problem;

    // Only the student who posted the problem can accept a solution
    if ($problem->user_id !== Auth::id()) {
        abort(403);
    }

    // Only submitted solutions can be accepted
    if ($solution->status !== 'submitted') {
        return redirect()
            ->route('problems.solutions', $problem->id)
            ->with('error', 'This solution cannot be accepted.');
    }

    try {

        DB::transaction(function () use ($problem, $solution) {

            /*
             * Lock the student's wallet.
             *
             * This prevents two requests from spending
             * the same wallet balance at the same time.
             */
            $studentWallet = Wallet::where('user_id', $problem->user_id)
                ->lockForUpdate()
                ->first();

            /*
             * If the student does not have a wallet yet,
             * create one with a zero balance.
             */
            if (!$studentWallet) {
                $studentWallet = Wallet::create([
                    'user_id' => $problem->user_id,
                    'balance' => 0,
                ]);
            }

            /*
             * Check whether the student has enough money
             * to pay the tutor.
             */
            if ($studentWallet->balance < $solution->reward) {

                throw new \Exception(
                    'Insufficient wallet balance. Please deposit enough money before accepting this solution.'
                );
            }

            /*
             * Get the tutor's wallet.
             *
             * If the tutor does not have a wallet yet,
             * create one with zero balance.
             */
            $tutor = User::findOrFail($solution->student_tutor_id);

            $tutorWallet = Wallet::firstOrCreate(
                ['user_id' => $tutor->id],
                ['balance' => 0]
            );

            /*
             * Lock the tutor wallet too.
             *
             * This makes the transfer safer when multiple
             * wallet operations happen at the same time.
             */
            $tutorWallet = Wallet::where('id', $tutorWallet->id)
                ->lockForUpdate()
                ->first();

            /*
             * Calculate the reward that will be transferred.
             */
            $reward = $solution->reward;

            /*
             * ---------------------------------------------
             * 1. DEDUCT MONEY FROM STUDENT
             * ---------------------------------------------
             */
            $studentWallet->balance -= $reward;
            $studentWallet->save();

            /*
             * Create the student's payment transaction.
             *
             * We store the amount as positive here, while
             * the transaction type tells us that this is money
             * leaving the wallet.
             */
            WalletTransaction::create([
                'wallet_id' => $studentWallet->id,
                'type' => 'payment',
                'amount' => $reward,
                'description' => 'Payment for accepted solution: ' . $problem->title,
                'solution_id' => $solution->id,
                'balance_after' => $studentWallet->balance,
            ]);

            /*
             * ---------------------------------------------
             * 2. ADD MONEY TO TUTOR
             * ---------------------------------------------
             */
            $tutorWallet->balance += $reward;
            $tutorWallet->save();

            /*
             * Create the tutor's earning transaction.
             */
            WalletTransaction::create([
                'wallet_id' => $tutorWallet->id,
                'type' => 'earning',
                'amount' => $reward,
                'description' => 'Earning from accepted solution for: ' . $problem->title,
                'solution_id' => $solution->id,
                'balance_after' => $tutorWallet->balance,
            ]);

            /*
             * ---------------------------------------------
             * 3. ACCEPT THE SOLUTION
             * ---------------------------------------------
             */
            $solution->update([
                'status' => 'accepted',
            ]);

            /*
             * Reject all other submitted solutions
             * for this problem.
             */
            Solution::where('problem_id', $problem->id)
                ->where('id', '!=', $solution->id)
                ->where('status', 'submitted')
                ->update([
                    'status' => 'rejected',
                ]);

            /*
             * The problem is now officially solved.
             */
            $problem->update([
                'status' => 'Solved',
            ]);

            /*
             * ---------------------------------------------
             * 4. AWARD POINTS TO THE TUTOR
             * ---------------------------------------------
             */
            $points = match ($problem->difficulty) {
                'Easy' => 5,
                'Medium' => 10,
                'Hard' => 20,
                default => 0,
            };

            $tutor->increment('points', $points);
        });

    } catch (\Exception $e) {

        return redirect()
            ->route('problems.solutions', $problem->id)
            ->with('error', $e->getMessage());
    }

    return redirect()
        ->route('problems.solutions', $problem->id)
        ->with(
            'success',
            'Solution accepted successfully! ৳' .
            number_format($solution->reward, 2) .
            ' has been transferred to the Student Tutor.'
        );
}
public function solutions(Problem $problem)
{
    // Only the student who posted the problem can view its solutions
    if ($problem->user_id !== Auth::id()) {
        abort(403);
    }

    $solutions = $problem->solutions()
        ->with('studentTutor')
        ->whereIn('status', ['submitted', 'accepted', 'rejected'])
        ->latest('submitted_at')
        ->get();

    return view('problems.solutions', compact('problem', 'solutions'));
}
}

