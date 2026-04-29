@extends('layouts.app')

@section('title', 'Guardians')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0  overflow-y-auto hide-scrollbar">
        <x-loader-component />

        <div data-live-search data-search-url="{{ route('guardians.index') }}" data-search-delay="300">
            <x-dashboard-header>
                <div class="flex items-center gap-4 flex-grow max-w-xl">
                    <div class="relative w-full">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input data-search-input type="text" placeholder="Search guardians..."
                            class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-accent outline-none">
                    </div>
                </div>
            </x-dashboard-header>

            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-xl font-extrabold text-primary">Guardians</h1>
                        <p class="text-slate-500 text-xs">Manage parent and guardian records linked to students.</p>
                    </div>

                    <a href="{{ route('guardians.create') }}">
                        <button
                            class="bg-accent text-white px-4 py-2 rounded-lg text-xs font-semibold shadow hover:bg-blue-600 transition-all flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            <span>Add New Guardian</span>
                        </button>
                    </a>
                </div>

                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] font-bold tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Name</th>
                                    {{-- <th class="px-6 py-4">Relationship</th> --}}
                                    <th class="px-6 py-4">Phone</th>
                                    <th class="px-6 py-4">Children</th>
                                    <th class="px-6 py-4 text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y" data-search-results>
                                @include('users.guardians.partials.rows', ['guardians' => $guardians])
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-center mt-4" data-search-pagination>
                    @include('users.guardians.partials.pagination', [
                        'guardians' => $guardians,
                    ])
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/live-search.js') }}"></script>
@endsection
