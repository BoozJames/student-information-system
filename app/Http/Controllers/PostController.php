<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check if the authenticated user is authorized
        if (!Auth::check() || (Auth::user()->user_type !== 'teacher' && Auth::user()->user_type !== 'admin' && Auth::user()->user_type !== 'student')) {
            abort(403, 'Unauthorized action.');
        }

        $postQuery = Post::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $postQuery->where(function ($query) use ($search) {
                $query->where('post_title', 'like', "%$search%")
                    ->orWhere('post_content', 'like', "%$search%")
                    ->orWhere('post_type', 'like', "%$search%");
            });
        }

        // Add filter for resource_type
        if ($request->filled('type')) {
            $type = $request->input('type');
            $postQuery->where('post_type', $type);
        }

        $posts = $postQuery->paginate()->appends(request()->query());

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if the authenticated user is authorized
        if (!Auth::check() || (Auth::user()->user_type !== 'teacher' && Auth::user()->user_type !== 'admin')) {
            abort(403, 'Unauthorized action.');
        }

        // Get all users
        $users = User::all();

        return view('posts.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the authenticated user is authorized
        if (!Auth::check() || (Auth::user()->user_type !== 'teacher' && Auth::user()->user_type !== 'admin')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'post_title' => 'required',
            'post_content' => 'required',
            'post_type' => 'required',
            'post_uploaded_by' => 'required',
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Check if the authenticated user is authorized to view the post
        if (!Auth::check() || (Auth::user()->user_type !== 'teacher' && Auth::user()->user_type !== 'admin')) {
            abort(403, 'Unauthorized action.');
        }

        // Eager load the 'user' relationship
        $post->load('user');

        // Check if the post has a related user
        if ($post->user) {
            return view('posts.show', compact('post'));
        } else {
            abort(404, 'User not found for this post.');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Check if the authenticated user is authorized
        if (!Auth::check() || (Auth::user()->user_type !== 'teacher' && Auth::user()->user_type !== 'admin')) {
            abort(403, 'Unauthorized action.');
        }

        // Get all users
        $users = User::all();

        return view('posts.edit', compact('post', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Check if the authenticated user is authorized
        if (!Auth::check() || (Auth::user()->user_type !== 'teacher' && Auth::user()->user_type !== 'admin')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'post_title' => 'required',
            'post_content' => 'required',
            'post_type' => 'required',
            'post_uploaded_by' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Check if the authenticated user is authorized
        if (!Auth::check() || (Auth::user()->user_type !== 'teacher' && Auth::user()->user_type !== 'admin')) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
}
