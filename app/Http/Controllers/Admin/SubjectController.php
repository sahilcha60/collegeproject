<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Department;
use App\Models\Semester;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('department', 'semester')->latest()->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $departments = Department::all();
        $semesters   = Semester::all();
        return view('admin.subjects.create', compact('departments', 'semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'code'          => 'required|string|max:50|unique:subjects,code',
            'credits'       => 'required|integer|min:1|max:10',
            'department_id' => 'required|exists:departments,id',
            'semester_id'   => 'required|exists:semesters,id',
        ]);

        Subject::create($request->only('name', 'code', 'credits', 'department_id', 'semester_id'));
        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully.');
    }

    public function show(Subject $subject)
    {
        $subject->load('department', 'semester', 'teachers');
        return view('admin.subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        $departments = Department::all();
        $semesters   = Semester::all();
        return view('admin.subjects.edit', compact('subject', 'departments', 'semesters'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'code'          => 'required|string|max:50|unique:subjects,code,' . $subject->id,
            'credits'       => 'required|integer|min:1|max:10',
            'department_id' => 'required|exists:departments,id',
            'semester_id'   => 'required|exists:semesters,id',
        ]);

        $subject->update($request->only('name', 'code', 'credits', 'department_id', 'semester_id'));
        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
