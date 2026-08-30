<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

class SolvedProblemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Problem::where('status', 'Solved')
            ->whereHas('solutions', function ($query) {
                $query->where('status', 'accepted');
            })
            ->with([
                'solutions' => function ($query) {
                    $query->where('status', 'accepted')
                        ->with('studentTutor');
                }
            ]);

        if ($search) {
            $words = preg_split('/\s+/', trim($search));

            foreach ($words as $word) {
                $query->where(function ($query) use ($word) {
                    $query->where('department', 'like', '%' . $word . '%')
                        ->orWhere('course', 'like', '%' . $word . '%')
                        ->orWhere('chapter', 'like', '%' . $word . '%')
                        ->orWhere('title', 'like', '%' . $word . '%')
                        ->orWhere('description', 'like', '%' . $word . '%');
                });
            }
        }

        $problems = $query
            ->latest()
            ->get();

        return view('solved-problems.index', compact('problems', 'search'));
    }
}