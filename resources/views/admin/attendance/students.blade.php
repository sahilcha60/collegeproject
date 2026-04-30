@extends('admin.layouts.master')

@section('header_title', 'Student Attendance')
@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Mark Student Attendance</h3>
            <p class="text-sm text-gray-500">Select a subject and date, then mark students present or absent.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.attendance.report') }}" class="text-blue-600 hover:underline">Attendance Report</a>
            <a href="{{ route('admin.attendance.teachers') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Teacher Attendance</a>
        </div>
    </div>

    @include('admin.layouts.partials.alerts')

    <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <p class="text-xs uppercase tracking-wide text-slate-500">Students loaded</p>
            <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $students->count() }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <p class="text-xs uppercase tracking-wide text-slate-500">Selected subject</p>
            <p class="mt-2 text-lg font-semibold text-slate-900">{{ $subjectId ? optional($subjects->firstWhere('id', $subjectId))->name : 'None' }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <p class="text-xs uppercase tracking-wide text-slate-500">Selected date</p>
            <p class="mt-2 text-lg font-semibold text-slate-900">{{ $date }}</p>
        </div>
    </div>

    <form action="{{ route('admin.attendance.students.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Subject</label>
                <select name="subject_id" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Select subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" @selected(old('subject_id', $subjectId) == $subject->id)>{{ $subject->name }}</option>
                    @endforeach
                </select>
                @error('subject_id')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" value="{{ old('date', $date) }}" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('date')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enrollment</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Present</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Absent</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($students as $student)
                    @php
                        $record = $attendanceMap[$student->id] ?? null;
                        $status = old('attendance.' . $student->id, $record?->status ?? 'absent');
                    @endphp
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-sm text-slate-700">{{ $student->user->name ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-700">{{ $student->enrollment_no }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <label class="inline-flex items-center gap-2">
                                <input type="radio" name="attendance[{{ $student->id }}]" value="present" @checked($status === 'present') class="text-blue-600 border-gray-300">
                                <span class="text-sm">Present</span>
                            </label>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <label class="inline-flex items-center gap-2">
                                <input type="radio" name="attendance[{{ $student->id }}]" value="absent" @checked($status === 'absent') class="text-blue-600 border-gray-300">
                                <span class="text-sm">Absent</span>
                            </label>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end pt-4 border-t">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Save Attendance</button>
        </div>
    </form>
</div>
@endsection
