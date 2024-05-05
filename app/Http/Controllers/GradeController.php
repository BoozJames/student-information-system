<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    /**
     * Display a listing of the grades.
     */
    public function index(Request $request)
    {
        // Only admins and teachers can access the grades index
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            // Start with querying all grades
            $query = Grade::query();

            // Search functionality
            if ($request->filled('search')) {
                $search = $request->input('search');
                // Add search conditions to the query
                $query->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                })->orWhereHas('subject', function ($subjectQuery) use ($search) {
                    $subjectQuery->where('subject_name', 'like', "%$search%")
                        ->orWhere('subject_code', 'like', "%$search%");
                })->orWhere('value', 'like', "%$search%");
            }

            // Paginate the results
            $grades = $query->paginate();

            return view('grades.index', compact('grades'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for creating a new grade.
     */
    public function create()
    {
        // Only admins can create grades
        if (strtolower(Auth::user()->user_type) === 'admin') {
            return view('grades.create');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created grade in storage.
     */
    public function store(Request $request)
    {
        // Only admins can create grades
        if (strtolower(Auth::user()->user_type) === 'admin') {
            // Validation rules for creating a grade
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'subject_id' => 'required|exists:subjects,id',
                'value' => 'required|numeric|min:0|max:100',
            ]);

            // Create the grade
            Grade::create($request->all());

            return redirect()->route('grades.index')
                ->with('success', 'Grade created successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Display the specified grade.
     */
    public function show(Grade $grade)
    {
        // Only admins and teachers can view grades
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            return view('grades.show', compact('grade'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for editing the specified grade.
     */
    public function edit(Grade $grade)
    {
        // Only admins can edit grades
        if (strtolower(Auth::user()->user_type) === 'admin') {
            return view('grades.edit', compact('grade'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified grade in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        // Only admins can update grades
        if (strtolower(Auth::user()->user_type) === 'admin') {
            // Validation rules for updating a grade
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'subject_id' => 'required|exists:subjects,id',
                'value' => 'required|numeric|min:0|max:100',
            ]);

            // Update the grade
            $grade->update($request->all());

            return redirect()->route('grades.index')
                ->with('success', 'Grade updated successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified grade from storage.
     */
    public function destroy(Grade $grade)
    {
        // Only admins can delete grades
        if (strtolower(Auth::user()->user_type) === 'admin') {
            $grade->delete();

            return redirect()->route('grades.index')
                ->with('success', 'Grade deleted successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
