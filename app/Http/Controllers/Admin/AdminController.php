<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Notice;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\Request;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistics
        $stats = [
            'departments' => Department::count(),
            'students' => Student::count(),
            'teachers' => Teacher::count(),
            'subjects' => Subject::count(),
            'pending_requests' => Request::where('status', 'pending')->count(),
            'today_attendance' => Attendance::whereDate('date', now())->count(),
            'student_attendance_today' => Attendance::where('role', 'student')->whereDate('date', now())->count(),
            'teacher_attendance_today' => Attendance::where('role', 'teacher')->whereDate('date', now())->count(),
        ];

        // Recent notices (last 5)
        $recentNotices = Notice::latest()->take(5)->get();

        // Upcoming exams (next 5 based on exam schedules)
        $upcomingExams = ExamSchedule::with('exam', 'subject')
            ->where('exam_date', '>=', now())
            ->orderBy('exam_date')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentNotices', 'upcomingExams'));
    }
}
