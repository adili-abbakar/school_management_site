@extends('layouts.app')

@section('title', 'Create Teacher')

@section('page-content')
  <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
    <x-dashboard-header />


    <div class="p-4 md:p-6">
      <x-loader-component />

      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
        <div>
          <h1 class="text-xl font-extrabold text-primary">Create New Teacher</h1>
          <p class="text-slate-500 text-xs">Add a new teaching staff member to the system.</p>
        </div>
        <a href="{{ url()->previous() }}"
          class="bg-slate-200 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-semibold shadow-md hover:bg-slate-300 transition-all flex items-center gap-1.5">
          <i class="fas fa-arrow-left"></i>
          <span>Back to List</span>
        </a>
      </div>

      <!-- Responsive 2-3 column form grid for teacher creation -->
      <form  method="POST" action="{{ route('teachers.store') }}"
        class="form bg-white rounded-xl border border-slate-100 shadow-sm p-4 md:p-6">
        @csrf

        <x-users.teachers.form-fields />

        <div class="flex flex-wrap gap-3 pt-6 border-t border-slate-100">
          <button type="submit"
            class="bg-accent text-white px-5 py-2 rounded-lg text-xs font-semibold hover:bg-blue-600 transition-all flex items-center gap-2">
            <i class="fas fa-save"></i>
            <span>Create Teacher Account</span>
          </button>
          <button type="reset"
            class="bg-slate-200 text-slate-700 px-5 py-2 rounded-lg text-xs font-semibold hover:bg-slate-300 transition-all flex items-center gap-2">
            <i class="fas fa-redo"></i>
            <span>Reset Form</span>
          </button>
          <a href="dashboard-teachers.html"
            class="bg-slate-100 text-slate-600 px-5 py-2 rounded-lg text-xs font-semibold hover:bg-slate-200 transition-all flex items-center gap-2">
            <i class="fas fa-times"></i>
            <span>Cancel</span>
          </a>
        </div>
      </form>
    </div>
  </main>

  <script src="{{ asset('/js/formSubmitter.js') }}"></script>

@endsection
