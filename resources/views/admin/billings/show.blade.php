@extends('admin.layouts.master')

@section('header_title', 'Student Billing')
@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">{{ $student->user->name ?? 'Student' }}</h3>
                <p class="text-sm text-gray-500">Enrollment: {{ $student->enrollment_no }}</p>
                <p class="text-sm text-gray-500">Department: {{ $student->department->name ?? '—' }} · Semester: {{ $student->semester->name ?? '—' }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.billings.index') }}" class="text-blue-600 hover:underline">Back to billing records</a>
                <a href="{{ route('admin.billings.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Add Fee / Fine</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Billing for {{ $student->user->name ?? 'Student' }}</h3>
            <span class="text-sm font-medium text-gray-600">Total Due: ₹{{ number_format($student->billings->where('status', 'pending')->sum('amount'), 2) }}</span>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paid At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($student->billings as $billing)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $billing->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700 capitalize">{{ $billing->type }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">₹{{ number_format($billing->amount, 2) }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700 capitalize">{{ $billing->status }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ optional($billing->due_date)->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ optional($billing->paid_at)->format('d M Y') ?: '—' }}</td>
                    <td class="px-6 py-4 text-sm flex gap-3">
                        @if($billing->status === 'pending')
                        <form action="{{ route('admin.billings.pay', $billing) }}" method="POST" onsubmit="return confirm('Mark this billing as paid?')">
                            @csrf
                            <button type="submit" class="text-green-600 hover:underline">Mark Paid</button>
                        </form>
                        @else
                        <span class="text-gray-500">Paid</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="px-6 py-4 text-center text-gray-500">No billing records found for this student.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
