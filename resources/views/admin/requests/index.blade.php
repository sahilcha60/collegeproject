@extends('admin.layouts.master')

@section('header_title', 'Requests')
@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden mb-6">
    <div class="bg-slate-50 px-6 py-5 border-b border-slate-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
                <p class="text-sm text-slate-500">Requests awaiting action</p>
                <h3 class="text-xl font-semibold text-slate-900">Student / Teacher Requests</h3>
            </div>
            <a href="{{ route('admin.requests.index') }}" class="inline-flex items-center gap-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-sm font-medium transition">Refresh List</a>
        </div>
    </div>
    <div class="px-6 py-5 bg-white border-b border-slate-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-sm text-slate-500">Total requests</p>
                <p class="text-2xl font-semibold text-slate-900">{{ $requests->count() }}</p>
            </div>
            <div class="inline-flex flex-wrap gap-2">
                <span class="inline-flex items-center rounded-full bg-yellow-50 text-yellow-800 px-3 py-1 text-sm">Pending</span>
                <span class="inline-flex items-center rounded-full bg-green-50 text-green-800 px-3 py-1 text-sm">Approved</span>
                <span class="inline-flex items-center rounded-full bg-red-50 text-red-800 px-3 py-1 text-sm">Rejected</span>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto bg-white">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Message</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Response</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($requests as $request)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $request->user->name ?? '—' }}</td>
                    <td class="px-6 py-4 text-sm text-slate-700">
                        <span class="inline-flex items-center rounded-full bg-slate-100 text-slate-800 px-2.5 py-1 text-xs uppercase tracking-wide">{{ $request->type }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-700">{{ \Illuminate\Support\Str::limit($request->message, 80) }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if($request->status === 'pending')
                            <span class="inline-flex items-center rounded-full bg-yellow-100 text-yellow-800 px-2.5 py-1 text-xs uppercase tracking-wide">Pending</span>
                        @elseif($request->status === 'approved')
                            <span class="inline-flex items-center rounded-full bg-green-100 text-green-800 px-2.5 py-1 text-xs uppercase tracking-wide">Approved</span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-red-100 text-red-800 px-2.5 py-1 text-xs uppercase tracking-wide">Rejected</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-700">{{ $request->response ?? '—' }}</td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.requests.show', $request) }}" class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100">View</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">No requests found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
