@extends('layouts.app')

@section('title', 'Create Class')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0  overflow-y-auto">
        <x-dashboard-header />
        <x-loader-component />


        <div class="p-6">
            <div class="mb-6">
                <x-buttons.blue-back-link>To classes</x-buttons.blue-back-link>
                <h1 class="text-xl font-extrabold text-primary">Create New Class</h1>
                <p class="text-slate-500 text-xs">Add a new class with multiple arms to the system</p>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <form class="form space-y-6" action="{{ route('classes.store') }}" method="POST">
                    @csrf


                    @include('academic.classes.partials.class-form-fields', [
                        'classes' => $classes ?? null,
                    ])
                    @include('academic.classes.partials.arm-form-fields', [
                        'teachers' => $teachers ?? null,
                    ])

                    <!-- Form Actions -->
                    <div class="flex gap-4 pt-6 border-t border-slate-200">
                        <button type="submit"
                            class="bg-accent text-white px-6 py-2.5 rounded-lg text-xs font-semibold hover:bg-blue-600 transition-all flex items-center gap-2">
                            <i class="fas fa-save"></i> Create Class
                        </button>
                        <x-buttons.gray-cancel />
                    </div>
                </form>
            </div>
        </div>
        </div>
    </main>

    <script src="{{ asset('js/class-overider.js') }}"></script>
    <script src="{{ asset('/js/formSubmitter.js') }}"></script>
@endsection
