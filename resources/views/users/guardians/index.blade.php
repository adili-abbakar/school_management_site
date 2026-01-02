@extends('layouts.app')

@section('title', 'Guardians & Parents')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-dashboard-header>
            <div class="flex items-center gap-4 flex-grow max-w-xl">
                <div class="relative w-full">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Search guardians..."
                        class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-accent outline-none">
                </div>
            </div>
        </x-dashboard-header>
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-xl font-extrabold text-primary">Guardians & Parents</h1>
                    <p class="text-slate-500 text-xs">Manage family contacts and student associations.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Guardian Name</th>
                                <th class="px-6 py-4">Ward/Student</th>
                                <th class="px-6 py-4">Relationship</th>
                                <th class="px-6 py-4">Contact Number</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-semibold text-primary">James Doe</td>
                                <td class="px-6 py-4 text-slate-600">John Doe</td>
                                <td class="px-6 py-4 text-slate-500">Father</td>
                                <td class="px-6 py-4 text-slate-500">+123-444-555</td>
                                <td class="px-6 py-4 text-center">
                                    <button class="text-blue-500 hover:text-blue-700 transition-colors"><i
                                            class="fas fa-phone"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
