@extends('layouts.guest')

@section('title', 'Contact')

@section('page-content')
    <!-- Navigation -->
    <x-guest_nav />


    <!-- Main Content -->
    <main class="py-16 container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-10 max-w-5xl mx-auto">
            <div class="space-y-6" data-aos="fade-right">
                <h1 class="text-3xl font-bold text-[#19214D]">Get in Touch</h1>
                <p class="text-sm text-gray-600">We are here to answer any questions you may have about EduPro.</p>

                <div class="space-y-5">
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-map-marker-alt text-[#6B8DD6]"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-[#19214D]">Visit Us</h4>
                            <p class="text-xs text-gray-600">123 Education Way, Tech City</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-phone text-[#6B8DD6]"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-[#19214D]">Call Us</h4>
                            <p class="text-xs text-gray-600">+1 (555) 123-4567</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-envelope text-[#6B8DD6]"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-[#19214D]">Email Us</h4>
                            <p class="text-xs text-gray-600">info@edupro.academy</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200" data-aos="fade-left">
                <form class="space-y-4">
                    <input type="text" placeholder="Your Name"
                        class="w-full px-4 py-3 bg-gray-100 rounded-lg border-none outline-none text-sm">
                    <input type="email" placeholder="Your Email"
                        class="w-full px-4 py-3 bg-gray-100 rounded-lg border-none outline-none text-sm">
                    <textarea placeholder="Your Message" rows="4"
                        class="w-full px-4 py-3 bg-gray-100 rounded-lg border-none outline-none text-sm"></textarea>
                    <button
                        class="w-full bg-[#6B8DD6] text-white py-3 rounded-lg font-bold hover:bg-opacity-90 transition-all text-sm">Send
                        Message</button>
                </form>
            </div>
        </div>
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