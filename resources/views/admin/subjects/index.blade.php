@extends('admin.layouts.master')
@section('header_title', 'Subjects')
@section('content')
@include('admin.layouts.partials.alerts')
<div class="bg-white rounded-lg shadow">
    <div class="flex justify-between items-center px-6 py-4 border-b">
        <h3 class="text-lg font-semibold text-gray-700">All Subjects</h3>
        <a href="{{ route('admin.subjects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">+ Add Subject</a>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Department</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Semester</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Credits</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($subjects as $subject)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 text-sm font-mono text-blue-600">{{ $subject->code }}</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $subject->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $subject->department->name ?? '—' }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $subject->semester->name ?? '—' }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $subject->credits }}</td>
                <td class="px-6 py-4 text-sm flex gap-3">
                    <a href="{{ route('admin.subjects.edit', $subject) }}" class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" onsubmit="return confirm('Delete this subject?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">No subjects found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
