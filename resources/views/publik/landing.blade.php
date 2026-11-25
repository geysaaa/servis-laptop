@extends('layouts.app')
@section('title', 'Beranda')

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
    <nav class="hidden md:flex items-center gap-space-lg">
      <a href="#cara-kerja" class="font-label-md text-label-md text-on-surface-variant hover:text-on-surface">Cara Kerja</a>
      <a href="#keunggulan" class="font-label-md text-label-md text-on-surface-variant hover:text-on-surface">Keunggulan</a>
      <a href="{{ route('cek-status') }}" class="font-label-md text-label-md text-on-surface-variant hover:text-on-surface">Cek Status</a>
    </nav>
    <div class="flex items-center gap-space-sm">
      <a href="{{ route('cek-status') }}" class="hidden sm:inline-flex items-center h-10 px-space-md border border-outline-variant rounded-lg font-label-md text-label-md hover:bg-surface-container-low">Cek Status</a>
      <a href="{{ route('login') }}" class="inline-flex items-center h-10 px-space-md bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-md text-label-md">Login Petugas</a>
    </div>
  </div>
</header>

<main>
  {{-- Hero --}}
  <section class="bg-gradient-to-b from-surface-container-low to-background">
    <div class="max-w-[1100px] mx-auto px-margin py-space-xl md:py-[72px] grid md:grid-cols-2 gap-space-xl items-center">
      <div>
        <div class="inline-flex items-center gap-space-xs px-space-sm py-1 rounded-full bg-surface-container text-primary font-label-sm text-label-sm mb-space-md">
          <span class="material-symbols-outlined text-[16px]">verified</span>
          <span>Status servis bisa dipantau langsung</span>
        </div>
        <h1 class="font-headline-lg text-headline-lg md:text-[48px] md:leading-[56px] mb-space-md">
          Servis laptop jelas, <span class="text-primary-container">tanpa tanya-tanya.</span>
        </h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant mb-space-lg max-w-[520px]">
          Serahkan laptop ke toko, terima kode tiket, lalu pantau perkembangan servisnya kapan saja dari HP.
        </p>
        <div class="flex flex-wrap gap-space-sm mb-space-lg">
          <a href="{{ route('cek-status') }}" class="inline-flex items-center h-12 px-space-lg bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-md text-label-md">Cek Status Servis</a>
          <a href="#cara-kerja" class="inline-flex items-center h-12 px-space-lg border border-outline-variant rounded-lg font-label-md text-label-md hover:bg-surface-container-low">Lihat Cara Kerja</a>
        </div>
        <ul class="flex flex-wrap gap-x-space-lg gap-y-space-xs font-body-sm text-body-sm text-on-surface-variant">
          <li class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px] text-tertiary">check_circle</span> Tanpa daftar akun</li>
          <li class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px] text-tertiary">check_circle</span> Kode tiket dari nota atau WA</li>
          <li class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px] text-tertiary">check_circle</span> Riwayat status tercatat</li>
        </ul>
      </div>

      <div>
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-lg">
          <div class="flex items-start justify-between gap-space-sm mb-space-md">
            <div>
              <span class="font-body-sm text-body-sm text-on-surface-variant block">Lacak Servis</span>
              <span class="font-headline-sm text-headline-sm">Asus A416</span>
            </div>
            <span class="px-3 py-1 rounded-full bg-surface-container text-primary font-label-sm text-label-sm">Dikerjakan</span>
          </div>

          <div class="flex items-center mb-space-lg">
            <span class="w-7 h-7 rounded-full bg-primary-container text-on-primary flex items-center justify-center"><span class="material-symbols-outlined text-[16px]">check</span></span>
            <span class="flex-1 h-[2px] bg-primary-container"></span>
            <span class="w-7 h-7 rounded-full bg-primary-container text-on-primary flex items-center justify-center"><span class="material-symbols-outlined text-[16px]">check</span></span>
            <span class="flex-1 h-[2px] bg-primary-container"></span>
            <span class="w-7 h-7 rounded-full bg-primary-container text-on-primary ring-4 ring-primary-fixed flex items-center justify-center"><span class="material-symbols-outlined text-[16px]">settings</span></span>
            <span class="flex-1 h-[2px] bg-outline-variant"></span>
            <span class="w-7 h-7 rounded-full border-2 border-outline-variant text-outline font-label-sm text-label-sm flex items-center justify-center">4</span>
            <span class="flex-1 h-[2px] bg-outline-variant"></span>
            <span class="w-7 h-7 rounded-full border-2 border-outline-variant text-outline font-label-sm text-label-sm flex items-center justify-center">5</span>
          </div>

          <div class="border-t border-outline-variant">
            <div class="flex justify-between py-space-sm font-body-sm text-body-sm">
              <span class="text-on-surface-variant">Kode tiket</span>
              <span class="font-ticket-code text-ticket-code">SRV-0001</span>
            </div>
            <div class="flex justify-between py-space-sm border-t border-outline-variant font-body-sm text-body-sm">
              <span class="text-on-surface-variant">Diterima</span>
              <span class="font-semibold">16 Nov 2026</span>
            </div>
          </div>
        </div>
        <p class="text-center font-body-sm text-body-sm text-on-surface-variant mt-space-sm">Ilustrasi tampilan cek status</p>
      </div>
    </div>
  </section>

  {{-- Cara kerja --}}
  <section id="cara-kerja" class="max-w-[1100px] mx-auto px-margin py-space-xl md:py-[72px]">
    <h2 class="font-headline-md text-headline-md text-center mb-space-xs">Cara Kerja</h2>
    <p class="text-center text-on-surface-variant mb-space-xl">Empat langkah sederhana dari laptop diserahkan sampai diambil.</p>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-space-md">
      @foreach ([
        ['1', 'Serahkan laptop ke toko', 'Petugas mencatat keluhan dan kelengkapan laptop Anda.'],
        ['2', 'Terima kode tiket', 'Kode tiket diberikan lewat nota atau pesan WhatsApp.'],
        ['3', 'Pantau status servis', 'Masukkan kode tiket di halaman cek status kapan saja.'],
        ['4', 'Ambil laptop', 'Datang ke toko setelah status berubah menjadi Selesai.'],
      ] as [$no, $judul, $isi])
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-lg">
          <span class="w-9 h-9 rounded-full bg-primary-container text-on-primary font-label-md text-label-md flex items-center justify-center mb-space-md">{{ $no }}</span>
          <h3 class="font-headline-sm text-headline-sm mb-space-xs">{{ $judul }}</h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $isi }}</p>
        </div>
      @endforeach
    </div>
  </section>

  {{-- Keunggulan --}}
  <section id="keunggulan" class="bg-surface-container-low">
    <div class="max-w-[1100px] mx-auto px-margin py-space-xl md:py-[72px]">
      <h2 class="font-headline-md text-headline-md text-center mb-space-xs">Keunggulan</h2>
      <p class="text-center text-on-surface-variant mb-space-xl">Dibuat supaya pelanggan dan toko sama-sama tenang.</p>
      <div class="grid md:grid-cols-3 gap-space-md">
        @foreach ([
          ['route', 'Status jelas per tahap', 'Dari diterima, diperiksa, dikerjakan, selesai, sampai sudah diambil.'],
          ['history', 'Riwayat tercatat rapi', 'Setiap perubahan status tersimpan lengkap dengan tanggal dan jamnya.'],
          ['no_accounts', 'Tanpa daftar akun', 'Pelanggan cukup memakai kode tiket, tanpa registrasi atau kata sandi.'],
        ] as [$ikon, $judul, $isi])
          <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-lg">
            <div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary mb-space-md">
              <span class="material-symbols-outlined">{{ $ikon }}</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm mb-space-xs">{{ $judul }}</h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $isi }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>
</main>

<footer class="bg-surface-container-lowest border-t border-outline-variant">
  <div class="max-w-[1100px] mx-auto px-margin py-space-xl flex flex-col md:flex-row justify-between gap-space-md">
    <div>
      <span class="font-headline-sm text-headline-sm block">Farih Servis Laptop</span>
      <p class="font-body-sm text-body-sm text-on-surface-variant">Jual beli dan servis laptop, dengan status servis yang bisa dipantau.</p>
      <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">[Isi alamat toko]</p>
    </div>
    <div class="md:text-right">
      <p class="font-body-sm text-body-sm text-on-surface-variant">WhatsApp: [isi nomor toko]</p>
      <p class="font-body-sm text-body-sm text-on-surface-variant">&copy; {{ date('Y') }} Servis Laptop. Seluruh hak cipta dilindungi.</p>
    </div>
  </div>
</footer>
@endsection