@extends('layouts.app')

@section('title', 'Edit Admin')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0  overflow-y-auto">
        <x-dashboard-header />


        <div class="p-4 md:p-6">
            <x-loader-component />
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                <div>
                    <h1 class="text-xl font-extrabold text-primary">Edit Existing Admin</h1>
                    <p class="text-slate-500 text-xs">Edit exsiting administrative user to the system.</p>
                </div>
                <x-buttons.gray-back-to-list />
            </div>

            <form action="{{ route('admins.update', $admin->user_id) }}" method="POST"
                class="form bg-white rounded-xl border border-slate-100 shadow-sm p-4 md:p-6">
                @csrf
                @method('PUT')

                @include('users.admins.partials.form-fields', ['admin' => $admin ?? null])


                <div class="flex flex-wrap gap-3 pt-6 border-t border-slate-100">
                    <button type="submit"
                        class="bg-accent text-white px-5 py-2 rounded-lg text-xs font-semibold hover:bg-blue-600 transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>Update Admin Account</span>
                    </button>

                    <a href="{{ route('user.edit-password', $admin->user->id) }}"
                        class="bg-green-500 text-white px-5 py-2 rounded-lg text-xs font-semibold hover:bg-green-600 transition-all flex items-center gap-2">
                        <i class="fas fa-edit"></i>
                        <span>Edit Admin Password</span>

                    </a>
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
