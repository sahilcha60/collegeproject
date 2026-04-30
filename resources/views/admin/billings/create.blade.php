@extends('admin.layouts.master')

@section('header_title', 'Assign Fee / Fine')
@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Assign Fee or Fine</h3>
            <p class="text-sm text-gray-500">Create a billing entry for a student.</p>
        </div>
        <a href="{{ route('admin.billings.index') }}" class="text-blue-600 hover:underline">Back to billing list</a>
    </div>

    <form action="{{ route('admin.billings.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Student</label>
                <select name="student_id" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Select student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" @selected(old('student_id') == $student->id)>{{ $student->user->name ?? '—' }} ({{ $student->enrollment_no }})</option>
                    @endforeach
                </select>
                @error('student_id')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Tuition Fee, Library Fine">
                @error('title')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="number" name="amount" value="{{ old('amount') }}" step="0.01" min="0" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="e.g. 1500.00">
                @error('amount')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="fee" @selected(old('type')=='fee')>Fee</option>
                    <option value="fine" @selected(old('type')=='fine')>Fine</option>
                </select>
                @error('type')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="date" name="due_date" value="{{ old('due_date') }}" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('due_date')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="{{ route('admin.billings.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Save Billing</button>
        </div>
    </form>
</div>
@endsection
