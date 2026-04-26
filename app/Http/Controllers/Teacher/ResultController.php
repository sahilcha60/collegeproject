<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function index()
    {
        // Show only results for subjects this teacher teaches
        $teacher = Auth::user()->teacher;
        $subjectIds = $teacher->subjects()->pluck('subjects.id');

        $results = Result::with('student.user', 'subject', 'semester', 'exam')
            ->whereIn('subject_id', $subjectIds)
            ->latest()
            ->get();

        return view('teacher.results.index', compact('results'));
    }

    public function create()
    {
        $teacher   = Auth::user()->teacher;
        $subjects  = $teacher->subjects()->with('semester')->get();
        $semesters = Semester::all();
        $exams     = Exam::all();
        // Students will be loaded dynamically via subject selection
        return view('teacher.results.create', compact('subjects', 'semesters', 'exams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'     => 'required|exists:students,id',
            'subject_id'     => 'required|exists:subjects,id',
            'semester_id'    => 'required|exists:semesters,id',
            'exam_id'        => 'required|exists:exams,id',
            'internal_marks' => 'required|numeric|min:0|max:100',
            'external_marks' => 'required|numeric|min:0|max:100',
        ]);

        Result::create($request->only(
            'student_id', 'subject_id', 'semester_id', 'exam_id',
            'internal_marks', 'external_marks'
        ));

        return redirect()->route('teacher.results.index')->with('success', 'Marks entered successfully.');
    }

    public function show(Result $result)
    {
        $result->load('student.user', 'subject', 'semester', 'exam');
        return view('teacher.results.show', compact('result'));
    }

    public function edit(Result $result)
    {
        $teacher   = Auth::user()->teacher;
        $subjects  = $teacher->subjects()->with('semester')->get();
        $semesters = Semester::all();
        $exams     = Exam::all();
        $students  = Student::with('user')->get();
        return view('teacher.results.edit', compact('result', 'subjects', 'semesters', 'exams', 'students'));
    }

    public function update(Request $request, Result $result)
    {
        $request->validate([
            'student_id'     => 'required|exists:students,id',
            'subject_id'     => 'required|exists:subjects,id',
            'semester_id'    => 'required|exists:semesters,id',
            'exam_id'        => 'required|exists:exams,id',
            'internal_marks' => 'required|numeric|min:0|max:100',
            'external_marks' => 'required|numeric|min:0|max:100',
        ]);

        $result->update($request->only(
            'student_id', 'subject_id', 'semester_id', 'exam_id',
            'internal_marks', 'external_marks'
        ));

        return redirect()->route('teacher.results.index')->with('success', 'Marks updated successfully.');
    }

    public function destroy(Result $result)
    {
        $result->delete();
        return redirect()->route('teacher.results.index')->with('success', 'Result deleted successfully.');
    }
}
