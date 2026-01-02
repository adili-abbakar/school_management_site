<header class="h-14 bg-white border-b p-6 flex items-center justify-between sticky top-0 z-10 shadow-sm">
    <button id="openSidebar" class="text-primary text-lg md:hidden mr-3">
        <i class="fas fa-bars"></i>
    </button>
    @if($slot->isEmpty())
        <div></div>
    @else
        {{ $slot }}
    @endif


    <div class="flex items-center gap-4">
        <button class="relative text-slate-500 hover:text-primary transition-colors text-sm">
            <i class="fas fa-bell"></i>
            <span class="absolute -top-1 -right-1 w-1.5 h-1.5 bg-red-500 rounded-full border border-white"></span>
        </button>
        <div class="flex items-center gap-2">
            <div class="text-right hidden sm:block">
                <div class="text-xs font-bold text-primary leading-none">Admin</div>
                <div class="text-[9px] text-slate-400 uppercase tracking-wider font-semibold">Super Admin</div>
            </div>
            <div
                class="w-8 h-8 bg-accent text-white rounded-full flex items-center justify-center font-bold text-xs shadow-md">
                AD
            </div>
        </div>
    </div>
</header>
