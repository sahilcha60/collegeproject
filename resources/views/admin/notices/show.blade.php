@extends('admin.layouts.master')
@section('header_title', 'View Notice')
@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h3 class="text-2xl font-semibold text-gray-700">{{ $notice->title }}</h3>
            <div class="mt-2 flex items-center gap-4 text-sm text-gray-500">
                <span>Target: 
                    <span class="px-2 py-1 rounded-full text-xs font-medium 
                        @if($notice->target == 'student') bg-blue-100 text-blue-700
                        @elseif($notice->target == 'teacher') bg-green-100 text-green-700
                        @else bg-purple-100 text-purple-700 @endif">
                        {{ ucfirst($notice->target) }}
                    </span>
                </span>
                <span>Published: {{ $notice->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.notices.edit', $notice) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition">Edit</a>
            <a href="{{ route('admin.notices.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">Back</a>
        </div>
    </div>
    
    <div class="border-t pt-6">
        <div class="prose max-w-none">
            {!! nl2br(e($notice->content)) !!}
        </div>
    </div>
</div>
@endsection