@extends('layouts.app')

@section('title', 'Update Term')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0  overflow-y-auto">
        <x-dashboard-header />
        <div class="flex-1 overflow-y-auto">
            <div class="p-4 md:p-8">
                <x-loader-component />

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                    <div>
                        <h1 class="text-xl font-extrabold text-primary">Update Term</h1>
                        <p class="text-slate-500 text-xs">Update exist term.</p>
                    </div>
                    <x-buttons.gray-back-to-list />
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center gap-2 mb-6">
                        <i class="fas fa-plus-circle text-accent text-lg"></i>
                        <h2 class="text-primary font-semibold">Update Term For</h2>
                    </div>

                    <form class="form space-y-6"
                        action="{{ route('sessions.terms.update', ['session' => $session, 'term' => $term]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="session_start_date" value="{{ $session->start_date }}">
                        <input type="hidden" name="session_end_date" value="{{ $session->end_date }}">
                        @include('academic.terms.partials.form-fields', [
                            'session' => $session,
                            'term' => $term,
                        ])
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('/js/formSubmitter.js') }}"></script>

@endsection
