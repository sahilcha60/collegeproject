<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Department;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user', 'department', 'semester')->latest()->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $departments = Department::all();
        $semesters   = Semester::all();
        return view('admin.students.create', compact('departments', 'semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|string|min:8|confirmed',
            'enrollment_no' => 'required|string|max:50|unique:students,enrollment_no',
            'department_id' => 'required|exists:departments,id',
            'semester_id'   => 'required|exists:semesters,id',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('Student');

        Student::create([
            'user_id'       => $user->id,
            'enrollment_no' => $request->enrollment_no,
            'department_id' => $request->department_id,
            'semester_id'   => $request->semester_id,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        $student->load('user', 'department', 'semester');
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $departments = Department::all();
        $semesters   = Semester::all();
        return view('admin.students.edit', compact('student', 'departments', 'semesters'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $student->user_id,
            'enrollment_no' => 'required|string|max:50|unique:students,enrollment_no,' . $student->id,
            'department_id' => 'required|exists:departments,id',
            'semester_id'   => 'required|exists:semesters,id',
        ]);

        $student->user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $student->update([
            'enrollment_no' => $request->enrollment_no,
            'department_id' => $request->department_id,
            'semester_id'   => $request->semester_id,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        if ($student->results()->count()) {
            return back()->with('error', 'Cannot delete student: They have associated results.');
        }

        if ($student->attendances()->count()) {
            return back()->with('error', 'Cannot delete student: They have associated attendance records.');
        }

        if ($student->billings()->count()) {
            return back()->with('error', 'Cannot delete student: They have associated billing records.');
        }

        $student->user->delete(); // cascades to student
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}
