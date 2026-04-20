@extends('layouts.app')

@section('title', 'Update Class')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-dashboard-header />
        <x-loader-component />

        <div class="p-6">
            <div class="mb-6">
                <x-buttons.blue-back-link>To classes</x-buttons.blue-back-link>
                <h1 class="text-xl font-extrabold text-primary">Edit Class - {{ $class->name }}</h1>
                <p class="text-slate-500 text-xs">Update class information and manage arms</p>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <form class="form space-y-6" method="POST" action="{{ route('classes.update', $class) }}">
                    @csrf
                    @method('PUT')
                    <x-classes.class-form-fields :classes="$classes" :class="$class" />
                    <x-classes.arm-form-fields :teachers="$teachers" :arms="$class->arms" />

                    <!-- Form Actions -->
                    <div class="flex gap-4 pt-6 border-t">
                        <button type="submit"
                            class="bg-accent text-white px-6 py-2.5 rounded-lg text-xs font-semibold hover:bg-blue-600 transition-all flex items-center gap-2">
                            <i class="fas fa-save"></i> Update Class
                        </button>
                        <a href="dashboard-classes.html"
                            class="bg-slate-200 text-slate-700 px-6 py-2.5 rounded-lg text-xs font-semibold hover:bg-slate-300 transition-all">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/class-overider.js') }}"></script>
    <script src="{{ asset('/js/formSubmitter.js') }}"></script>
@endsection
