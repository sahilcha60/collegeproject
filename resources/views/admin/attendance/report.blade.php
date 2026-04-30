@extends('admin.layouts.master')

@section('header_title', 'Attendance Report')
@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Attendance Report</h3>
            <p class="text-sm text-gray-500">View student attendance percentage by subject.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.attendance.students') }}" class="text-blue-600 hover:underline">Student Attendance</a>
            <a href="{{ route('admin.attendance.teachers') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Teacher Attendance</a>
        </div>
    </div>

    <form action="{{ route('admin.attendance.report') }}" method="GET" class="mb-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <p class="text-xs uppercase tracking-wide text-slate-500">Selected subject</p>
                <p class="mt-2 text-lg font-semibold text-slate-900">{{ $subjectId ? optional($subjects->firstWhere('id', $subjectId))->name : 'All subjects' }}</p>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Filter</button>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
                    <option value="">All subjects</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" @selected($subjectId == $subject->id)>{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Filter</button>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Present</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Percentage</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($rows as $index => $row)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm text-slate-700">{{ $users[$row['student_id']] ?? 'Unknown' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $row['subject_id'] ? optional($subjects->where('id', $row['subject_id'])->first())->name : 'All' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $row['present'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $row['total'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $row['percentage'] }}%</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">No attendance data available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
