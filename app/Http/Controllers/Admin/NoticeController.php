<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::latest()->get();
        return view('admin.notices.index', compact('notices'));
    }

    public function create()
    {
        return view('admin.notices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'target'  => 'required|in:student,teacher,all',
        ]);

        Notice::create($request->only('title', 'content', 'target'));
        return redirect()->route('admin.notices.index')->with('success', 'Notice published successfully.');
    }

    public function show(Notice $notice)
    {
        return view('admin.notices.show', compact('notice'));
    }

    public function edit(Notice $notice)
    {
        return view('admin.notices.edit', compact('notice'));
    }

    public function update(Request $request, Notice $notice)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'target'  => 'required|in:student,teacher,all',
        ]);

        $notice->update($request->only('title', 'content', 'target'));
        return redirect()->route('admin.notices.index')->with('success', 'Notice updated successfully.');
    }

    public function destroy(Notice $notice)
    {
        $notice->delete();
        return redirect()->route('admin.notices.index')->with('success', 'Notice deleted successfully.');
    }
}
