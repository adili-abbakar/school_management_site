@extends('layouts.app')

@section('title', 'Update Numbering Setting')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 overflow-y-auto">

        <x-dashboard-header />

        <div class="p-4 md:p-6">

            <x-loader-component />

            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                <div>
                    <h1 class="text-xl font-extrabold text-primary">Update Numbering Pattern</h1>
                    <p class="text-slate-500 text-xs">Define how system numbers like admission and staff IDs are generated.
                    </p>
                </div>

                <x-buttons.gray-back-to-list />
            </div>

            <!-- Form -->
            <form action="{{ route('numbering-settings.update', $setting) }}" method="POST"
                class="form bg-white rounded-xl border border-slate-100 shadow-sm p-4 md:p-6">
                @csrf
                @method('PUT')

                @include('numbering-settings.partials.form-feilds', ['setting' => $setting])

                <!-- Buttons -->
                <div class="flex flex-wrap gap-3 pt-6 border-t border-slate-100">
                    <button type="submit"
                        class="bg-accent text-white px-5 py-2 rounded-lg text-xs font-semibold hover:bg-blue-600 transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>Update Pattern</span>
                    </button>

                    <button type="reset"
                        class="bg-slate-200 text-slate-700 px-5 py-2 rounded-lg text-xs font-semibold hover:bg-slate-300 transition-all flex items-center gap-2">
                        <i class="fas fa-redo"></i>
                        <span>Reset Form</span>
                    </button>

                    <x-buttons.gray-cancel />
                </div>

            </form>
        </div>
    </main>

    <script src="{{ asset('/js/formSubmitter.js') }}"></script>

@endsection
