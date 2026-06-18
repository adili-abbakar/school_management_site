@extends('layouts.app')

@section('title', 'Admission Applications')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0  overflow-y-auto">
        <x-loader-component />
        <div data-live-search data-search-url="{{ route('applications.index') }}" data-search-delay="300">
            <x-dashboard-header>
                <div class="flex items-center gap-4 flex-grow max-w-xl">
                    <div class="relative w-full">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input data-search-input type="text" placeholder="Search application..."
                            class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-accent outline-none">
                    </div>
                </div>
            </x-dashboard-header>
            @if (session('failure'))
                {{ session('failure') }}
            @endif
            <div class="p-6">
                <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-xl font-extrabold text-primary tracking-tight">Admission Applications</h1>
                        <p class="text-slate-500 text-sm">
                            Review and manage incoming student applications for the current session.
                        </p>
                    </div>

                    <div id="statusTabs"
                        class="w-full sm:w-auto grid grid-cols-2 sm:flex gap-2 bg-white border border-slate-200 p-2 rounded-xl shadow-sm">
                        <button onclick="filterItem('all', this)"
                            class="status-btn active bg-primary text-white px-3 py-2 rounded-lg text-xs font-bold transition-all duration-200 text-center">
                            All ({{ count($applications) }})
                        </button>

                        <button onclick="filterItem('pending', this)"
                            class="status-btn text-slate-500 px-3 py-2 rounded-lg text-xs font-bold hover:bg-slate-50 transition-all duration-200 text-center">
                            Pending ({{ $pending_coutn }})
                        </button>

                        <button onclick="filterItem('approved', this)"
                            class="status-btn text-slate-500 px-3 py-2 rounded-lg text-xs font-bold hover:bg-slate-50 transition-all duration-200 text-center">
                            Approved ({{ $approved_coutn }})
                        </button>

                        <button onclick="filterItem('rejected', this)"
                            class="status-btn text-slate-500 px-3 py-2 rounded-lg text-xs font-bold hover:bg-slate-50 transition-all duration-200 text-center">
                            Rejected ({{ $rejected_coutn }})
                        </button>

                        <button onclick="filterItem('withdrawn', this)"
                            class="status-btn text-slate-500 px-3 py-2 rounded-lg text-xs font-bold hover:bg-slate-50 transition-all duration-200 text-center col-span-2 sm:col-span-1">
                            Withdrawn ({{ $withdrawn_coutn }})
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4" data-search-results>
                    @include('application.partials.rows', ['applications' => $applications])
                </div>

                <div class="flex justify-center mt-4" data-search-pagination>
                    @include('application.partials.pagination', ['applications' => $applications])

                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/live-search.js') }}"></script>
    <script src="{{ asset('js/filterItem.js') }}"></script>
@endsection
