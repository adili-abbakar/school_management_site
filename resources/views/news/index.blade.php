@extends('layouts.guest.app')

@section('title', 'News')

@section('page-content')
    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-2xl font-bold mb-8">Latest Updates</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($news as $story)
                <div class="bg-white rounded-xl overflow-hidden border border-slate-200 shadow-sm" data-aos="fade-up">
                    <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?auto=format&fit=crop&q=80&w=800"
                        class="h-40 w-full object-cover">
                    <div class="p-4">
                        <span class="text-blue-600 text-xs font-bold uppercase">Academics</span>
                        <h3 class="font-bold mt-1 text-slate-800">Annual Science Fair 2025</h3>
                        <p class="text-slate-500 text-xs mt-2">Join us next Friday for our biggest science exhibition yet...
                        </p>
                        <a href="#" class="inline-block mt-4 text-xs font-semibold text-blue-600 hover:underline">Read
                            More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
