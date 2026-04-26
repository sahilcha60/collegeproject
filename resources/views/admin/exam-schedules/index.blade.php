@extends('admin.layouts.master')
@section('header_title', 'Exam Schedules')
@section('content')
@include('admin.layouts.partials.alerts')
<div class="bg-white rounded-lg shadow">
    <div class="flex justify-between items-center px-6 py-4 border-b">
        <h3 class="text-lg font-semibold text-gray-700">All Exam Schedules</h3>
        <a href="{{ route('admin.exam-schedules.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">+ Add Schedule</a>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Exam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($schedules as $schedule)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $schedule->exam->name ?? '—' }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $schedule->subject->name ?? '—' }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($schedule->exam_date)->format('d M Y') }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $schedule->start_time }} – {{ $schedule->end_time }}</td>
                <td class="px-6 py-4 text-sm flex gap-3">
                    <a href="{{ route('admin.exam-schedules.edit', $schedule) }}" class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.exam-schedules.destroy', $schedule) }}" method="POST" onsubmit="return confirm('Delete this schedule?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">No schedules found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
