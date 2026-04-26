@extends('layouts.app')

@section('title', 'Students')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 overflow-y-auto">
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
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-wrap items-end gap-4 mb-6">

                    <!-- Class Filter -->
                    <div class="flex flex-col min-w-[160px]">
                        <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wide mb-1">
                            Class
                        </label>
                        <select name="class_arm_id" data-search-filter
                            class="bg-slate-100 border border-slate-200 rounded-lg py-2 px-3 text-xs outline-none focus:ring-2 focus:ring-accent focus:bg-white transition">
                            <option value="">All Classes</option>
                            @forelse ($classes as $class)
                                @foreach ($class->arms as $arm)
                                    <option value="{{ $arm->id }}">
                                        {{ $class->name }} {{ $arm->name }}
                                    </option>
                                @endforeach
                            @empty
                                <option value="">No Classes found</option>
                            @endforelse
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div class="flex flex-col min-w-[140px]">
                        <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wide mb-1">
                            Status
                        </label>
                        <select name="status" data-search-filter
                            class="bg-slate-100 border border-slate-200 rounded-lg py-2 px-3 text-xs outline-none focus:ring-2 focus:ring-accent focus:bg-white transition">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="graduated">Graduated</option>
                            <option value="withdrawn">Withdrawn</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>

                    <!-- Filter Button -->
                    <div class="flex items-end">
                        <button type="button" data-search-filter-button
                            class="bg-accent text-white px-4 py-2 rounded-lg text-xs font-semibold shadow-sm hover:bg-blue-600 transition flex items-center gap-1.5">
                            <i class="fas fa-filter text-[10px]"></i>
                            <span>Apply</span>
                        </button>
                    </div>

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
