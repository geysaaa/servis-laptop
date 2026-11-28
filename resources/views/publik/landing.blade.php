@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
<section class="relative bg-[#0B1220] text-white overflow-hidden"
  style="background-image:radial-gradient(rgba(148,163,184,.16) 1px,transparent 1px);background-size:22px 22px">
  <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[800px] h-[500px] rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>

  <header class="relative z-10">
    <div class="max-w-6xl mx-auto px-4 h-20 flex items-center justify-between">
      <a href="{{ url('/') }}" class="flex items-center gap-3">
        @if (file_exists(public_path('images/logo.png')))
          <img src="{{ asset('images/logo.png') }}" alt="Logo Farih Laptop" class="w-11 h-11 rounded-full object-cover">
        @else
          <span class="w-10 h-10 rounded-xl bg-blue-500 flex items-center justify-center"><span class="material-symbols-rounded text-[22px]">laptop_mac</span></span>
        @endif
        <span class="font-extrabold text-lg">Farih Servis Laptop</span>
      </a>
      <nav class="flex items-center gap-1 text-sm font-semibold">
        <a href="#cara-kerja" class="hidden md:inline px-3 py-2 text-slate-300 hover:text-white">Cara Kerja</a>
        <a href="#kenapa" class="hidden md:inline px-3 py-2 text-slate-300 hover:text-white">Kenapa Tiket</a>
        <a href="{{ route('login') }}" class="ml-2 rounded-full border border-white/25 hover:bg-white/10 px-5 py-2.5">Login Petugas</a>
      </nav>
    </div>
  </header>

  <div class="relative max-w-6xl mx-auto px-4 pt-10 pb-20 md:pt-16 md:pb-28 grid lg:grid-cols-2 gap-12 items-center">
    <div>
      <p class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-sm font-medium text-sky-200 mb-6">
        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>Status servis bisa dipantau langsung
      </p>

      <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight leading-[1.1]">
        Laptop Anda diservis.<br><span class="text-sky-400">Pantau tiap tahapnya.</span>
      </h1>
      <p class="text-lg text-slate-300 mt-6 max-w-xl">
        Masukkan kode tiket dari nota atau pesan WhatsApp, dan lihat sudah sampai mana servis laptop Anda.
      </p>

      <form method="GET" action="{{ route('cek-status') }}" class="mt-9 max-w-xl">
        <div class="flex items-center gap-2 rounded-full bg-white p-2 shadow-2xl shadow-blue-900/40">
          <span class="material-symbols-rounded text-[22px] text-slate-400 pl-3">confirmation_number</span>
          <input name="kode" autocomplete="off" placeholder="Masukkan kode tiket, contoh SRV-0001"
            class="flex-1 min-w-0 bg-transparent px-2 py-3 text-slate-900 font-mono font-bold uppercase tracking-wider placeholder:font-sans placeholder:font-normal placeholder:normal-case placeholder:tracking-normal placeholder:text-slate-400 focus:outline-none">
          <button type="submit" class="shrink-0 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3">Cek Status</button>
        </div>
        <p class="mt-3 text-sm text-slate-400">Kode tiket ada di nota atau pesan WhatsApp dari toko.</p>
      </form>

      <div class="mt-10 flex flex-wrap items-center gap-x-2 gap-y-3 text-sm font-semibold">
        @foreach (\App\Models\Servis::STATUS as $nama)
          <span class="rounded-full border border-white/15 bg-white/5 px-3.5 py-1.5 text-slate-200">{{ $loop->iteration }}. {{ $nama }}</span>
          @unless ($loop->last)
            <span class="text-slate-500">&rarr;</span>
          @endunless
        @endforeach
      </div>
    </div>

    {{-- Gambar laptop --}}
    <div class="relative hidden sm:block">
      <div class="relative mx-auto max-w-[520px]">
        <div class="absolute -inset-8 rounded-full bg-blue-600/25 blur-3xl"></div>

        <div class="relative">
          <div class="rounded-t-2xl border-[10px] border-b-0 border-slate-700 bg-slate-900 p-4 shadow-2xl shadow-blue-900/40">
            <div class="flex items-center gap-1.5 mb-3">
              <span class="w-2 h-2 rounded-full bg-red-400"></span>
              <span class="w-2 h-2 rounded-full bg-amber-400"></span>
              <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
            </div>
            <div class="rounded-xl bg-white p-4 text-slate-900">
              <div class="flex items-start justify-between mb-4">
                <div>
                  <p class="text-[11px] text-slate-500">Lacak servis</p>
                  <p class="font-bold">Asus A416</p>
                </div>
                <span class="rounded-full bg-blue-50 text-blue-700 px-2.5 py-0.5 text-[11px] font-semibold">Dikerjakan</span>
              </div>

              <div class="flex items-center">
                @foreach (range(1, 5) as $n)
                  <span class="w-6 h-6 shrink-0 rounded-full flex items-center justify-center text-[10px] font-bold {{ $n <= 3 ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-400' }}">{{ $n }}</span>
                  @unless ($loop->last)
                    <span class="flex-1 h-1 rounded-full {{ $n < 3 ? 'bg-blue-600' : 'bg-slate-100' }}"></span>
                  @endunless
                @endforeach
              </div>

              <div class="mt-4 pt-3 border-t border-slate-100 flex justify-between text-xs">
                <span class="text-slate-500">Kode tiket</span>
                <span class="font-mono font-bold">SRV-0001</span>
              </div>
            </div>
          </div>
          <div class="relative -mx-4 h-3.5 rounded-b-2xl bg-gradient-to-b from-slate-500 to-slate-700">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 h-1.5 w-24 rounded-b-lg bg-slate-800"></div>
          </div>
        </div>

        <div class="absolute -right-3 -top-5 hidden md:flex items-center gap-3 rounded-2xl bg-white text-slate-900 px-4 py-3 shadow-xl">
          <span class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center"><span class="material-symbols-rounded text-[18px]">task_alt</span></span>
          <div>
            <p class="text-[11px] text-slate-500">Servis selesai</p>
            <p class="text-sm font-bold font-mono">SRV-0007</p>
          </div>
        </div>

        <div class="absolute -left-4 -bottom-6 hidden md:flex items-center gap-3 rounded-2xl bg-white text-slate-900 px-4 py-3 shadow-xl">
          <span class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center"><span class="material-symbols-rounded text-[18px]">chat</span></span>
          <div>
            <p class="text-[11px] text-slate-500">Kabar dari toko</p>
            <p class="text-sm font-bold">Link status dikirim via WA</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@php
  $foto = collect(['galeri-1.jpg', 'galeri-2.jpg', 'galeri-3.jpg'])
      ->filter(fn ($f) => file_exists(public_path('images/' . $f)));
@endphp
@if ($foto->isNotEmpty())
<section class="bg-white">
  <div class="max-w-6xl mx-auto px-4 py-16 md:py-24">
    <p class="text-sm font-bold text-blue-600 mb-2">Tentang toko</p>
    <h2 class="text-3xl font-extrabold text-slate-900 mb-8">Farih Servis Laptop</h2>
    <div class="grid sm:grid-cols-3 gap-4">
      @foreach ($foto as $f)
        <img src="{{ asset('images/' . $f) }}" alt="Foto Farih Servis Laptop" loading="lazy" class="w-full h-64 object-cover rounded-2xl">
      @endforeach
    </div>
  </div>
</section>
@endif

<section id="cara-kerja" class="bg-white">
  <div class="max-w-6xl mx-auto px-4 py-16 md:py-24 grid md:grid-cols-3 gap-10">
    <div>
      <p class="text-sm font-bold text-blue-600 mb-2">Cara kerja</p>
      <h2 class="text-3xl font-extrabold text-slate-900 leading-tight">Dari diserahkan sampai diambil, semuanya tercatat.</h2>
    </div>
    <div class="md:col-span-2 divide-y divide-slate-200">
      @foreach ([
        ['inventory_2', 'Serahkan laptop ke toko', 'Petugas mencatat keluhan dan kelengkapan laptop Anda saat laptop diterima.'],
        ['confirmation_number', 'Terima kode tiket', 'Kode tiket diberikan lewat nota atau pesan WhatsApp dari toko.'],
        ['location_searching', 'Pantau status servis', 'Masukkan kode tiket kapan saja untuk melihat tahap servis dan riwayatnya.'],
        ['task_alt', 'Ambil laptop', 'Datang ke toko setelah status berubah menjadi Selesai.'],
      ] as [$ikon, $judul, $isi])
        <div class="flex items-start gap-5 py-6 first:pt-0 last:pb-0">
          <span class="font-mono text-sm font-bold text-blue-600 pt-3">0{{ $loop->iteration }}</span>
          <span class="w-12 h-12 shrink-0 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center"><span class="material-symbols-rounded text-[22px]">{{ $ikon }}</span></span>
          <div>
            <h3 class="text-lg font-bold text-slate-900">{{ $judul }}</h3>
            <p class="text-slate-500 mt-1">{{ $isi }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section id="kenapa" class="bg-slate-50">
  <div class="max-w-6xl mx-auto px-4 py-16 md:py-24">
    <p class="text-sm font-bold text-blue-600 mb-2">Kenapa memakai tiket</p>
    <h2 class="text-3xl font-extrabold text-slate-900 max-w-xl leading-tight">Pelanggan tenang, toko tidak perlu menjawab pertanyaan yang sama berulang.</h2>

    <div class="grid md:grid-cols-3 gap-10 mt-12">
      @foreach ([
        ['timeline', 'Status jelas per tahap', 'Lima tahap dari diterima sampai sudah diambil, tanpa perlu bertanya.'],
        ['history', 'Riwayat tercatat rapi', 'Setiap perubahan status tersimpan dengan tanggal dan jamnya.'],
        ['no_accounts', 'Tanpa daftar akun', 'Cukup kode tiket. Tidak ada registrasi atau kata sandi untuk pelanggan.'],
      ] as [$ikon, $judul, $isi])
        <div>
          <span class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center mb-5"><span class="material-symbols-rounded text-[22px]">{{ $ikon }}</span></span>
          <h3 class="text-lg font-bold text-slate-900 mb-1">{{ $judul }}</h3>
          <p class="text-slate-500">{{ $isi }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

@include('partials.footer-publik')
@endsection