@extends('layouts.error')

@section('title', '405 - Method Not Allowed')

@section('content')
    <div class="bg-white/80 backdrop-blur-md border border-white/60 shadow-xl rounded-3xl p-8 md:p-12 text-center">
        <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-yellow-50 flex items-center justify-center">
            <i class="fas fa-ban text-yellow-600 text-2xl"></i>
        </div>

        <h1 class="text-7xl font-extrabold text-slate-900 mb-3">405</h1>

        <h2 class="text-2xl font-bold text-slate-800 mb-3">
            Method Not Allowed
        </h2>

        <p class="text-sm text-slate-500 leading-relaxed mb-8">
            This page cannot be accessed using this request method.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-3">
            <a href="{{ url('/') }}"
                class="px-6 py-3 bg-[#6B8DD6] text-white rounded-xl text-sm font-bold hover:opacity-90 transition">
                Go Home
            </a>

            <button onclick="history.back()"
                class="px-6 py-3 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-bold hover:bg-slate-50 transition">
                Go Back
            </button>
        </div>
    </div>
@endsection
