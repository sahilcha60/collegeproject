<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Semester;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('semester')->withCount('schedules')->latest()->get();
        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        $semesters = Semester::orderBy('name')->get();
        return view('admin.exams.create', compact('semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|in:Mid,Pre-board,Board',
            'type'        => 'required|in:college,university',
            'semester_id' => 'nullable|exists:semesters,id',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
        ]);

        Exam::create($request->only('name', 'type', 'semester_id', 'start_date', 'end_date'));
        return redirect()->route('admin.exams.index')->with('success', 'Exam created successfully.');
    }

    public function show(Exam $exam)
    {
        $exam->load('schedules.subject', 'semester', 'results.student.user');
        return view('admin.exams.show', compact('exam'));
    }

    public function edit(Exam $exam)
    {
        $semesters = Semester::orderBy('name')->get();
        return view('admin.exams.edit', compact('exam', 'semesters'));
    }

    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'name'        => 'required|in:Mid,Pre-board,Board',
            'type'        => 'required|in:college,university',
            'semester_id' => 'nullable|exists:semesters,id',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
        ]);

        $exam->update($request->only('name', 'type', 'semester_id', 'start_date', 'end_date'));
        return redirect()->route('admin.exams.index')->with('success', 'Exam updated successfully.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('admin.exams.index')->with('success', 'Exam deleted successfully.');
    }
}
