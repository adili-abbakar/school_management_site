@extends('layouts.app')

@section('title', 'Create Term')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-dashboard-header />
        <div class="flex-1 overflow-y-auto">
            <div class="p-4 md:p-8">
                <x-loader-component />

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                    <div>
                        <h1 class="text-xl font-extrabold text-primary">Create New Term</h1>
                        <p class="text-slate-500 text-xs">Add a new term to the school database.</p>
                    </div>
                    <x-buttons.gray-back-to-list />
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center gap-2 mb-6">
                        <i class="fas fa-plus-circle text-accent text-lg"></i>
                        <h2 class="text-primary font-semibold">New Term For</h2>
                    </div>

                    <form  class="form space-y-6" action="{{ route('terms.store', $session->id) }}" method="POST">
                        @csrf
                        <x-terms.form-fields :session="$session" />
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('/js/formSubmitter.js') }}"></script>

@endsection