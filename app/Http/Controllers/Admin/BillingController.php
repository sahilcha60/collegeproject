<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index()
    {
        $billings = Billing::with('student.user')->latest()->get();

        return view('admin.billings.index', compact('billings'));
    }

    public function create()
    {
        $students = Student::with('user')->orderBy('enrollment_no')->get();

        return view('admin.billings.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:fee,fine',
            'amount' => 'required|numeric|min:0.01',
            'due_date' => 'required|date',
        ]);

        Billing::create([
            'student_id' => $request->student_id,
            'title' => $request->title,
            'type' => $request->type,
            'amount' => $request->amount,
            'status' => 'pending',
            'due_date' => $request->due_date,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.billings.index')->with('success', 'Billing record added successfully.');
    }

    public function show(Student $student)
    {
        $student->load(['user', 'department', 'semester', 'billings']);

        return view('admin.billings.show', compact('student'));
    }

    public function pay(Billing $billing)
    {
        if ($billing->status === 'paid') {
            return back()->with('info', 'This billing record is already paid.');
        }

        $billing->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return back()->with('success', 'Payment marked as paid.');
    }
}
