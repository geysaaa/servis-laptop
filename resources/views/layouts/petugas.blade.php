@extends('layouts.app')

@section('content')
@php
  $menu = [
    ['dashboard', 'Dashboard', 'space_dashboard', ['dashboard']],
    ['servis.index', 'Daftar Servis', 'build_circle', ['servis.index', 'servis.show']],
    ['servis.create', 'Servis Baru', 'add_circle', ['servis.create']],
  ];
    if (auth()->user()->peran === 'admin') {
    $menu[] = ['akun.index', 'Kelola Akun', 'manage_accounts', ['akun.index', 'akun.create']];
  }
  $inisial = strtoupper(mb_substr(auth()->user()->name, 0, 1));
@endphp
<div class="md:flex min-h-screen">
  <aside class="hidden md:flex md:w-64 shrink-0 flex-col bg-[#10294F] text-white sticky top-0 h-screen">
    <div class="flex items-center gap-3 px-6 h-20">
      <span class="w-10 h-10 rounded-xl bg-blue-500 flex items-center justify-center"><span class="material-symbols-rounded">laptop_mac</span></span>
      <div class="leading-tight">
        <p class="font-extrabold text-lg">Farih Servis Laptop</p>
        <p class="text-xs text-blue-200">Pelacak Servis</p>
      </div>
    </div>

    <nav class="px-3 mt-2 space-y-1 flex-1">
      @foreach ($menu as [$rute, $label, $ikon, $aktif])
        <a href="{{ route($rute) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs(...$aktif) ? 'bg-white/10 text-white' : 'text-blue-100/80 hover:bg-white/5 hover:text-white' }}">
          <span class="material-symbols-rounded text-[22px]">{{ $ikon }}</span>{{ $label }}
        </a>
      @endforeach
    </nav>

    <div class="p-4 border-t border-white/10">
      <div class="flex items-center gap-3 mb-3">
        <span class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center font-bold">{{ $inisial }}</span>
        <div class="leading-tight min-w-0">
          <p class="font-semibold text-sm truncate">{{ auth()->user()->name }}</p>
          <p class="text-xs text-blue-200 capitalize">{{ auth()->user()->peran }}</p>
        </div>
      </div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-xl bg-white/10 hover:bg-white/15 py-2.5 text-sm font-semibold">
          <span class="material-symbols-rounded text-[20px]">logout</span>Logout
        </button>
      </form>
    </div>
  </aside>

  <div class="flex-1 min-w-0">
    <header class="md:hidden bg-[#10294F] text-white">
      <div class="flex items-center justify-between px-4 h-16">
        <span class="font-extrabold">Servis Laptop</span>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="text-sm font-semibold rounded-lg bg-white/10 px-3 py-1.5">Logout</button>
        </form>
      </div>
      <nav class="flex gap-2 px-3 pb-3 overflow-x-auto">
        @foreach ($menu as [$rute, $label, $ikon, $aktif])
          <a href="{{ route($rute) }}" class="whitespace-nowrap rounded-full px-4 py-1.5 text-sm font-semibold {{ request()->routeIs(...$aktif) ? 'bg-white text-[#10294F]' : 'bg-white/10 text-blue-100' }}">{{ $label }}</a>
        @endforeach
      </nav>
    </header>

    <main class="p-4 md:p-8 max-w-6xl mx-auto">
      @yield('isi')
    </main>
  </div>
</div>
@endsection