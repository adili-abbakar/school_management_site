@extends('layouts.app')

@section('title', 'Acadeimc Sessions')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0  overflow-y-auto">
        <x-loader-component />

        <div data-live-search data-search-url="{{ route('sessions.index') }}" data-search-delay="300">
            <x-dashboard-header>
                <div class="flex items-center gap-4 flex-grow max-w-xl">
                    <div class="relative w-full">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input data-search-input type="text" placeholder="Search sessions..."
                            class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-accent outline-none">
                    </div>
                </div>
            </x-dashboard-header>

            <div class="flex-1 overflow-y-auto">
                <div class="p-4 md:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h1 class="text-xl font-extrabold text-primary">Academic Sessions & Terms</h1>
                            <p class="text-slate-500 text-xs">Manage terms and sessions and thier transitions.</p>
                        </div>
                        <a href="{{ route('sessions.create') }}">
                            <button
                                class="bg-accent text-white px-4 py-2 rounded-lg text-xs font-semibold shadow hover:bg-blue-600 transition-all flex items-center gap-2">
                                <i class="fas fa-plus"></i>
                                <span>Create New Session</span>
                            </button>
                        </a>
                    </div>

                    <!-- Sessions Grid -->
                    <div class="space-y-4" data-search-results>
                        @include('academic.sessions.partials.rows', ['sessions' => $sessions])
                    </div>
                    <div class="flex justify-center mt-4" data-search-pagination>
                        @include('academic.sessions.partials.pagination', ['sessions' => $sessions])
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/formSubmitter.js') }}"></script>
    <script src="{{ asset('js/live-search.js') }}"></script>

@endsection
