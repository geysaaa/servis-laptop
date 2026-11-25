@extends('layouts.app')

@section('content')
<header class="bg-surface-container-lowest border-b border-outline-variant">
  <div class="h-16 max-w-[1100px] mx-auto px-margin flex items-center justify-between">
    <a href="{{ url('/') }}" class="flex items-center gap-space-sm">
      <div class="w-9 h-9 rounded bg-primary-container flex items-center justify-center">
        <span class="material-symbols-outlined text-on-primary text-[20px]">build</span>
      </div>
      <div>
        <span class="font-headline-sm text-headline-sm block leading-tight">Servis Laptop</span>
        <span class="font-label-sm text-label-sm text-on-surface-variant block">Pelacak Servis</span>
      </div>
    </a>
    <nav class="flex items-center gap-space-sm">
      <a href="{{ route('cek-status') }}" class="hidden sm:inline-flex items-center h-10 px-space-md border border-outline-variant rounded-lg font-label-md text-label-md hover:bg-surface-container-low">Cek Status</a>
      <a href="{{ route('login') }}" class="inline-flex items-center h-10 px-space-md bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-md text-label-md">Login Petugas</a>
    </nav>
  </div>
</header>

<main class="max-w-[920px] mx-auto px-margin-mobile md:px-margin py-space-lg">
  @yield('isi')
</main>

<footer class="border-t border-outline-variant mt-space-xl">
  <div class="max-w-[1100px] mx-auto px-margin py-space-lg font-body-sm text-body-sm text-on-surface-variant">
    &copy; {{ date('Y') }} Servis Laptop. Seluruh hak cipta dilindungi.
  </div>
</footer>
@endsection