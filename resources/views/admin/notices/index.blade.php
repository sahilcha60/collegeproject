@extends('admin.layouts.master')
@section('header_title', 'Notices')
@section('content')
@include('admin.layouts.partials.alerts')
<div class="bg-white rounded-lg shadow">
    <div class="flex justify-between items-center px-6 py-4 border-b">
        <h3 class="text-lg font-semibold text-gray-700">All Notices</h3>
        <a href="{{ route('admin.notices.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">+ Publish Notice</a>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Published</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($notices as $notice)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $notice->title }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $notice->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4 text-sm flex gap-3">
                    <a href="{{ route('admin.notices.edit', $notice) }}" class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.notices.destroy', $notice) }}" method="POST" onsubmit="return confirm('Delete this notice?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">No notices found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
