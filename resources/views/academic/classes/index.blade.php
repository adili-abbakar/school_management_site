@extends('layouts.app')

@section('title', 'Class management')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
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
