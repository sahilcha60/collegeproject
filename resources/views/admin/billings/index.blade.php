@extends('admin.layouts.master')

@section('header_title', 'Billing')
@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="flex justify-between items-center px-6 py-4 border-b">
        <h3 class="text-lg font-semibold text-gray-700">Billing Records</h3>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.billings.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">+ Add Fee / Fine</a>
        </div>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($billings as $billing)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $billing->student->user->name ?? '—' }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $billing->title }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">₹{{ number_format($billing->amount, 2) }}</td>
                <td class="px-6 py-4 text-sm text-gray-700 capitalize">{{ $billing->type }}</td>
                <td class="px-6 py-4 text-sm text-gray-700 capitalize">{{ $billing->status }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ optional($billing->due_date)->format('d M Y') }}</td>
                <td class="px-6 py-4 text-sm flex gap-3">
                    <a href="{{ route('admin.billings.show', $billing->student) }}" class="text-blue-600 hover:underline">Student</a>
                    @if($billing->status === 'pending')
                        <form action="{{ route('admin.billings.pay', $billing) }}" method="POST" onsubmit="return confirm('Mark this billing as paid?')">
                            @csrf
                            <button type="submit" class="text-green-600 hover:underline">Mark Paid</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="px-6 py-4 text-center text-gray-500">No billing records found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
