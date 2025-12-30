@extends('layouts.guest')

@section('title', 'About')

@section('page-content')
    <!-- Navigation -->
    <x-guest_nav />


    <!-- Main Content -->
    <main class="py-16 container mx-auto px-4">
        <header class="bg-primary py-16 text-white text-center" data-aos="fade-down">
            <div class="container mx-auto px-4">
                <h1 class="font-bold">About EduPro Academy</h1>
                <p class="mt-3 text-white/70 text-sm">Excellence in Education since 1995</p>
            </div>
        </header>

        <section class="py-16 container mx-auto px-4">
            <div class="max-w-4xl mx-auto space-y-16">
                <div class="grid md:grid-cols-2 gap-10 items-center">
                    <div data-aos="fade-right">
                        <h2 class="font-bold text-primary mb-4">Our Mission</h2>
                        <p class="text-gray-500 leading-relaxed text-sm">
                            To provide a nurturing environment that fosters intellectual curiosity, critical thinking, and
                            character development, preparing students to lead and excel in a global society.
                        </p>
                    </div>
                    <div class="rounded-xl overflow-hidden shadow-xl h-64" data-aos="fade-left">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&h=600&fit=crop"
                            alt="Mission" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-10 items-center">
                    <div class="order-2 md:order-1 rounded-xl overflow-hidden shadow-xl h-64" data-aos="fade-right">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=800&h=600&fit=crop"
                            alt="Vision" class="w-full h-full object-cover">
                    </div>
                    <div class="order-1 md:order-2" data-aos="fade-left">
                        <h2 class="font-bold text-primary mb-4">Our Vision</h2>
                        <p class="text-gray-500 leading-relaxed text-sm">
                            To be a premier educational institution recognized for innovation, academic excellence, and the
                            success of our diverse student body.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-[#19214D] text-white py-10 mt-auto">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="space-y-3">
                <h3 class="text-lg font-bold flex items-center gap-2">
                    <i class="fas fa-graduation-cap text-[#6B8DD6]"></i>
                    <span>EduPro Academy</span>
                </h3>
                <p class="text-gray-400 text-xs leading-relaxed">
                    Excellence in education and innovation since 1995.
                </p>
            </div>
        </div>
        <div class="container mx-auto px-4 mt-6 pt-6 border-t border-gray-700 text-center text-xs text-gray-400">
            © 2025 EduPro Academy School Management System. All rights reserved.
        </div>
    </footer>

@endsection
