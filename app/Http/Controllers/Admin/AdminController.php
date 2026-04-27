<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Notice;
use App\Models\Exam;
use App\Models\ExamSchedule;

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
