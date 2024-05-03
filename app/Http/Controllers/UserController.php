<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the user.
     */
    public function index(Request $request)
    {
        // Only admins and teachers can access the user index
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            $query = User::query();
    
            // Search functionality
            if ($request->filled('search')) {
                $search = $request->input('search');
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('user_type', 'like', "%$search%");
                });
            }
    
            // Filter by user type
            if ($request->filled('user_type')) {
                $userType = $request->input('user_type');
                $query->where('user_type', $userType);
            }
    
            // Exclude admin users if the authenticated user is a teacher
            if (strtolower(Auth::user()->user_type) === 'teacher') {
                $query->where('user_type', '!=', 'admin');
            }
    
            // Paginate with preserved query parameters
            $users = $query->paginate()->appends(request()->query());
    
            return view('users.index', compact('users'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
    

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Only admins can create users
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            return view('users.create');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // Only admins can create users
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            // Validation rules for creating a user
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'user_type' => 'required|in:Admin,Teacher,Student', // Example user types
            ]);

            // Create the user
            User::create($request->all());

            return redirect()->route('users.index')
                ->with('success', 'User created successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Display the specified user.
     */
    public function show(string $id)
    {
        // Only admins can view user details
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            $user = User::findOrFail($id);
            return view('users.show', compact('user'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(string $id)
    {
        // Only admins can edit users
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            $user = User::findOrFail($id);
            return view('users.edit', compact('user'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, string $id)
    {
        // Only admins can update users
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            // Validation rules for updating a user
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:8',
                'user_type' => 'required|in:Admin,Teacher,Student', // Example user types
            ]);

            // Find the user and update
            $user = User::findOrFail($id);
            $user->update($request->all());

            return redirect()->route('users.index')
                ->with('success', 'User updated successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(string $id)
    {
        // Only admins can delete users
        if (strtolower(Auth::user()->user_type) === 'teacher' || strtolower(Auth::user()->user_type) === 'admin') {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
