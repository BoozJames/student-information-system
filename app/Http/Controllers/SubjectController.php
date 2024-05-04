<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check if the authenticated user is a teacher or admin
        if (Auth::user()->user_type !== 'teacher' && Auth::user()->user_type !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $query = Subject::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('subject_name', 'like', "%$search%")
                ->orWhere('subject_code', 'like', "%$search%");
        }

        // Filter by teacher
        if ($request->filled('teacher_id')) {
            $teacherId = $request->input('teacher_id');
            $query->where('teacher_id', $teacherId);
        }

        // Paginate with preserved query parameters
        $subjects = $query->paginate()->appends(request()->query());

        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if the authenticated user is a teacher or admin
        if (Auth::user()->user_type !== 'teacher' && Auth::user()->user_type !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $teachers = User::where('user_type', 'teacher')->get();
        return view('subjects.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the authenticated user is a teacher or admin
        if (Auth::user()->user_type !== 'teacher' && Auth::user()->user_type !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'subject_name' => 'required|string',
            'subject_code' => 'required|string',
            'teacher_id' => 'required|exists:users,id',
        ]);

        Subject::create($request->all());

        return redirect()->route('subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        // Check if the authenticated user is a teacher or admin
        if (Auth::user()->user_type !== 'teacher' && Auth::user()->user_type !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $teachers = User::where('user_type', 'teacher')->get();
        return view('subjects.edit', compact('subject', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        // Check if the authenticated user is a teacher or admin
        if (Auth::user()->user_type !== 'teacher' && Auth::user()->user_type !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'subject_name' => 'required|string',
            'subject_code' => 'required|string',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        // Check if the authenticated user is a teacher or admin
        if (Auth::user()->user_type !== 'teacher' && Auth::user()->user_type !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }
}
