@extends('admin.layouts.master')
@section('header_title', 'Add Result')
@section('content')
<div class="max-w-lg mx-auto bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-6">Add Result</h3>
    @include('admin.layouts.partials.alerts')
    <form action="{{ route('admin.results.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Student</label>
            <select name="student_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select Student --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->user->name ?? '' }} ({{ $student->enrollment_no }})</option>
                @endforeach
            </select>
            @error('student_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
            <select name="subject_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select Subject --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
            @error('subject_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
            <select name="semester_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select Semester --</option>
                @foreach($semesters as $sem)
                    <option value="{{ $sem->id }}" {{ old('semester_id') == $sem->id ? 'selected' : '' }}>{{ $sem->name }}</option>
                @endforeach
            </select>
            @error('semester_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Exam</label>
            <select name="exam_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select Exam --</option>
                @foreach($exams as $exam)
                    <option value="{{ $exam->id }}" {{ old('exam_id') == $exam->id ? 'selected' : '' }}>{{ $exam->name }}</option>
                @endforeach
            </select>
            @error('exam_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Internal Marks</label>
                <input type="number" name="internal_marks" value="{{ old('internal_marks') }}" min="0" max="100"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                @error('internal_marks')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">External Marks</label>
                <input type="number" name="external_marks" value="{{ old('external_marks') }}" min="0" max="100"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                @error('external_marks')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Grade</label>
                <input type="text" name="grade" value="{{ old('grade') }}" placeholder="A, B, C..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                @error('grade')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">Add Result</button>
            <a href="{{ route('admin.results.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg transition">Cancel</a>
        </div>
    </form>
</div>
@endsection