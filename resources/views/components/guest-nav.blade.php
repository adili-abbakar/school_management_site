   <nav class="bg-navy-900 text-white sticky top-0 z-50 shadow-lg">
       <div class="container mx-auto px-4 py-3 flex items-center justify-between">
           <a href="index.html" class="text-lg font-bold flex items-center gap-2">
               <i class="fas fa-graduation-cap text-[#6B8DD6]"></i>
               <span>EduPro Academy</span>
           </a>
           <!-- Desktop Menu -->
           <div class="hidden md:flex items-center gap-6 text-sm">
               <a href="{{ route('home') }}"
                   class="hover:text-[#6B8DD6] transition-colors {{ url()->current() === route('home') ? 'text-[#6B8DD6]' : '' }}">Home</a>
               <a href="{{ route('about') }}"
                   class="hover:text-[#6B8DD6] transition-colors {{ url()->current() === route('about') ? 'text-[#6B8DD6]' : '' }}">About</a>

               <a href="" class="hover:text-[#6B8DD6] transition-colors">Academics</a>
               <div class="relative group">
                   <button
                       class="flex items-center gap-2 hover:text-[#6B8DD6] transition-colors
        {{ request()->routeIs('applications.create') || request()->routeIs('applications.track.*') || request()->routeIs('applications.mine') ? 'text-[#6B8DD6]' : '' }}">
                       <span>Admissions</span>
                       <i
                           class="fas fa-chevron-down text-[10px] transition-transform duration-200 group-hover:rotate-180"></i>
                   </button>

                   <div class="absolute left-0 top-full pt-3 hidden group-hover:block z-50">
                       <div class="w-60 bg-white text-slate-700 rounded-xl shadow-xl border border-slate-100 py-2">
                           <a href="{{ route('applications.create') }}"
                               class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-50 hover:text-[#6B8DD6] transition-colors">
                               <i class="fas fa-file-signature text-xs text-slate-400"></i>
                               <span>Apply for Admission</span>
                           </a>

                           <a href="{{ route('applications.track.search.form') }}"
                               class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-50 hover:text-[#6B8DD6] transition-colors">
                               <i class="fas fa-magnifying-glass text-xs text-slate-400"></i>
                               <span>Track Admission Application</span>
                           </a>

                           @auth
                               <a href="{{ route('applications.mine') }}"
                                   class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-50 hover:text-[#6B8DD6] transition-colors">
                                   <i class="fas fa-folder-open text-xs text-slate-400"></i>
                                   <span>My Applications</span>
                               </a>
                           @endauth
                       </div>
                   </div>
               </div>
               <a href="{{ route('news') }}"
                   class="hover:text-[#6B8DD6] transition-colors {{ url()->current() === route('news') ? 'text-[#6B8DD6]' : '' }}">News</a>
               <a href="{{ route('contact') }}"
                   class="hover:text-[#6B8DD6] transition-colors {{ url()->current() === route('contact') ? 'text-[#6B8DD6]' : '' }}">Contact</a>
               @auth
                   <a href="{{ route('dashboard.index') }}" class="hover:text-[#6B8DD6] transition-colors">Dashboard</a>
                   <form action="{{ route('logout') }}" method="POST">
                       @csrf
                       <button type="submit"
                           class="bg-[#6B8DD6] hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium transition-colors text-sm flex items-center gap-2">
                           <i class="fas fa-sign-out-alt"></i>
                           <span>Logout</span>
                       </button>
                   </form>
               @else
                   <a href="{{ route('login') }}">
                       <button
                           class="bg-[#6B8DD6] hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium transition-colors text-sm flex items-center gap-2">
                           <i class="fas fa-sign-in-alt"></i>
                           <span>Login</span>
                       </button>
                   </a>
               @endauth
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
           <div class="py-1">
               <button type="button" onclick="toggleAdmissionsMenu()"
                   class="w-full flex items-center justify-between hover:text-[#6B8DD6] transition-colors py-2 text-left
        {{ request()->routeIs('applications.create') || request()->routeIs('applications.track.*') || request()->routeIs('applications.mine') ? 'text-[#6B8DD6]' : '' }}">
                   <span>Admissions</span>
                   <i id="admissionsChevron"
                       class="fas fa-chevron-down text-[10px] transition-transform duration-200"></i>
               </button>

               <div id="admissionsSubmenu" class="hidden pl-4 mt-2 space-y-2 border-l border-gray-700">
                   <a href="{{ route('applications.create') }}"
                       class="block py-2 text-xs hover:text-[#6B8DD6] transition-colors">
                       Apply for Admission
                   </a>

                   <a href="{{ route('applications.track.search.form') }}"
                       class="block py-2 text-xs hover:text-[#6B8DD6] transition-colors">
                       Track Admission Application
                   </a>

                   @auth
                       <a href="{{ route('applications.mine') }}"
                           class="block py-2 text-xs hover:text-[#6B8DD6] transition-colors">
                           My Applications
                       </a>
                   @endauth
               </div>
           </div>
           <a href="{{ route('news') }}" class="hover:text-[#6B8DD6] transition-colors py-2">News</a>
           <a href="{{ route('contact') }}" class="hover:text-[#6B8DD6] transition-colors py-2">Contact</a>
           @auth
               <a href="{{ route('dashboard.index') }}" class="hover:text-[#6B8DD6] transition-colors py-2">Dashboard</a>
               <a href="{{ route('logout') }}">
                   <button
                       class="w-full flex items-center justify-center gap-2 bg-[#6B8DD6] hover:bg-opacity-90 text-white px-4 py-2
                       rounded-md font-medium transition-colors text-sm inline-block text-center mt-4">
                       <i class="fas fa-sign-out-alt"></i>
                       <span>Logout</span>
                   </button>
               </a>
           @else
               <a href="{{ route('login') }}">
                   <button
                       class="w-full flex items-center justify-center gap-2 bg-[#6B8DD6] hover:bg-opacity-90 text-white px-4 py-2
                       rounded-md font-medium transition-colors text-sm inline-block text-center mt-4">
                       <i class="fas fa-sign-in-alt"></i>
                       <span>Login</span>
                   </button>
               </a>
           @endauth
       </nav>
   </div>
