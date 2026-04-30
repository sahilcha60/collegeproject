<?php

namespace App\Http\Controllers;

use App\Models\Request as UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index()
    {
        $requests = UserRequest::where('user_id', Auth::id())->latest()->get();

        return view('requests.index', compact('requests'));
    }

    public function create()
    {
        return view('requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:leave,re-evaluation,other',
            'message' => 'required|string|max:2000',
        ]);

        UserRequest::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->route('requests.index')->with('success', 'Request submitted successfully.');
    }
}
