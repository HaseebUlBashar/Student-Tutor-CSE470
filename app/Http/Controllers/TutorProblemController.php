<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

class TutorProblemController extends Controller
{
    public function index(Request $request)
    {
        $query = Problem::whereIn('status', ['Open', 'In Progress']);

        // Search by department
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        // Search by course
        if ($request->filled('course')) {
            $query->where('course', $request->course);
        }

        // Search by exact reward
        if ($request->filled('reward')) {
            $query->where('reward', $request->reward);
        }

        // Filter by difficulty
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        // Filter by minimum reward
        if ($request->filled('min_reward')) {
            $query->where('reward', '>=', $request->min_reward);
        }

        // Filter by maximum reward
        if ($request->filled('max_reward')) {
            $query->where('reward', '<=', $request->max_reward);
        }

        // Filter by deadline
        if ($request->filled('deadline')) {
            $query->whereDate('deadline', $request->deadline);
        }
        
        //Sorting
        $sort = $request->get('sort', 'latest');

        switch ($sort) {

            case 'reward_high':
                $query->orderBy('reward', 'desc');
                break;

            case 'reward_low':
                $query->orderBy('reward', 'asc');
                break;

            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;

            case 'deadline_soon':
                $query->orderBy('deadline', 'asc');
                break;

            case 'deadline_late':
                $query->orderBy('deadline', 'desc');
                break;

            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $problems = $query->get();

        return view('tutor.problems', compact('problems'));
    }
}