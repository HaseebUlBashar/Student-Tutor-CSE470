<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\UseWarning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    public function show(Report $report)
    {
        $report->load([
            'reporter',
            'reportedUser',
            'problem',
            'solution',
        ]);

        return view('admin.reports.show', compact('report'));
    }

    public function takeAction(Request $request, Report $report)
    {
        $validated = $request->validate([
            'action' => 'required|in:remove_content,warn,remove_and_warn,suspend,ban',
            'suspension_duration' => 'nullable|in:1,7,30',
            'admin_note' => 'nullable|string|max:2000',
        ]);

        if (
            $validated['action'] === 'suspend' &&
            empty($validated['suspension_duration'])
        ) {
            return back()
                ->withErrors([
                    'suspension_duration' => 'Please select a suspension duration.',
                ])
                ->withInput();
        }

        DB::transaction(function () use ($validated, $report) {

            $user = $report->reportedUser;

            /*
            * Remove the reported content.
            */
            if (
                in_array($validated['action'], [
                    'remove_content',
                    'remove_and_warn',
                ])
            ) {
                if ($report->problem) {
                    $report->problem->delete();
                }

                if ($report->solution) {
                    $report->solution->delete();
                }
            }

            /*
            * Create a warning.
            */
            if (
                in_array($validated['action'], [
                    'warn',
                    'remove_and_warn',
                ])
            ) {
                UserWarning::create([
                    'user_id' => $user->id,
                    'admin_id' => auth()->id(),
                    'report_id' => $report->id,
                    'reason' => $validated['admin_note'] ?? 'Warning issued by administrator.',
                ]);
            }

            /*
            * Suspend the user.
            */
            if ($validated['action'] === 'suspend') {

                $user->update([
                    'account_status' => 'suspended',
                    'suspended_until' => now()->addDays(
                        (int) $validated['suspension_duration']
                    ),
                ]);
            }

            /*
            * Permanently ban the user.
            */
            if ($validated['action'] === 'ban') {

                $user->update([
                    'account_status' => 'banned',
                    'suspended_until' => null,
                ]);
            }

            /*
            * Mark the report as handled.
            */
            $report->update([
                'status' => 'action_taken',
                'admin_note' => $validated['admin_note'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Action has been taken on the report.');
    }

    public function dismiss(Request $request, Report $report)
    {
        $validated = $request->validate([
            'admin_note' => 'nullable|string|max:2000',
        ]);

        $report->update([
            'status' => 'dismissed',
            'admin_note' => $validated['admin_note'] ?? null,
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Report has been dismissed.');
    }
}