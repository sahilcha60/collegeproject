<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Exam;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $query = Result::with('student.user', 'subject', 'semester', 'exam');

        // Apply filters
        if ($request->filled('semester_id')) {
            $query->where('semester_id', $request->semester_id);
        }
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }
        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        $results = $query->latest()->get();

        // Get data for filters
        $semesters = Semester::all();
        $subjects = Subject::all();
        $students = Student::with('user')->get();

        return view('admin.results.index', compact('results', 'semesters', 'subjects', 'students'));
    }

    public function create()
    {
        $students  = Student::with('user')->get();
        $subjects  = Subject::all();
        $semesters = Semester::all();
        $exams     = Exam::all();
        return view('admin.results.create', compact('students', 'subjects', 'semesters', 'exams'));
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

        $total_marks = $request->internal_marks + $request->external_marks;

        Result::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'subject_id' => $request->subject_id,
                'exam_id' => $request->exam_id,
            ],
            [
                'semester_id' => $request->semester_id,
                'internal_marks' => $request->internal_marks,
                'external_marks' => $request->external_marks,
                'total_marks' => $total_marks,
                'grade' => $request->grade,
            ]
        );

        return redirect()->route('admin.results.index')->with('success', 'Result added/updated successfully.');
    }

    public function show(Result $result)
    {
        $result->load('student.user', 'subject', 'semester', 'exam');
        return view('admin.results.show', compact('result'));
    }

    public function edit(Result $result)
    {
        $students  = Student::with('user')->get();
        $subjects  = Subject::all();
        $semesters = Semester::all();
        $exams     = Exam::all();
        return view('admin.results.edit', compact('result', 'students', 'subjects', 'semesters', 'exams'));
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

        $total_marks = $request->internal_marks + $request->external_marks;

        $result->update([
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'semester_id' => $request->semester_id,
            'exam_id' => $request->exam_id,
            'internal_marks' => $request->internal_marks,
            'external_marks' => $request->external_marks,
            'total_marks' => $total_marks,
            'grade' => $request->grade,
        ]);

        return redirect()->route('admin.results.index')->with('success', 'Result updated successfully.');
    }

    public function destroy(Result $result)
    {
        $result->delete();
        return redirect()->route('admin.results.index')->with('success', 'Result deleted successfully.');
    }
}
