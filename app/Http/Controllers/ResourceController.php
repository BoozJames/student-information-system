<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\File;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $resourceQuery = Resource::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $resourceQuery->where(function ($query) use ($search) {
                $query->where('resource_name', 'like', "%$search%")
                    ->orWhere('resource_type', 'like', "%$search%")
                    ->orWhere('resource_uploaded_by', 'like', "%$search%");
            });
        }

        // Fetch distinct resource types
        $resourceTypes = $resourceQuery->pluck('resource_type')->unique();

        // Add filter for resource_type
        if ($request->filled('type')) {
            $type = $request->input('type');
            $resourceQuery->where('resource_type', $type);
        }

        $resources = $resourceQuery->paginate()->appends(request()->query());
        return view('resources.index', compact('resources', 'resourceTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all users where user_type is teacher
        $users = User::where('user_type', 'teacher')->get();

        if (Auth::user()->user_type === 'teacher' || Auth::user()->user_type === 'admin') {
            return view('resources.create', compact('users'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->user_type === 'teacher' || Auth::user()->user_type === 'admin') {
            $request->validate([
                'resource_name' => 'required',
                'resource_type' => 'required',
                'resource_uploaded_by' => 'required',
                'resource_file' => 'required|file',
            ]);

            $file = $request->file('resource_file');
            $fileName = $file->getClientOriginalName();

            // Store file in storage/app/public/resource directory
            $file->storeAs('public/resources', $fileName);

            $resource = new Resource([
                'resource_name' => $request->get('resource_name'),
                'resource_type' => $request->get('resource_type'),
                'resource_filename' => $fileName,
                'resource_url' => Storage::url('resources/' . $fileName), // Get URL from storage
                'resource_uploaded_by' => $request->get('resource_uploaded_by'),
            ]);

            $resource->save();

            return redirect()->route('resources.index')
                ->with('success', 'Resource created successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        return view('resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        if (Auth::user()->user_type === 'teacher' || Auth::user()->user_type === 'admin') {
            return view('resources.edit', compact('resource'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        if (Auth::user()->user_type === 'teacher' || Auth::user()->user_type === 'admin') {
            $request->validate([
                'resource_name' => 'required',
                'resource_type' => 'required',
                'resource_filename' => 'required',
                'resource_url' => 'required',
                'resource_uploaded_by' => 'required',
            ]);

            $resource->update($request->all());

            return redirect()->route('resources.index')
                ->with('success', 'Resource updated successfully');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        if (Auth::user()->user_type === 'teacher' || Auth::user()->user_type === 'admin') {
            // Delete the file from storage
            Storage::delete('public/resources/' . $resource->resource_filename);

            // Delete the resource
            $resource->delete();

            return redirect()->route('resources.index')
                ->with('success', 'Resource deleted successfully');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
