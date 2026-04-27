<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user', 'department')->latest()->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.teachers.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|string|min:8|confirmed',
            'employee_id'   => 'required|string|max:50|unique:teachers,employee_id',
            'department_id' => 'required|exists:departments,id',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('Teacher');

        Teacher::create([
            'user_id'       => $user->id,
            'employee_id'   => $request->employee_id,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('user', 'department', 'subjects');
        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $departments = Department::all();
        return view('admin.teachers.edit', compact('teacher', 'departments'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $teacher->user_id,
            'employee_id'   => 'required|string|max:50|unique:teachers,employee_id,' . $teacher->id,
            'department_id' => 'required|exists:departments,id',
        ]);

        $teacher->user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $teacher->update([
            'employee_id'   => $request->employee_id,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->subjects()->count()) {
            return back()->with('error', 'Cannot delete teacher: They are assigned to subjects.');
        }

        $teacher->user->delete(); // cascades to teacher
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
