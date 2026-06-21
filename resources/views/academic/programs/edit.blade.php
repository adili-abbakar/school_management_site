@extends('layouts.app')

@section('title', 'Update Program')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0  overflow-y-auto">
        <x-dashboard-header />
        <div class="flex-1 overflow-y-auto">
            <div class="p-4 md:p-8">
                <x-loader-component />

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                    <div>
                        <h1 class="text-xl font-extrabold text-primary">Update Program</h1>
                        <p class="text-slate-500 text-xs">Update existing academic program & its terms.</p>
                    </div>
                    <x-buttons.gray-back-to-list />

                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center gap-2 mb-6">
                        <i class="fas fa-plus-circle text-accent text-lg"></i>
                        <h2 class="text-primary font-semibold">Update Academic Program</h2>
                    </div>

                    <form class="form space-y-6" action="{{ route('programs.update', $program->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('academic.programs.partials.program-form-fields', ['program' => $program])
                        @include('academic.programs.partials.level-form-fields', [
                            'levels' => $program?->levels,
                        ])

                        <!-- Form Actions -->
                        <div class="flex gap-4 pt-6 border-t border-slate-200">
                            <x-buttons.transparent-cancel />
                            <x-buttons.light-blue-submit />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('/js/formSubmitter.js') }}"></script>

@endsection
