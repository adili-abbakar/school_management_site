@extends('layouts.app')

@section('title', 'System Administrators')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-dashboard-header>
            <div class="flex items-center gap-4 flex-grow max-w-xl">
                <div class="relative w-full">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Search admins..."
                        class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-accent outline-none">
                </div>
            </div>
        </x-dashboard-header>

        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-xl font-extrabold text-primary">System Administrators</h1>
                    <p class="text-slate-500 text-xs">Manage administrative roles and permissions.</p>
                </div>
                <a href="{{ route('admins.create') }}">
                    <button
                        class="bg-accent text-white px-4 py-2 rounded-lg text-xs font-semibold shadow hover:bg-blue-600 transition-all flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        <span>Create New Admin</span>
                    </button>
                </a>
            </div>

            <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Admin ID</th>
                                <th class="px-6 py-4">Name</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4">Last Login</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-400 uppercase">ADM001</td>
                                <td class="px-6 py-4 font-semibold text-primary">Admin User</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-[10px] font-bold uppercase">Super
                                        Admin</span>
                                </td>
                                <td class="px-6 py-4 text-slate-500">2 mins ago</td>
                                <td class="px-6 py-4 text-center">
                                    <button class="text-blue-500"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
