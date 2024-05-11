<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::paginate(10); // Change 10 to the number of items per page you desire
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch schedules and users to pass to the view
        $schedules = Schedule::all();
        $users = User::all();

        return view('attendances.create', compact('schedules', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'attended' => 'required|boolean',
        ]);

        // Create the attendance record
        Attendance::create($request->all());

        // Redirect to the index page with a success message
        return redirect()->route('attendances.index')->with('success', 'Attendance recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        // Validate the incoming request data
        $request->validate([
            'date' => 'required|date',
            'attended' => 'required|boolean',
        ]);

        // Update the attendance record
        $attendance->update($request->all());

        // Redirect back to the index page with a success message
        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        // Delete the attendance record
        $attendance->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully.');
    }
}
