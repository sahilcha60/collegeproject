<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->get();
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
        ]);

        Department::create($request->only('name'));
        return redirect()->route('admin.departments.index')->with('success', 'Department created successfully.');
    }

    public function show(Department $department)
    {
        return view('admin.departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
        ]);

        $department->update($request->only('name'));
        return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        if ($department->students()->count()) {
            return back()->with('error', 'Cannot delete department: It has associated students.');
        }

        if ($department->teachers()->count()) {
            return back()->with('error', 'Cannot delete department: It has associated teachers.');
        }

        if ($department->subjects()->count()) {
            return back()->with('error', 'Cannot delete department: It has associated subjects.');
        }

        $department->delete();
        return redirect()->route('admin.departments.index')->with('success', 'Department deleted successfully.');
    }
}
