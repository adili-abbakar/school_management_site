@extends('layouts.app')

@section('title', 'Acadeimc Sessions')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-dashboard-header />
        <x-loader-component />

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
                <div class="space-y-4">
                    @forelse ($sessions as $session)
                        <div class="session-card bg-white rounded-lg border border-slate-200 p-6 hover:shadow-lg">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                                <div>
                                    <h2 class="text-primary font-semibold text-lg mb-1">Academic Session
                                        {{ $session->name }}</h2>
                                    <div class="flex flex-col md:flex-row gap-4 text-xs text-muted mt-2">
                                        <div class="flex items-center gap-1.5">
                                            <i class="fas fa-calendar text-accent"></i>
                                            <span>Starts: <strong>{{ $session->startDate() }}</strong></span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <i class="fas fa-calendar text-accent"></i>
                                            <span>Ends: <strong>{{ $session->endDate() }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-2 flex-wrap">
                                    <a href="{{ route('sessions.terms.create', $session) }}"
                                        class="flex items-center gap-1 px-3 py-1 bg-green-100 text-green-600 rounded text-xs hover:bg-greeb-100 transition-colors">
                                        <i class="fas fa-add"></i>
                                        <span>Add Term</span>
                                    </a>
                                    <a href="{{ route('sessions.edit', $session) }}"
                                        class="flex items-center gap-1 px-3 py-1 bg-blue-50 text-accent rounded text-xs hover:bg-blue-100 transition-colors">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                    <a href="{{ route('sessions.delete', $session) }}"
                                        class="flex items-center gap-1 px-3 py-1 bg-red-50 text-red-600 rounded text-xs hover:bg-red-100 transition-colors">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Terms -->
                            <div class="border-t border-slate-200 pt-4">
                                <h3 class="text-sm font-semibold text-slate-700 mb-4">Terms</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                                    @forelse ($session->terms as $term)
                                        <div
                                            @if ($term->activity === 'active') class="bg-gradient-to-br  from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-200"
                                                @elseif ($term->activity === 'upcoming')
                                                class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 border border-purple-200"
                                              @else
                                                  class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 border border-green-200" @endif>
                                            <div class="flex items-start justify-between mb-2">
                                                <h4 class="text-primary font-semibold text-sm">{{ $term->name }}</h4>
                                                <span
                                                    class="bg-blue-200 text-primary px-2 py-0.5 rounded text-xs font-semibold">{{ ucwords($term->activity) }}</span>
                                            </div>
                                            <div class="space-y-2 text-xs text-slate-700">
                                                <div class="flex items-center gap-2">
                                                    <i class="fas fa-play text-green-600"></i>
                                                    <span>Start: <strong>{{ $term->startDate() }}</strong></span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <i class="fas fa-stop text-red-600"></i>
                                                    <span>End: <strong>{{ $term->endDate() }}</strong></span>
                                                </div>
                                            </div>
                                            <div class="mt-3 flex gap-2">
                                                <a href="{{ route('sessions.terms.edit', [$session, $term]) }}"
                                                    class="flex-1 text-center px-2 py-1 bg-white text-accent rounded text-xs hover:bg-slate-50 transition-colors border border-accent">
                                                    Edit
                                                </a>
                                                <a href="{{ route('sessions.terms.delete', [$session, $term]) }}"
                                                    class="flex-1 text-center px-2 py-1 bg-white text-red-600 rounded text-xs hover:bg-slate-50 transition-colors border border-red-200">
                                                    Delete
                                                </a>
                                            </div>
                                            <div class="mt-3 flex gap-2">
                                                @if ($term->activity !== 'active')
                                                    <form method="POST" action="{{ route('terms.set-active', $term) }}"
                                                        class="form flex-1 flex">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="flex-1 text-center px-2 py-1 bg-white text-green-600 rounded text-xs hover:bg-slate-50 transition-colors border border-green-400">
                                                            Set Active
                                                        </button>
                                                    </form>
                                                @endif
                                                @if ($term->activity !== 'completed')
                                                    <form method="POST" action="{{ route('terms.set-completed', $term) }}"
                                                        class="form flex-1 flex">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="flex-1 text-center px-2 py-1 bg-white text-accent rounded text-xs hover:bg-slate-50 transition-colors border border-accent">
                                                            Set Completed
                                                        </button>
                                                    </form>
                                                @endif
                                                @if ($term->activity !== 'upcoming')
                                                    <form method="POST" action="{{ route('terms.set-upcoming', $term) }}"
                                                        class=" form flex-1 flex">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="flex-1 text-center px-2 py-1 bg-white text-purple-600 rounded text-xs hover:bg-slate-50 transition-colors border border-purple-400">
                                                            Set Upcoming
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <div
                                            class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg p-4 text-center text-sm">
                                            No term exist been created for this session yet.
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg p-4 text-center text-sm">
                            No academic sessions have been created yet.
                        </div>
                    @endforelse
                </div>


            </div>
        </div>

    </main>
    <script src="{{ asset('js/formSubmitter.js') }}"></script>

@endsection
