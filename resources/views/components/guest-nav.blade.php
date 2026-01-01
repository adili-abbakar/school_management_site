   <nav class="bg-navy-900 text-white sticky top-0 z-50 shadow-lg">
      <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <a href="index.html" class="text-lg font-bold flex items-center gap-2">
          <i class="fas fa-graduation-cap text-[#6B8DD6]"></i>
          <span>EduPro Academy</span>
        </a>
        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-6 text-sm">
          <a href="{{ route('home') }}" class="hover:text-[#6B8DD6] transition-colors">Home</a>
          <a href="{{ route('about') }}" class="hover:text-[#6B8DD6] transition-colors">About</a>
          <a href="" class="hover:text-[#6B8DD6] transition-colors">Academics</a>
          <a href="{{ route('admission.apply') }}" class="hover:text-[#6B8DD6] transition-colors">Admissions</a>
          <a href="{{ route('news') }}" class="hover:text-[#6B8DD6] transition-colors">News</a>
          <a href="{{ route('contact') }}" class="hover:text-[#6B8DD6] transition-colors">Contact</a>
          <a href="{{ route('login') }}"
            class="bg-[#6B8DD6] hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium transition-colors text-sm">
            Portal Login
          </a>
        </div>
        <!-- Mobile Menu Toggle -->
        <button id="mobileMenuBtn" class="md:hidden text-white text-xl">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobileMenuOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"></div>
    <!-- Mobile Side Menu Overlay -->
    <div id="mobileMenu"
      class="mobile-menu fixed top-0 right-0 h-full w-64 bg-navy-900 text-white z-50 shadow-2xl md:hidden">
      <div class="p-4 border-b border-gray-700 flex items-center justify-between">
        <span class="font-bold">Menu</span>
        <button id="closeMobileMenu" class="text-white text-xl">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <nav class="flex flex-col p-4 space-y-4 text-sm">
        <a href="{{ route('home') }}" class="hover:text-[#6B8DD6] transition-colors py-2">Home</a>
        <a href="{{ route('about') }}" class="hover:text-[#6B8DD6] transition-colors py-2">About</a>
        <a href="#" class="hover:text-[#6B8DD6] transition-colors py-2">Academics</a>
        <a href="{{ route('admission.apply') }}" class="hover:text-[#6B8DD6] transition-colors py-2">Admissions</a>
        <a href="{{ route('news') }}" class="hover:text-[#6B8DD6] transition-colors py-2">News</a>
        <a href="{{ route('contact') }}" class="hover:text-[#6B8DD6] transition-colors py-2">Contact</a>
        <a href="{{ route('login') }}"
          class="bg-[#6B8DD6] hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium transition-colors text-sm inline-block text-center mt-4">
          Portal Login
        </a>
      </nav>
    </div>