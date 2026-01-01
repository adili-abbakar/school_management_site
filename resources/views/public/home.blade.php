@extends('layouts.guest.app')

@section('title', 'Home')

@section('page-content')
    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="relative h-[550px] flex items-center justify-center text-white overflow-hidden">
            <div class="absolute inset-0 bg-[#19214D]/80 z-10"></div>
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=2000&h=1200&fit=crop');">
            </div>
            <div class="container mx-auto px-4 relative z-20 text-center" data-aos="fade-up">
                <h1 class="text-3xl md:text-5xl font-extrabold mb-5">
                    Empowering Minds, Shaping the Future
                </h1>
                <p class="text-base mb-7 max-w-2xl mx-auto text-gray-200">
                    Welcome to EduPro Academy, where we combine traditional values with modern innovation.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="apply.html"
                        class="bg-[#6B8DD6] hover:bg-opacity-90 text-white px-7 py-3 rounded-lg font-bold transition-all text-sm">
                        Apply for Admission
                    </a>
                    <a href="about.html"
                        class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/30 px-7 py-3 rounded-lg font-bold transition-all text-sm">
                        Explore Campus
                    </a>
                </div>
            </div>
        </section>

        <!-- Why Choose Us -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-2xl font-bold text-[#19214D] mb-3">Why Choose EduPro?</h2>
                    <div class="w-20 h-1.5 bg-[#6B8DD6] mx-auto"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-xl transition-shadow group"
                        data-aos="fade-up" data-aos-delay="100">
                        <div
                            class="w-14 h-14 bg-blue-50 flex items-center justify-center rounded-lg mb-5 group-hover:bg-[#6B8DD6] transition-colors">
                            <i class="fas fa-user-graduate text-xl text-[#6B8DD6] group-hover:text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-3 text-[#19214D]">Expert Educators</h3>
                        <p class="text-gray-600 text-sm">Our faculty members are world-class professionals dedicated
                            to student
                            success.</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-xl transition-shadow group"
                        data-aos="fade-up" data-aos-delay="200">
                        <div
                            class="w-14 h-14 bg-blue-50 flex items-center justify-center rounded-lg mb-5 group-hover:bg-[#6B8DD6] transition-colors">
                            <i class="fas fa-microscope text-xl text-[#6B8DD6] group-hover:text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-3 text-[#19214D]">Modern Facilities</h3>
                        <p class="text-gray-600 text-sm">State-of-the-art labs, libraries, and smart classrooms for
                            immersive
                            learning.</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-xl transition-shadow group"
                        data-aos="fade-up" data-aos-delay="300">
                        <div
                            class="w-14 h-14 bg-blue-50 flex items-center justify-center rounded-lg mb-5 group-hover:bg-[#6B8DD6] transition-colors">
                            <i class="fas fa-trophy text-xl text-[#6B8DD6] group-hover:text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-3 text-[#19214D]">Holistic Growth</h3>
                        <p class="text-gray-600 text-sm">Focusing on academic excellence as well as sports, arts,
                            and character
                            building.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Latest News Preview -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-end mb-10" data-aos="fade-up">
                    <div>
                        <h2 class="text-2xl font-bold text-[#19214D] mb-2">School News & Updates</h2>
                        <div class="w-20 h-1.5 bg-[#6B8DD6]"></div>
                    </div>
                    <a href="#" class="text-[#6B8DD6] font-bold hover:underline text-sm">View All News →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 group"
                        data-aos="fade-up" data-aos-delay="100">
                        <div class="h-44 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&h=400&fit=crop"
                                alt="news"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="p-5">
                            <span class="text-xs font-bold text-[#6B8DD6] uppercase">October 11, 2025</span>
                            <h3 class="text-base font-bold my-2 text-[#19214D]">Annual Science Fair Winners</h3>
                            <p class="text-xs text-gray-600">Our students showcased incredible innovation at this
                                year's Science
                                Fair...</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 group"
                        data-aos="fade-up" data-aos-delay="200">
                        <div class="h-44 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600&h=400&fit=crop"
                                alt="news"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="p-5">
                            <span class="text-xs font-bold text-[#6B8DD6] uppercase">October 12, 2025</span>
                            <h3 class="text-base font-bold my-2 text-[#19214D]">Sports Day Celebrations</h3>
                            <p class="text-xs text-gray-600">An exciting day of athletics and team spirit brought
                                our community
                                together...</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 group"
                        data-aos="fade-up" data-aos-delay="300">
                        <div class="h-44 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600&h=400&fit=crop"
                                alt="news"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="p-5">
                            <span class="text-xs font-bold text-[#6B8DD6] uppercase">October 13, 2025</span>
                            <h3 class="text-base font-bold my-2 text-[#19214D]">New Library Wing Opens</h3>
                            <p class="text-xs text-gray-600">Students now have access to over 10,000 new books and
                                digital
                                resources...</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
