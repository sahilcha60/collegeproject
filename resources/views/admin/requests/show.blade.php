@extends('admin.layouts.master')

@section('header_title', 'Request Details')
@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 mb-6">
            <div>
                <h3 class="text-lg font-semibold text-slate-900">Request from {{ $request->user->name ?? 'User' }}</h3>
                <div class="mt-3 flex flex-wrap gap-2 text-sm">
                    <span class="inline-flex items-center rounded-full bg-slate-100 text-slate-800 px-3 py-1">{{ $request->user->email ?? 'No email' }}</span>
                    <span class="inline-flex items-center rounded-full bg-slate-100 text-slate-800 px-3 py-1 capitalize">{{ $request->type }}</span>
                    <span class="inline-flex items-center rounded-full bg-amber-100 text-amber-800 px-3 py-1 capitalize">{{ $request->status }}</span>
                    <span class="inline-flex items-center rounded-full bg-slate-100 text-slate-800 px-3 py-1">Requested {{ $request->created_at->diffForHumans() }}</span>
                </div>
            </div>
            <div class="self-start">
                <a href="{{ route('admin.requests.index') }}" class="inline-flex items-center rounded-full bg-slate-100 text-slate-800 px-4 py-2 text-sm font-medium hover:bg-slate-200">Back to requests</a>
            </div>
        </div>

        <div class="mb-6">
            <h4 class="text-sm font-semibold text-gray-700 mb-2">Message</h4>
            <div class="rounded-lg border border-gray-200 p-4 bg-gray-50 text-gray-700">{{ $request->message }}</div>
        </div>

        <div class="mb-6">
            <h4 class="text-sm font-semibold text-gray-700 mb-2">Response</h4>
            <div class="rounded-lg border border-gray-200 p-4 bg-gray-50 text-gray-700">{{ $request->response ?? 'No response yet.' }}</div>
        </div>

        <form action="{{ route('admin.requests.update', $request) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="approved" @selected(old('status', $request->status) === 'approved')>Approve</option>
                        <option value="rejected" @selected(old('status', $request->status) === 'rejected')>Reject</option>
                    </select>
                    @error('status')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Response</label>
                    <textarea name="response" rows="4" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('response', $request->response) }}</textarea>
                    @error('response')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Save Decision</button>
            </div>
        </form>
    </div>
</div>
@endsection
