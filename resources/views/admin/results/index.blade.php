@extends('admin.layouts.master')
@section('header_title', 'Results')
@section('content')
@include('admin.layouts.partials.alerts')
<div class="bg-white rounded-lg shadow">
    <div class="flex justify-between items-center px-6 py-4 border-b">
        <h3 class="text-lg font-semibold text-gray-700">All Results</h3>
        <a href="{{ route('admin.results.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">+ Add Result</a>
    </div>

    <!-- Filters -->
    <div class="px-6 py-4 border-b bg-gray-50">
        <form method="GET" action="{{ route('admin.results.index') }}" class="flex gap-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Semester</label>
                <select name="semester_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">All Semesters</option>
                    @foreach($semesters as $sem)
                        <option value="{{ $sem->id }}" {{ request('semester_id') == $sem->id ? 'selected' : '' }}>{{ $sem->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Subject</label>
                <select name="subject_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">All Subjects</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Student</label>
                <select name="student_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">All Students</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>{{ $student->user->name ?? '' }} ({{ $student->enrollment_no }})</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">Filter</button>
                <a href="{{ route('admin.results.index') }}" class="ml-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">Clear</a>
            </div>
        </form>
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Exam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Internal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">External</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($results as $result)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $result->student->user->name ?? '—' }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $result->subject->name ?? '—' }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $result->exam->name ?? '—' }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $result->internal_marks }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $result->external_marks }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $result->total_marks }}</td>
                <td class="px-6 py-4 text-sm">
                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">{{ $result->grade ?? 'N/A' }}</span>
                </td>
                <td class="px-6 py-4 text-sm flex gap-3">
                    <a href="{{ route('admin.results.edit', $result) }}" class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.results.destroy', $result) }}" method="POST" onsubmit="return confirm('Delete this result?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="9" class="px-6 py-4 text-center text-gray-500">No results found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
