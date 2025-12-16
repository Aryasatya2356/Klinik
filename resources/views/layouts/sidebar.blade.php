<div class="w-64 bg-[#A4C96A] min-h-screen flex flex-col shadow-lg transition-all duration-300 z-20 fixed md:relative hidden md:flex">
    
    <div class="h-24 bg-white flex items-center justify-center border-b border-green-200/50 shadow-sm">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo SINKLUS" class="w-10 h-auto object-contain drop-shadow-sm">
            <div class="flex flex-col">
                <span class="font-extrabold text-xl text-[#004E64] tracking-wider leading-none font-['Open_Sans']">SINKLUS</span>
                <span class="text-[0.6rem] font-bold text-[#A4C96A] uppercase tracking-widest mt-1">
                    {{ ucfirst(Auth::user()->role) }} Area </span>
            </div>
        </a>
    </div>

    <nav class="flex-1 px-4 py-8 space-y-4 overflow-y-auto">
        
        @php
            $dashboardRoute = 'dashboard'; // Default Pasien
            if(Auth::user()->role == 'perawat') $dashboardRoute = 'perawat.dashboard';
            if(Auth::user()->role == 'dokter') $dashboardRoute = 'dokter.dashboard';
            if(Auth::user()->role == 'admin') $dashboardRoute = 'admin.dashboard';
        @endphp

        <a href="{{ route($dashboardRoute) }}" 
           class="flex items-center gap-3 px-5 py-4 rounded-xl transition-all duration-300 group font-['Open_Sans']
           {{ request()->routeIs($dashboardRoute) 
                ? 'bg-[#FBF8F1] text-[#1a3d1f] font-bold shadow-lg translate-x-2 border-l-4 border-[#004E64]' 
                : 'text-white hover:bg-[#8eb555] hover:text-white hover:shadow-md hover:translate-x-1' 
           }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            <span class="text-sm tracking-wide">Dashboard</span>
        </a>

        @if(Auth::user()->role == 'pasien')
            <a href="{{ route('pasien.daftar') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl transition-all duration-300 group font-['Open_Sans'] {{ request()->routeIs('pasien.daftar') ? 'bg-[#FBF8F1] text-[#1a3d1f] font-bold shadow-lg translate-x-2 border-l-4 border-[#004E64]' : 'text-white hover:bg-[#8eb555]' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="text-sm tracking-wide">Daftar Berobat</span>
            </a>
            <a href="{{ route('pasien.riwayat') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl transition-all duration-300 group font-['Open_Sans'] {{ request()->routeIs('pasien.riwayat') ? 'bg-[#FBF8F1] text-[#1a3d1f] font-bold shadow-lg translate-x-2 border-l-4 border-[#004E64]' : 'text-white hover:bg-[#8eb555]' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-sm tracking-wide">Riwayat Medis</span>
            </a>
            <a href="{{ route('pasien.jadwal') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl transition-all duration-300 group font-['Open_Sans'] {{ request()->routeIs('pasien.jadwal') ? 'bg-[#FBF8F1] text-[#1a3d1f] font-bold shadow-lg translate-x-2 border-l-4 border-[#004E64]' : 'text-white hover:bg-[#8eb555]' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="text-sm tracking-wide">Jadwal Dokter</span>
            </a>
        @endif

        @if(Auth::user()->role == 'perawat')
            <a href="{{ route('perawat.dashboard') }}#validasi" class="flex items-center gap-3 px-5 py-4 rounded-xl transition-all duration-300 group font-['Open_Sans'] text-white hover:bg-[#8eb555]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                <span class="text-sm tracking-wide">Validasi Pasien</span>
            </a>
            <a href="{{ route('perawat.dashboard') }}#kasir" class="flex items-center gap-3 px-5 py-4 rounded-xl transition-all duration-300 group font-['Open_Sans'] text-white hover:bg-[#8eb555]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                <span class="text-sm tracking-wide">Kasir / Pembayaran</span>
            </a>
        @endif

        @if(Auth::user()->role == 'dokter')
            <a href="{{ route('dokter.dashboard') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl transition-all duration-300 group font-['Open_Sans'] text-white hover:bg-[#8eb555]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-sm tracking-wide">Periksa Pasien</span>
            </a>
        @endif

        @if(Auth::user()->role == 'admin')
            <a href="{{ route('user.index') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl transition-all duration-300 group font-['Open_Sans'] text-white hover:bg-[#8eb555]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="text-sm tracking-wide">Kelola Pengguna</span>
            </a>
            <a href="{{ route('obat.index') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl transition-all duration-300 group font-['Open_Sans'] text-white hover:bg-[#8eb555]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                <span class="text-sm tracking-wide">Kelola Obat</span>
            </a>
            <a href="{{ route('poli.index') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl transition-all duration-300 group font-['Open_Sans'] {{ request()->routeIs('poli.*') ? 'bg-[#FBF8F1] text-[#1a3d1f] font-bold shadow-lg translate-x-2 border-l-4 border-[#004E64]' : 'text-white hover:bg-[#8eb555]' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m8-2a2 2 0 01-2-2h-4a2 2 0 01-2 2v2a2 2 0 012 2h4a2 2 0 012-2v-2z"></path></svg>
                <span class="text-sm tracking-wide">Kelola Poli</span>
            </a>
            <a href="{{ route('jadwal.index') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl transition-all duration-300 group font-['Open_Sans'] {{ request()->routeIs('jadwal.*') ? 'bg-[#FBF8F1] text-[#1a3d1f] font-bold shadow-lg translate-x-2 border-l-4 border-[#004E64]' : 'text-white hover:bg-[#8eb555]' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="text-sm tracking-wide">Jadwal Dokter</span>
            </a>
        @endif

    </nav>

    <div class="p-6 border-t border-[#8eb555]/50">
        <p class="text-xs text-white/80 text-center font-semibold tracking-wider">&copy; 2025 Klinik SINKLUS</p>
    </div>
</div>