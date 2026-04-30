<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController as UserRequestController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\RequestController as AdminRequestController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ExamScheduleController;
use App\Http\Controllers\Admin\ResultController as AdminResultController;

// Teacher Controllers
use App\Http\Controllers\Teacher\ResultController as TeacherResultController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('requests', UserRequestController::class)->only(['index', 'create', 'store']);
});

// Admin Routes
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('departments', DepartmentController::class);
    Route::resource('semesters', SemesterController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
    Route::resource('notices', NoticeController::class);

    Route::resource('exams', ExamController::class);
    Route::resource('exam-schedules', ExamScheduleController::class);
    Route::resource('billings', BillingController::class)->except(['show']);
    Route::get('billings/student/{student}', [BillingController::class, 'show'])->name('billings.show');
    Route::post('billings/{billing}/pay', [BillingController::class, 'pay'])->name('billings.pay');

    Route::get('attendance/students', [AttendanceController::class, 'students'])->name('attendance.students');
    Route::post('attendance/students', [AttendanceController::class, 'storeStudent'])->name('attendance.students.store');
    Route::get('attendance/teachers', [AttendanceController::class, 'teachers'])->name('attendance.teachers');
    Route::post('attendance/teachers', [AttendanceController::class, 'storeTeacher'])->name('attendance.teachers.store');
    Route::get('attendance/report', [AttendanceController::class, 'report'])->name('attendance.report');

    Route::resource('requests', AdminRequestController::class)->only(['index', 'show', 'update']);

    Route::resource('results', AdminResultController::class);
});

// Teacher Routes
Route::middleware(['auth', 'role:Teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::resource('results', TeacherResultController::class);
});

require __DIR__.'/auth.php';
