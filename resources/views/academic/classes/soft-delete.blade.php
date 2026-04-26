@extends('layouts.delete')

@section('title', 'Archive Acadmic Period')

@section('page-content')

    <!-- Delete Warning Modal -->
    <div class="bg-white-50/80 rounded-lg shadow-2xl max-w-md w-full border-2 border-red-200">
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-500 to-red-800 px-6 py-4 rounded-t-lg">
            <div class="flex items-center gap-3">
                <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
                <h1 class="text-white text-lg font-bold">Archive {{ ucwords($title) }}</h1>
            </div>
        </div>

        <!-- Content -->
        <form method="POST" action="{{ $route }}" class="form p-6">
            <x-loader-component />
            @csrf
            @method('DELETE')

            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                <p class="text-red-800 text-sm font-medium">WARNING: This action will archive the {{ $title }}!</p>
            </div>

            <p class="text-slate-700 text-sm mb-4">
                You are about to archive the Academic {{ $title }}:
            </p>

            <div class="bg-slate-100 rounded-lg p-3 mb-6">
                <p class="text-slate-800 font-semibold text-sm">Class: {{ $title !== 'class' ?  $data->class->name : $data->name }}</p>
                <p class="text-slate-800 text-xs">Arms: {{ $title !== 'class' ? $data->name : '' }}</p>
                @isset($data->arms)
                    <ul class="list-disc pl-5">
                        @foreach ($data?->arms as $arm)
                            <li class="text-slate-600 text-xs">
                                {{ $arm->full_name }}
                            </li>
                        @endforeach
                    </ul>
                @endisset
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-6">
                @foreach ($messages as $message)
                    <p class="text-yellow-800 text-xs py-2">
                        <i class="fas fa-info-circle mr-2"></i>
                        {{ $message }}
                    </p>
                @endforeach
            </div>

            <!-- Confirmation Input -->
            <div class="mb-6">
                <label class="text-slate-700 text-xs font-medium block mb-2">
                    Type "<span class="font-bold text-red-600">CONFIRM</span>" to archive:
                </label>
                <input type="text" id="confirmInput" placeholder="Enter confirmation text"
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:border-red-500">
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button onclick="window.history.back()" type="button"
                    class="flex-1 px-4 py-2 bg-slate-300 text-slate-800 text-sm rounded-lg font-medium hover:bg-slate-400 transition text-center">
                    Cancel
                </button>
                <button id="deleteBtn" disabled type="submit"
                    class="flex-1 px-4 py-2 bg-red-400 text-white text-sm rounded-lg font-medium hover:bg-red-500 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    Delete Account
                </button>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/deleteConfirmer.js') }}"></script>
    <script src="{{ asset('/js/formSubmitter.js') }}"></script>
@endsection
