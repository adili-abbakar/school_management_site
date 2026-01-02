    <!-- Mobile overlay for sidebar -->
    <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>

    <!-- Sidebar now toggleable on mobile -->
    <aside id="sidebar" class="mobile-sidebar md:translate-x-0 w-56 bg-sidebar text-slate-300 flex-shrink-0 flex flex-col fixed md:relative z-40 h-full">
        <div class="p-4 flex items-center gap-3 border-b border-slate-800">
            <div class="bg-accent text-white p-1.5 rounded text-xs">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <span class="text-base font-bold text-white tracking-tight">EduPro</span>
            <!-- Close button for mobile -->
            <button id="closeSidebar" class="ml-auto text-white md:hidden">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="flex-grow py-4 space-y-1 overflow-y-auto text-xs">
            <div class="px-4 mb-2 text-[9px] font-semibold text-slate-500 uppercase tracking-wider">Main Menu</div>
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ url()->current() == route('dashboard') ? 'active' : '' }} flex items-center px-4 py-2 hover:bg-slate-800 transition-colors gap-2">
                <i class="fas fa-th-large text-xs"></i>
                <span>Overview</span>
            </a>
            
            <div class="px-4 mt-4 mb-2 text-[9px] font-semibold text-slate-500 uppercase tracking-wider">User Management</div>
            <a href="{{ route('students.index') }}" class="sidebar-link {{ request()->is('students*') ? 'active' : '' }} flex items-center px-4 py-2 hover:bg-slate-800 transition-colors gap-2">
                <i class="fas fa-user-graduate text-xs"></i>
                <span>Students</span>
            </a>
            <a href="{{ route('teachers.index') }}" class="sidebar-link {{ request()->is('teachers*') ? 'active' : '' }} flex items-center px-4 py-2 hover:bg-slate-800 transition-colors gap-2">
                <i class="fas fa-chalkboard-teacher text-xs"></i>
                <span>Teachers</span>
            </a>
            <a href="{{ route('admins.index') }}" class="sidebar-link {{ request()->is('admins*') ? 'active' : '' }} flex items-center px-4 py-2 hover:bg-slate-800 transition-colors gap-2">
                <i class="fas fa-user-shield text-xs"></i>
                <span>Admins</span>
            </a>
            <a href="{{  route('guardians.index') }}" class="sidebar-link {{ request()->is('guardians*') ? 'active' : '' }} flex items-center px-4 py-2 hover:bg-slate-800 transition-colors gap-2">
                <i class="fas fa-users text-xs"></i>
                <span>Guardians</span>
            </a>

            <div class="px-4 mt-4 mb-2 text-[9px] font-semibold text-slate-500 uppercase tracking-wider">Academics</div>
            <a href="dashboard-sessions.html" class="sidebar-link flex items-center px-4 py-2 hover:bg-slate-800 transition-colors gap-2">
                <i class="fas fa-calendar-alt text-xs"></i>
                <span>Sessions</span>
            </a>
            <a href="dashboard-classes.html" class="sidebar-link flex items-center px-4 py-2 hover:bg-slate-800 transition-colors gap-2">
                <i class="fas fa-school text-xs"></i>
                <span>Classes</span>
            </a>
            <a href="dashboard-promotions.html" class="sidebar-link flex items-center px-4 py-2 hover:bg-slate-800 transition-colors gap-2">
                <i class="fas fa-arrow-up-right-dots text-xs"></i>
                <span>Promotions</span>
            </a>

            <div class="px-4 mt-4 mb-2 text-[9px] font-semibold text-slate-500 uppercase tracking-wider">Operations</div>
            <a href="dashboard-admissions.html" class="sidebar-link flex items-center px-4 py-2 hover:bg-slate-800 transition-colors gap-2">
                <i class="fas fa-user-plus text-xs"></i>
                <span>Admissions</span>
            </a>
            <a href="dashboard-results-upload.html" class="sidebar-link flex items-center px-4 py-2 hover:bg-slate-800 transition-colors gap-2">
                <i class="fas fa-file-invoice text-xs"></i>
                <span>Results</span>
            </a>
        </nav>
        <div class="p-4 border-t border-slate-800">
            <button class="w-full flex items-center gap-2 text-slate-400 hover:text-white transition-colors text-xs">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </div>
    </aside>
