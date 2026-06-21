@extends('layouts.app')

@section('title', 'Class management')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0  overflow-y-auto">
        <x-loader-component />
        <div data-live-search data-search-url="{{ route('classes.index') }}" data-search-delay="300">
            <x-dashboard-header>
                <div class="flex items-center gap-4 flex-grow max-w-xl">
                    <div class="relative w-full">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input data-search-input type="text" placeholder="Search classes..."
                            class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-accent outline-none">
                    </div>
                </div>
            </x-dashboard-header>


            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-xl font-extrabold text-primary">Class Management</h1>
                        <p class="text-slate-500 text-xs">Define classes, arms, and assign form teachers.</p>
                    </div>
                    <a href="{{ route('classes.create') }}"
                        class="bg-accent text-white px-4 py-2 rounded-lg text-xs font-semibold shadow hover:bg-blue-600 transition-all flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        <span>Add New Class</span>
                    </a>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-wrap items-end gap-4 mb-6">

                    <!-- Class Filter -->
                    <div class="flex flex-col min-w-[160px]">
                        <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wide mb-1">
                            Program
                        </label>
                        <select name="program_id" data-target="level_id" data-route="/programs/{id}/levels" id="program_id" data-search-filter
                            class="bg-slate-100 border border-slate-200 rounded-lg py-2 px-3 text-xs outline-none focus:ring-2 focus:ring-accent focus:bg-white transition">
                            <option value="{{ null }}">All Programs</option>
                            @forelse ($programs as $program)
                                <option value="{{ $program->id }}">
                                    {{ $program->name }}
                                </option>
                            @empty
                                <option value="" selected disabled>No Programs found</option>
                            @endforelse
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div class="flex flex-col min-w-[140px]">
                        <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wide mb-1">
                            Level
                        </label>
                        <select name="class_level_id" data-search-filter id="level_id"
                            class="bg-slate-100 border border-slate-200 rounded-lg py-2 px-3 text-xs outline-none focus:ring-2 focus:ring-accent focus:bg-white transition disabled:cursor-not-allowed disabled:text-slate-400 disabled:bg-slate-50"
                            disabled>
                            <option value="">Select program first</option>
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

                <!-- Classes List with Collapsible Arms -->
                <div class="space-y-3 mb-8" data-search-results>
                    @include('academic.classes.partials.rows', ['classes' => $classes])
                </div>

                <div class="flex justify-center mt-4" data-search-pagination>
                    @include('academic.classes.partials.pagination', ['classes' => $classes])
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/live-search.js') }}"></script>
    <script src="{{ asset('js/auto-select.js') }}"></script>
    <script>
        function toggleArms(button) {
            const container = button.nextElementSibling;
            const icon = button.querySelector('i.fa-chevron-down');

            if (container.classList.contains('hidden')) {
                container.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                container.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>
@endsection
