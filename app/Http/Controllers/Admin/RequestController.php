<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request as UserRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $requests = UserRequest::with('user')->latest()->get();

        return view('admin.requests.index', compact('requests'));
    }

    public function show(UserRequest $request)
    {
        $request->load('user');

        return view('admin.requests.show', compact('request'));
    }

    public function update(Request $request, UserRequest $userRequest)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'response' => 'nullable|string|max:2000',
        ]);

        $userRequest->update([
            'status' => $request->status,
            'response' => $request->response,
        ]);

        return back()->with('success', 'Request status updated successfully.');
    }
}
