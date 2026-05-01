@extends('layouts.app')

@section('title', 'Guardians & Parents Form')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0  overflow-y-auto">
        <x-dashboard-header />

        <div class="p-4 md:p-6">
            <x-loader-component />

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                <div>
                    <h1 class="text-xl font-extrabold text-primary">Create New Guardian</h1>
                    <p class="text-slate-500 text-xs">Add a new guardian/parent to the system.</p>
                </div>
                <x-buttons.gray-back-to-list />
            </div>

            <!-- Responsive 2-3 column form grid for guardian creation -->
            <form class="form bg-white rounded-xl border border-slate-100 shadow-sm p-4 md:p-6" method="POST"
                action="{{ route('guardians.store') }}">

                @csrf
                @include('users.guardians.partials.form-fields')

                <div class="flex flex-wrap gap-3 pt-6 border-t border-slate-100">
                    <button type="submit"
                        class="bg-accent text-white px-5 py-2 rounded-lg text-xs font-semibold hover:bg-blue-600 transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>Create Guardian Account</span>
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
