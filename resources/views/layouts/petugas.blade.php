@extends('layouts.app')

@section('content')
<div class="min-h-screen md:flex">
  <aside class="md:w-60 shrink-0 bg-surface-container-lowest border-b md:border-b-0 md:border-r border-outline-variant p-space-md md:min-h-screen flex md:flex-col gap-space-md flex-wrap">
    <div class="flex items-center gap-space-sm">
      <div class="w-9 h-9 rounded bg-primary-container flex items-center justify-center">
        <span class="material-symbols-outlined text-on-primary text-[20px]">build</span>
      </div>
      <span class="font-headline-sm text-headline-sm">Servis Laptop</span>
    </div>

    <nav class="flex md:flex-col gap-space-xs md:mt-space-md">
      <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg font-label-md text-label-md {{ request()->routeIs('dashboard') ? 'bg-primary-fixed text-primary' : 'text-on-surface-variant hover:bg-surface-container-low' }}">Dashboard</a>
      <a href="{{ route('servis.index') }}" class="px-3 py-2 rounded-lg font-label-md text-label-md {{ request()->routeIs('servis.index') || request()->routeIs('servis.show') ? 'bg-primary-fixed text-primary' : 'text-on-surface-variant hover:bg-surface-container-low' }}">Daftar Servis</a>
      <a href="{{ route('servis.create') }}" class="px-3 py-2 rounded-lg font-label-md text-label-md {{ request()->routeIs('servis.create') ? 'bg-primary-fixed text-primary' : 'text-on-surface-variant hover:bg-surface-container-low' }}">Servis Baru</a>
    </nav>

    <div class="md:mt-auto ml-auto md:ml-0 md:pt-space-md md:border-t border-outline-variant">
      <p class="font-label-md text-label-md">{{ auth()->user()->name }}</p>
      <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-xs">{{ auth()->user()->peran }}</p>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="font-label-md text-label-md text-primary">Logout</button>
      </form>
    </div>
  </aside>

  <main class="flex-1 p-margin-mobile md:p-margin">
    <div class="max-w-[920px] mx-auto">
      @yield('isi')
    </div>
  </main>
</div>
@endsection