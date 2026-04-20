@extends('layouts.app')

@section('title', 'Students')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-loader-component />

        <div data-live-search data-search-url="{{ route('students.index') }}" data-search-delay="300">
            <!-- Header -->
            <x-dashboard-header>

                <div class="flex items-center gap-3 flex-grow max-w-lg">
                    <div class="relative w-full">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input data-search-input type="text" placeholder="Search students..."
                            class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-8 pr-3 text-xs focus:ring-2 focus:ring-accent outline-none">
                    </div>
                </div>
            </x-dashboard-header>

            <div class="p-4 md:p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                    <div>
                        <h1 class="text-xl font-extrabold text-primary">Student Records</h1>
                        <p class="text-slate-500 text-xs">Manage all registered students in the system.</p>
                    </div>
                    <a href="{{ route('students.create') }}">
                        <button
                            class="bg-accent text-white px-3 py-1.5 rounded-lg text-xs font-semibold shadow-md hover:bg-blue-600 transition-all flex items-center gap-1.5">
                            <i class="fas fa-plus"></i>
                            <span>Register Student</span>
                        </button>
                    </a>
                </div>

                <!-- Filter Bar -->
                <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm flex flex-wrap gap-3 mb-6">
                    <select class="bg-slate-100 border-none rounded-lg py-1.5 px-3 text-xs outline-none">
                        <option>Select Class</option>
                        <option>JSS 1</option>
                        <option>SS 3</option>
                    </select>
                    <select class="bg-slate-100 border-none rounded-lg py-1.5 px-3 text-xs outline-none">
                        <option>Select Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                    <button
                        class="bg-slate-200 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-slate-300 transition-all">Filter
                        Results</button>
                </div>

                <!-- Table -->
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-slate-500 uppercase text-[9px] font-bold tracking-wider">
                                <tr>
                                    <th class="px-4 py-3">Adm. No.</th>
                                    <th class="px-4 py-3">Full Name</th>
                                    <th class="px-4 py-3">Class</th>
                                    <th class="px-4 py-3">Gender</th>
                                    <th class="px-4 py-3">Guardian</th>
                                    <th class="px-4 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y" data-search-results>
                                @include('users.students.partials.rows', ['students' => $students])
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-center mt-4" data-search-pagination>
                    @include('users.students.partials.pagination', ['students' => $students])
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/live-search.js') }}"></script>

@endsection
