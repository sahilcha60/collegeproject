<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamSchedule;
use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamScheduleController extends Controller
{
    public function index()
    {
        $schedules = ExamSchedule::with('exam', 'subject')->latest()->get();
        return view('admin.exam-schedules.index', compact('schedules'));
    }

    public function create()
    {
        $exams    = Exam::all();
        $subjects = Subject::with('semester')->get();
        return view('admin.exam-schedules.create', compact('exams', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'exam_id'    => 'required|exists:exams,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_date'  => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
        ]);

        ExamSchedule::create($request->only('exam_id', 'subject_id', 'exam_date', 'start_time', 'end_time'));
        return redirect()->route('admin.exam-schedules.index')->with('success', 'Schedule added successfully.');
    }

    public function show(ExamSchedule $examSchedule)
    {
        $examSchedule->load('exam', 'subject');
        return view('admin.exam-schedules.show', compact('examSchedule'));
    }

    public function edit(ExamSchedule $examSchedule)
    {
        $exams    = Exam::all();
        $subjects = Subject::with('semester')->get();
        return view('admin.exam-schedules.edit', compact('examSchedule', 'exams', 'subjects'));
    }

    public function update(Request $request, ExamSchedule $examSchedule)
    {
        $request->validate([
            'exam_id'    => 'required|exists:exams,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_date'  => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
        ]);

        $examSchedule->update($request->only('exam_id', 'subject_id', 'exam_date', 'start_time', 'end_time'));
        return redirect()->route('admin.exam-schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(ExamSchedule $examSchedule)
    {
        $examSchedule->delete();
        return redirect()->route('admin.exam-schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
