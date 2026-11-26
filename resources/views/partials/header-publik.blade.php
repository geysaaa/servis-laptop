<header class="sticky top-0 z-30 bg-white/85 backdrop-blur border-b border-slate-200/70">
  <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between gap-4">
    <a href="{{ url('/') }}" class="flex items-center gap-3">
      <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 text-white flex items-center justify-center shadow-sm shadow-blue-600/30">
        <span class="material-symbols-rounded">laptop_mac</span>
      </span>
      <span class="leading-tight">
        <span class="block font-extrabold text-slate-900">Servis Laptop</span>
        <span class="block text-[11px] font-medium text-slate-500">Pelacak Servis</span>
      </span>
    </a>
    <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
      <a href="{{ url('/') }}#cara-kerja" class="hover:text-blue-600">Cara Kerja</a>
      <a href="{{ url('/') }}#keunggulan" class="hover:text-blue-600">Keunggulan</a>
      <a href="{{ route('cek-status') }}" class="hover:text-blue-600">Cek Status</a>
    </nav>
    <div class="flex items-center gap-2 text-sm font-semibold">
      <a href="{{ route('cek-status') }}" class="hidden sm:inline-flex rounded-xl border border-slate-200 bg-white px-4 py-2.5 hover:bg-slate-50">Cek Status</a>
      <a href="{{ route('login') }}" class="inline-flex rounded-xl bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 shadow-sm shadow-blue-600/25">Login Petugas</a>
    </div>
  </div>
</header>