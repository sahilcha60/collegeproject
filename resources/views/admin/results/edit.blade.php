@extends('admin.layouts.master')
@section('header_title', 'Edit Result')
@section('content')
<div class="max-w-lg mx-auto bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-6">Edit Result</h3>
    @include('admin.layouts.partials.alerts')
    <form action="{{ route('admin.results.update', $result) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Student</label>
            <select name="student_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select Student --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id', $result->student_id) == $student->id ? 'selected' : '' }}>{{ $student->user->name ?? '' }} ({{ $student->enrollment_no }})</option>
                @endforeach
            </select>
            @error('student_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
            <select name="subject_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select Subject --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id', $result->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
            <select name="semester_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select Semester --</option>
                @foreach($semesters as $sem)
                    <option value="{{ $sem->id }}" {{ old('semester_id', $result->semester_id) == $sem->id ? 'selected' : '' }}>{{ $sem->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Exam</label>
            <select name="exam_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select Exam --</option>
                @foreach($exams as $exam)
                    <option value="{{ $exam->id }}" {{ old('exam_id', $result->exam_id) == $exam->id ? 'selected' : '' }}>{{ $exam->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Internal Marks</label>
                <input type="number" name="internal_marks" value="{{ old('internal_marks', $result->internal_marks) }}" min="0" max="100"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">External Marks</label>
                <input type="number" name="external_marks" value="{{ old('external_marks', $result->external_marks) }}" min="0" max="100"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Total Marks</label>
                <input type="number" name="total_marks" value="{{ old('total_marks', $result->total_marks) }}" min="0" max="200"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Grade</label>
                <input type="text" name="grade" value="{{ old('grade', $result->grade) }}" placeholder="A, B, C..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">Update</button>
            <a href="{{ route('admin.results.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
