@extends('layouts.app')

@section('title', 'Students')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <!-- Header -->
        <x-dashboard-header>

            <div class="flex items-center gap-3 flex-grow max-w-lg">
                <div class="relative w-full">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Search students..."
                        class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-8 pr-3 text-xs focus:ring-2 focus:ring-accent outline-none">
                </div>
            </div>
        </x-dashboard-header>

        <div class="p-4 md:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                <div>
                    <h1 class="text-xl font-extrabold text-primary">Student Records</h1>
                    <p class="text-slate-500 text-xs">Manage all registered students in the system.</p>
                </div>
                <a href="{{ route('students.create') }}">
                    <button
                        class="bg-accent text-white px-3 py-1.5 rounded-lg text-xs font-semibold shadow-md hover:bg-blue-600 transition-all flex items-center gap-1.5">
                        <i class="fas fa-plus"></i>
                        <span>Register Student</span>
                    </button>
                </a>
            </div>

            <!-- Filter Bar -->
            <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm flex flex-wrap gap-3 mb-6">
                <select class="bg-slate-100 border-none rounded-lg py-1.5 px-3 text-xs outline-none">
                    <option>Select Class</option>
                    <option>JSS 1</option>
                    <option>SS 3</option>
                </select>
                <select class="bg-slate-100 border-none rounded-lg py-1.5 px-3 text-xs outline-none">
                    <option>Select Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
                <button
                    class="bg-slate-200 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-slate-300 transition-all">Filter
                    Results</button>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-500 uppercase text-[9px] font-bold tracking-wider">
                            <tr>
                                <th class="px-4 py-3">Student ID</th>
                                <th class="px-4 py-3">Full Name</th>
                                <th class="px-4 py-3">Class</th>
                                <th class="px-4 py-3">Gender</th>
                                <th class="px-4 py-3">Guardian</th>
                                <th class="px-4 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3 font-bold text-slate-400 uppercase text-[9px]">STU001</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-7 h-7 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-[9px]">
                                            JD</div>
                                        <span class="font-semibold text-primary">John Doe</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-slate-600 font-medium">JSS 1 Gold</td>
                                <td class="px-4 py-3 text-slate-500">Male</td>
                                <td class="px-4 py-3 text-slate-500">James Doe</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        <button class="text-blue-500 hover:text-blue-700 transition-colors text-xs"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="text-rose-500 hover:text-rose-700 transition-colors text-xs"><i
                                                class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3 font-bold text-slate-400 uppercase text-[9px]">STU002</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-7 h-7 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center font-bold text-[9px]">
                                            SS</div>
                                        <span class="font-semibold text-primary">Sarah Smith</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-slate-600 font-medium">SS 3 Science</td>
                                <td class="px-4 py-3 text-slate-500">Female</td>
                                <td class="px-4 py-3 text-slate-500">Mary Smith</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        <button class="text-blue-500 hover:text-blue-700 transition-colors text-xs"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="text-rose-500 hover:text-rose-700 transition-colors text-xs"><i
                                                class="fas fa-trash"></i></button>
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
