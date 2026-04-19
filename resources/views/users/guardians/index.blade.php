@extends('layouts.app')

@section('title', 'Guardians')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto hide-scrollbar">
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
                                <th class="px-6 py-4">Relationship</th>
                                <th class="px-6 py-4">Phone</th>
                                <th class="px-6 py-4">Children</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse ($guardians as $guardian)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-primary">
                                                {{ $guardian->user->full_name }}
                                            </span>
                                            <span class="text-slate-500 text-[11px]">
                                                {{ $guardian->user->email ?? 'No email provided' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-purple-100 text-purple-700 px-2 py-0.5 rounded text-[10px] font-bold uppercase">
                                            {{ $guardian->relationship ? str_replace('_', ' ', $guardian->relationship) : 'Not set' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-slate-500">
                                        {{ $guardian->user->phone ?? 'No phone number' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex flex-col gap-1">
                                            <span
                                                class="inline-flex items-center gap-1 w-fit bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-[10px] font-bold">
                                                <i class="fas fa-user-graduate text-[9px]"></i>
                                                {{ $guardian->children_count ?? $guardian->children->count() }}
                                                {{ ($guardian->children_count ?? $guardian->children->count()) == 1 ? 'Child' : 'Children' }}
                                            </span>

                                            @if (($guardian->children_count ?? $guardian->children->count()) > 0)
                                                <span class="text-slate-500 text-[11px]">
                                                    {{ $guardian->children->take(2)->pluck('user.full_name')->implode(', ') }}
                                                    @if (($guardian->children_count ?? $guardian->children->count()) > 2)
                                                        <span class="text-slate-400">
                                                            +{{ ($guardian->children_count ?? $guardian->children->count()) - 2 }}
                                                            more
                                                        </span>
                                                    @endif
                                                </span>
                                            @else
                                                <span class="text-slate-400 text-[11px]">No children linked</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="">
                                                <button class="text-blue-500" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </a>

                                            <a href="{{ route('user.edit-password', $guardian->user_id) }}">
                                                <button class="text-blue-500" title="Edit Password">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                            </a>

                                            <a href="">
                                                <button class="text-green-500" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>

                                            <a href="">
                                                <button class="text-red-500" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-gray-500 p-4">
                                        No guardians found.
                                    </td>
                                </tr>
                            @endforelse

                            <div class="flex justify-center mt-4">
                                {{ $guardians->links() }}
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
