@extends('layouts.app')

@section('title', 'Update Level')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0  overflow-y-auto">
        <x-dashboard-header />
        <div class="flex-1 overflow-y-auto">
            <div class="p-4 md:p-8">
                <x-loader-component />

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                    <div>
                        <h1 class="text-xl font-extrabold text-primary">Update Level</h1>
                        <p class="text-slate-500 text-xs">Update exist Level.</p>
                    </div>
                    <x-buttons.gray-back-to-list />
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center gap-2 mb-6">
                        <i class="fas fa-edit text-accent text-lg"></i>
                        <h2 class="text-primary font-semibold">Update Level For</h2>
                    </div>

                    <form class="form space-y-6"
                        action="{{ route('programs.levels.update', ['program' => $program, 'level' => $level]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        @include('academic.levels.partials.form-fields', [
                            'program' => $program,
                            'level' => $level,
                        ])
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('/js/formSubmitter.js') }}"></script>

@endsection
