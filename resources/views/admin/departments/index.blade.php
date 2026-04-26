@extends('admin.layouts.master')

@section('header_title', 'Departments')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-medium">Manage Departments</h3>
            <a href="{{ route('admin.departments.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Department
            </a>
        </div>
        <!-- Table Placeholder -->
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Loop through departments here -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" colspan="3">List of departments will appear here.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
