<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SubmissionController extends Controller
{
    use AuthorizesRequests;

    public function create()
    {
        $subjects = Subject::all();
        return view('submissions.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'file' => 'required|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png,gif',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('public/submissions');
            Log::info('File stored at: ' . $filePath);

            Submission::create([
                'student_id' => auth()->id(),
                'subject_id' => $request->subject_id,
                'file_path' => $filePath,
                'submitted_at' => now(),
            ]);

            return redirect()->route('submissions.index')->with('success', 'Submission created successfully.');
        } else {
            Log::error('File upload failed: no file found in the request.');
            return redirect()->route('submissions.create')->with('error', 'File upload failed.');
        }
    }

    public function index()
    {
        if (auth()->user()->user_type === 'teacher') {
            // Get the subjects the teacher is teaching using the teacher_id column
            $subjectIds = Subject::where('teacher_id', auth()->id())->pluck('id')->toArray();
            // Get submissions for those subjects
            $submissions = Submission::whereIn('subject_id', $subjectIds)->paginate(10);
        } else {
            // Get submissions for the logged-in student
            $submissions = Submission::where('student_id', auth()->id())->paginate(10);
        }

        return view('submissions.index', compact('submissions'));
    }

    public function show(Submission $submission)
    {
        // Manually check if the user is authorized to view the submission
        if (auth()->user()->user_type === 'teacher' || $submission->student_id === auth()->id()) {
            return view('submissions.show', compact('submission'));
        } else {
            return redirect()->route('submissions.index')->with('error', 'Unauthorized access.');
        }
    }

    public function edit(Submission $submission)
    {
        // Manually check if the user is authorized to edit the submission
        if (auth()->user()->user_type === 'teacher' || $submission->student_id === auth()->id()) {
            return view('submissions.edit', compact('submission'));
        } else {
            return redirect()->route('submissions.index')->with('error', 'Unauthorized access.');
        }
    }

    public function update(Request $request, Submission $submission)
    {
        // Manually check if the user is authorized to update the submission
        if (auth()->user()->user_type === 'teacher' || $submission->student_id === auth()->id()) {
            $request->validate([
                'grade' => 'nullable|integer|min:0|max:100',
                'locked_at' => 'nullable|date',
            ]);

            $submission->update($request->only('grade', 'locked_at'));

            return redirect()->route('submissions.index')->with('success', 'Submission updated successfully.');
        } else {
            return redirect()->route('submissions.index')->with('error', 'Unauthorized access.');
        }
    }

    public function destroy(Submission $submission)
    {
        // Manually check if the user is authorized to delete the submission
        if (auth()->user()->user_type === 'teacher' || auth()->user()->user_type === 'admin' || $submission->student_id === auth()->id()) {
            // If submission is locked, only allow deletion by admin or teacher
            if ($submission->locked_at !== null && auth()->user()->user_type !== 'teacher' && auth()->user()->user_type !== 'admin') {
                return redirect()->route('submissions.index')->with('error', 'Submission is locked and cannot be deleted.');
            }

            Storage::delete($submission->file_path);
            $submission->delete();

            return redirect()->route('submissions.index')->with('success', 'Submission deleted successfully.');
        } else {
            return redirect()->route('submissions.index')->with('error', 'Unauthorized access.');
        }
    }
}
