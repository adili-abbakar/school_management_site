@extends('layouts.app')

@section('title', 'Numbering Settings')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 overflow-y-auto">
        <x-dashboard-header>
            <div class="flex items-center gap-4 flex-grow max-w-xl">
                <div class="relative w-full">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Search numbering settings..."
                        class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-accent outline-none">
                </div>
            </div>
        </x-dashboard-header>

        <div class="p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                <div>
                    <h1 class="text-xl font-extrabold text-primary">Numbering Settings</h1>
                    <p class="text-slate-500 text-xs">
                        Configure admission numbers, staff IDs, application numbers, and other system-generated IDs.
                    </p>
                </div>

                <a href="{{ route('numbering-settings.create') }}"
                    class="bg-accent text-white px-3 py-1.5 rounded-lg text-xs font-semibold shadow-md hover:bg-blue-600 transition-all flex items-center gap-1.5">
                    <i class="fas fa-plus"></i>
                    <span>Add Pattern</span>
                </a>
            </div>

            <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-4 border-b border-slate-200 flex justify-between items-center">
                    <h3 class="font-bold text-primary text-sm">Configured Number Patterns</h3>
                    <span class="text-[9px] font-bold text-slate-400 uppercase">
                        {{ $numberingSettings->count() }} Settings
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-100 text-slate-500 uppercase text-[9px] font-bold tracking-wider">
                            <tr>
                                <th class="px-4 py-3">Type</th>
                                <th class="px-4 py-3">Prefix</th>
                                <th class="px-4 py-3">Separator</th>
                                <th class="px-4 py-3">Year</th>
                                <th class="px-4 py-3">Padding</th>
                                <th class="px-4 py-3">Next No.</th>
                                <th class="px-4 py-3">Preview</th>
                                <th class="px-4 py-3 text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($numberingSettings as $setting)
                                @php
                                    $parts = [];

                                    if ($setting->prefix) {
                                        $parts[] = $setting->prefix;
                                    }

                                    if ($setting->include_year) {
                                        $parts[] = now()->year;
                                    }

                                    $parts[] = str_pad($setting->next_number, $setting->padding, '0', STR_PAD_LEFT);

                                    $preview = implode($setting->separator, $parts);
                                @endphp

                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="font-bold text-primary">
                                            {{ ucwords(str_replace('_', ' ', $setting->type)) }}
                                        </div>
                                        <div class="text-[9px] text-slate-400">
                                            {{ $setting->type }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-slate-600 font-semibold">
                                        {{ $setting->prefix ?? 'None' }}
                                    </td>

                                    <td class="px-4 py-3 text-slate-600">
                                        {{ $setting->separator }}
                                    </td>

                                    <td class="px-4 py-3">
                                        @if ($setting->include_year)
                                            <span
                                                class="bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded-full text-[8px] font-bold uppercase">
                                                Yes
                                            </span>
                                        @else
                                            <span
                                                class="bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded-full text-[8px] font-bold uppercase">
                                                No
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 text-slate-600">
                                        {{ $setting->padding }}
                                    </td>

                                    <td class="px-4 py-3 text-slate-600 font-bold">
                                        {{ $setting->next_number }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <span
                                            class="bg-blue-50 text-blue-700 border border-blue-100 px-2 py-1 rounded-lg text-[10px] font-bold">
                                            {{ $preview }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('numbering-settings.edit', $setting) }}"
                                                class="bg-amber-50 text-amber-600 px-4 py-2 rounded text-xs font-semibold border border-amber-200 hover:bg-amber-100 flex items-center gap-1">
                                                <i class="fas fa-pen"></i>
                                                Edit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-10 text-center">
                                        <div
                                            class="w-12 h-12 mx-auto mb-3 rounded-full bg-slate-100 flex items-center justify-center">
                                            <i class="fas fa-hashtag text-slate-400"></i>
                                        </div>
                                        <h3 class="font-bold text-primary text-sm">No numbering settings found</h3>
                                        <p class="text-slate-400 text-xs mt-1">
                                            Create a pattern for admission number, staff ID, or application number.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
