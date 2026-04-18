@extends('layouts.app')

@section('title', 'Admission Applications')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-dashboard-header>
            <div class="flex items-center gap-4 flex-grow max-w-xl">
                <div class="relative w-full">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Search application..."
                        class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-accent outline-none">
                </div>
            </div>
        </x-dashboard-header>


        <div class="p-6">
            <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-xl font-extrabold text-primary tracking-tight">Admission Applications</h1>
                    <p class="text-slate-500 text-sm">Review and manage incoming student applications for the current
                        session.</p>
                </div>
                <div class="flex gap-2 bg-white border border-slate-200 p-1 rounded-xl shadow-sm" id="statusTabs">
                    <button onclick="filterApplications('all', this)"
                        class="status-btn active bg-primary text-white px-4 py-1.5 rounded-lg text-xs font-bold transition-all duration-200">
                        All ({{ count($applications) }})
                    </button>

                    <button onclick="filterApplications('pending', this)"
                        class="status-btn text-slate-500 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-slate-50 transition-all duration-200">
                        Pending ({{ $pending_coutn }})
                    </button>

                    <button onclick="filterApplications('approved', this)"
                        class="status-btn text-slate-500 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-slate-50 transition-all duration-200">
                        Approved ({{ $approved_coutn }})
                    </button>

                    <button onclick="filterApplications('rejected', this)"
                        class="status-btn text-slate-500 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-slate-50 transition-all duration-200">
                        Rejected ({{ $rejected_coutn }})
                    </button>

                    <button onclick="filterApplications('withdrawn', this)"
                        class="status-btn text-slate-500 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-slate-50 transition-all duration-200">
                        Withdrawn ({{ $withdrawn_coutn }})
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4">
                @forelse ($applications as $app)
                    <div data-status="{{ $app->status }}"
                        class="admission-applications bg-white rounded-lg border border-slate-100 p-4 shadow-sm hover:shadow-md transition-all border-l-4
                         @switch($app->status)
                                @case('pending')
                                    {{ 'border-l-amber-400' }}
                                @break
                                @case('approved')
                                    {{ 'border-l-green-400' }}
                                @break
                                @case('withdrwan')
                                    {{ 'border-l-gray-400' }}
                                @break
                                @case('rejected')
                                    {{ 'border-l-red-400' }}
                                @break                                                  
                        @endswitch
                        ">
                        <div class="flex flex-col lg:flex-row justify-between gap-4">
                            <div class="flex gap-3">
                                <div
                                    class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400 text-sm font-bold">
                                    SB
                                </div>

                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h3 class="text-sm font-bold text-primary mb-0.5">
                                            {{ $app->student_name }}
                                        </h3>
                                        <span
                                            @switch($app->status) 
                                        @case('pending')
                                         class="status-badge status-pending"
                                         @break
                                         @case('approved')
                                         class="status-badge status-approved"
                                         @break
                                          @case('rejected')
                                         class="status-badge status-rejected"
                                         @break
                                        @endswitch>
                                            @switch($app->status)
                                                @case('pending')
                                                    <i class="fas fa-clock "></i>
                                                @break

                                                @case('approved')
                                                    <i class="fas fa-check-circle"></i>
                                                @break

                                                @case('rejected')
                                                    <i class="fas fa-times-circle"></i>
                                                @break

                                                @case('withdrawn')
                                                    <i class="fas fa-minus-circle"></i>
                                                @break
                                            @endswitch
                                            {{ ucwords($app->status) }}
                                        </span>
                                    </div>
                                    <div class="flex flex-wrap gap-y-1 gap-x-4 text-xs text-slate-500">
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-school text-accent"></i> {{ $app->class->name }}
                                        </span>

                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-calendar-alt text-accent"></i>
                                            {{ $app->session->name }} Session
                                        </span>

                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-clock text-accent"></i>
                                            Applied {{ $app->created_at->diffForHumans() }}
                                        </span>

                                        <span class="flex items-center gap-1">
                                            @switch($app->status)
                                                @case('pending')
                                                    <i class="fas fa-clock amber-400"></i>
                                                @break

                                                @case('approved')
                                                    <i class="fas fa-check-circle text-green-600"></i>
                                                @break

                                                @case('rejected')
                                                    <i class="fas fa-times-circle text-red-600"></i>
                                                @break

                                                @case('withdrawn')
                                                    <i class="fas fa-minus-circle text-gray-500"></i>
                                                @break
                                            @endswitch

                                            {{ Ucwords($app->status) }}
                                        </span>

                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('applications.show', $app) }}">
                                    <button
                                        class="bg-slate-100 text-slate-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-slate-200 transition-all flex items-center gap-1">
                                        <i class="fas fa-eye"></i>
                                        <span>View</span>
                                    </button>
                                </a>

                                @if ($app->status === 'pending')
                                    <form method="POST" action="{{ route('applications.reject', $app) }}">
                                        @csrf
                                        @method('PUT')
                                        <x-loader-component />
                                        <button onclick="showLoader()" type="submit"
                                            class="bg-rose-50 text-rose-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-rose-100 transition-all border border-rose-100 flex items-center gap-1">
                                            <i class="fas fa-times"></i>
                                            Reject
                                        </button>
                                    </form>
                                @endif

                                @if ($app->status === 'pending' || $app->status === 'rejected')
                                    <form method="POST" action="{{ route('applications.approve', $app) }}">
                                        @csrf
                                        @method('PUT')
                                        <x-loader-component />

                                        <button onclick="showLoader()" type="submit"
                                            class="px-4 py-1.5 rounded-lg text-xs font-semibold transition-all flex items-center gap-1 border
            {{ $app->status === 'rejected'
                ? 'bg-amber-50 text-amber-600 border-amber-100 hover:bg-amber-100'
                : 'bg-emerald-50 text-emerald-600  hover:bg-emerald-100' }}">

                                            <i class="fas {{ $app->status === 'rejected' ? 'fa-redo' : 'fa-check' }}"></i>

                                            {{ $app->status === 'rejected' ? 'Reconsider & Approve' : 'Approve' }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg p-4 text-center text-sm">
                            No admission applications have been submitted yet.
                        </div>
                    @endforelse
                    <div id="emptyState"
                        class="hidden bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg p-4 text-center text-sm">
                    </div>
                </div>
            </div>
        </main>


        <script>
            function filterApplications(status, button) {

                document.querySelectorAll('.status-btn').forEach(btn => {
                    btn.classList.remove('bg-primary', 'text-white');
                    btn.classList.add('text-slate-500');
                });

                button.classList.remove('text-slate-500');
                button.classList.add('bg-primary', 'text-white');

                let visibleCount = 0;

                document.querySelectorAll('.admission-applications').forEach(el => {

                    const itemStatus = el.dataset.status;

                    if (status === 'all' || itemStatus === status) {
                        el.classList.remove('hidden');
                        el.classList.add('fade-in');
                        visibleCount++;
                    } else {
                        el.classList.add('hidden');
                    }

                });

                const emptyState = document.getElementById('emptyState');

                if (visibleCount === 0) {
                    emptyState.classList.remove('hidden');

                    emptyState.textContent =
                        status === 'all' ?
                        'No admission applications found.' :
                        `No ${status} admission applications found.`;

                } else {
                    emptyState.classList.add('hidden');
                }
            }
        </script>

    @endsection
