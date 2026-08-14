<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

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
            'admin_note' => 'nullable|string|max:2000',
        ]);

        $report->update([
            'status' => 'action_taken',
            'admin_note' => $validated['admin_note'] ?? null,
        ]);

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