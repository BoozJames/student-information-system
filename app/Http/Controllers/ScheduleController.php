<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Start with querying schedules
        $query = Schedule::query();

        // Adjust the query based on user type
        if (strtolower(Auth::user()->user_type) === 'student') {
            // Filter schedules for students based on their ID
            $query->whereHas('user', function ($studentQuery) {
                $studentQuery->where('id', Auth::id());
            });
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            // Add search conditions to the query
            $query->where('day_of_week', 'like', "%$search%")
                ->orWhere('start_time', 'like', "%$search%")
                ->orWhere('end_time', 'like', "%$search%");
        }

        // Paginate the results
        $schedules = $query->paginate(10);

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only admins can create schedules
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            // Retrieve users and subjects
            $users = User::all();
            $subjects = Subject::all();

            // Pass users and subjects to the create view
            return view('schedules.create', compact('users', 'subjects'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only admins can create schedules
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            // Validation rules for creating a schedule
            $request->validate([
                'user_id' => 'required',
                'subject_id' => 'required',
                'day_of_week' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                // 'attendance' => 'required',
            ]);

            // Create the schedule
            Schedule::create($request->all());

            return redirect()->route('schedules.index')
                ->with('success', 'Schedule created successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        // Only admins and teachers can view schedules
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            return view('schedules.show', compact('schedule'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        // Only admins can edit schedules
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            // Retrieve users and subjects
            $users = User::all();
            $subjects = Subject::all();

            // Pass schedule, users, and subjects to the edit view
            return view('schedules.edit', compact('schedule', 'users', 'subjects'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        // Only admins can update schedules
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            // Validation rules for updating a schedule
            $request->validate([
                'user_id' => 'required',
                'subject_id' => 'required',
                'day_of_week' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                // 'attendance' => 'required',
            ]);

            // Update the schedule
            $schedule->update($request->all());

            return redirect()->route('schedules.index')
                ->with('success', 'Schedule updated successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        // Only admins can delete schedules
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            // Delete the schedule
            $schedule->delete();

            return redirect()->route('schedules.index')
                ->with('success', 'Schedule deleted successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
