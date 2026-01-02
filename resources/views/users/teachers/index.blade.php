@extends('layouts.app')

@section('title', 'Academic Staffs')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-dashboard-header>
            <div class="flex items-center gap-4 flex-grow max-w-xl">
                <div class="relative w-full">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Search staff..."
                        class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-accent outline-none">
                </div>
            </div>
        </x-dashboard-header>

        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-xl font-extrabold text-primary">Academic Staff</h1>
                    <p class="text-slate-500 text-xs">Manage teachers and faculty members.</p>
                </div>
                <a href="{{ route('teachers.create') }}">
                    <button
                        class="bg-accent text-white px-4 py-2 rounded-lg text-xs font-semibold shadow hover:bg-blue-600 transition-all flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        <span>Add New Teacher</span>
                    </button>
                </a>
            </div>

            <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Staff ID</th>
                                <th class="px-6 py-4">Name</th>
                                <th class="px-6 py-4">Subject</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-400 uppercase">TCH001</td>
                                <td class="px-6 py-4 font-semibold text-primary">Prof. Alan Turing</td>
                                <td class="px-6 py-4 text-slate-600">Mathematics</td>
                                <td class="px-6 py-4 text-slate-500">alan@edupro.ac</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <button class="text-blue-500"><i class="fas fa-edit"></i></button>
                                        <button class="text-rose-500"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
