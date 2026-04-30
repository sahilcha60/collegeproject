<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function students(HttpRequest $request)
    {
        $subjects = Subject::orderBy('name')->get();
        $date = $request->input('date', now()->toDateString());
        $subjectId = $request->input('subject_id');
        $students = Student::with('user')->orderBy('enrollment_no')->get();

        $attendanceMap = [];
        if ($subjectId) {
            $records = Attendance::where('role', 'student')
                ->where('subject_id', $subjectId)
                ->whereDate('date', $date)
                ->get();

            $attendanceMap = $records->keyBy('student_id');
        }

        return view('admin.attendance.students', compact('subjects', 'students', 'attendanceMap', 'date', 'subjectId'));
    }

    public function storeStudent(HttpRequest $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:present,absent',
        ]);

        $students = Student::with('user')->whereIn('id', array_keys($request->attendance))->get()->keyBy('id');

        foreach ($request->attendance as $studentId => $status) {
            if (!isset($students[$studentId])) {
                continue;
            }

            $student = $students[$studentId];

            Attendance::updateOrCreate([
                'student_id' => $studentId,
                'subject_id' => $request->subject_id,
                'date' => $request->date,
                'role' => 'student',
            ], [
                'user_id' => $student->user_id,
                'status' => $status,
            ]);
        }

        return back()->with('success', 'Student attendance saved successfully.');
    }

    public function teachers(HttpRequest $request)
    {
        $date = $request->input('date', now()->toDateString());
        $teachers = Teacher::with('user')->orderBy('id')->get();

        $attendanceMap = Attendance::where('role', 'teacher')
            ->whereDate('date', $date)
            ->get()
            ->keyBy('user_id');

        return view('admin.attendance.teachers', compact('teachers', 'attendanceMap', 'date'));
    }

    public function storeTeacher(HttpRequest $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:present,absent',
        ]);

        $teachers = Teacher::with('user')->whereIn('id', array_keys($request->attendance))->get()->keyBy('id');

        foreach ($request->attendance as $teacherId => $status) {
            if (!isset($teachers[$teacherId])) {
                continue;
            }

            $teacher = $teachers[$teacherId];

            Attendance::updateOrCreate([
                'user_id' => $teacher->user_id,
                'role' => 'teacher',
                'date' => $request->date,
            ], [
                'student_id' => null,
                'subject_id' => null,
                'status' => $status,
            ]);
        }

        return back()->with('success', 'Teacher attendance saved successfully.');
    }

    public function report(HttpRequest $request)
    {
        $subjectId = $request->input('subject_id');
        $subjects = Subject::orderBy('name')->get();

        $records = Attendance::with('user', 'subject')
            ->where('role', 'student')
            ->when($subjectId, fn($query) => $query->where('subject_id', $subjectId))
            ->get();

        $summary = $records->groupBy(fn($record) => $record->student_id)->map(function ($entries) {
            return $entries->groupBy('subject_id')->map(function ($subjectEntries) {
                $present = $subjectEntries->where('status', 'present')->count();
                $total = $subjectEntries->count();

                return [
                    'student_id' => $subjectEntries->first()->student_id,
                    'subject_id' => $subjectEntries->first()->subject_id,
                    'present' => $present,
                    'total' => $total,
                    'percentage' => $total ? round(($present / $total) * 100, 2) : 0,
                ];
            });
        });

        $rows = [];
        foreach ($summary as $studentGroups) {
            foreach ($studentGroups as $group) {
                $rows[] = $group;
            }
        }

        $studentIds = collect($rows)->pluck('student_id')->filter()->unique();
        $users = DB::table('users')->whereIn('id', $studentIds)->pluck('name', 'id');

        return view('admin.attendance.report', compact('subjects', 'rows', 'users', 'subjectId'));
    }
}
