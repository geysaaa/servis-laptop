@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
@include('partials.header-publik')

<main>
  <section class="relative overflow-hidden bg-gradient-to-b from-blue-50 via-white to-white">
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-blue-200/40 blur-3xl"></div>
    <div class="absolute top-40 -left-24 w-72 h-72 rounded-full bg-sky-200/40 blur-3xl"></div>

    <div class="relative max-w-6xl mx-auto px-4 py-14 md:py-24 grid lg:grid-cols-2 gap-14 items-center">
      <div>
        <span class="inline-flex items-center gap-1.5 rounded-full bg-white ring-1 ring-blue-100 text-blue-700 px-3 py-1.5 text-xs font-semibold mb-6 shadow-sm">
          <span class="material-symbols-rounded text-[16px]">verified</span>Status servis bisa dipantau langsung
        </span>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight leading-[1.15] text-slate-900 mb-5">
          Servis laptop jelas, <span class="text-blue-600">tanpa tanya-tanya.</span>
        </h1>
        <p class="text-lg text-slate-600 mb-8 max-w-lg">
          Serahkan laptop ke toko, terima kode tiket, lalu pantau perkembangan servisnya kapan saja dari HP.
        </p>
        <div class="flex flex-wrap gap-3 mb-8">
          <a href="{{ route('cek-status') }}" class="rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold px-7 py-3.5 shadow-lg shadow-blue-600/25">Cek Status Servis</a>
          <a href="#cara-kerja" class="rounded-xl border border-slate-200 bg-white hover:bg-slate-50 font-semibold px-7 py-3.5">Lihat Cara Kerja</a>
        </div>
        <ul class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-slate-600 font-medium">
          <li class="flex items-center gap-1.5"><span class="material-symbols-rounded text-[18px] text-emerald-500">check_circle</span>Tanpa daftar akun</li>
          <li class="flex items-center gap-1.5"><span class="material-symbols-rounded text-[18px] text-emerald-500">check_circle</span>Kode tiket dari nota atau WA</li>
          <li class="flex items-center gap-1.5"><span class="material-symbols-rounded text-[18px] text-emerald-500">check_circle</span>Riwayat status tercatat</li>
        </ul>
      </div>

      <div class="relative">
        <div class="bg-white rounded-3xl shadow-xl shadow-blue-900/10 ring-1 ring-slate-900/5 p-6 md:p-8">
          <div class="flex items-start justify-between gap-3 mb-6">
            <div class="flex items-center gap-3">
              <span class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center"><span class="material-symbols-rounded">laptop_mac</span></span>
              <div>
                <p class="text-xs text-slate-500">Lacak Servis</p>
                <p class="font-bold text-slate-900 text-lg leading-tight">Asus A416</p>
              </div>
            </div>
            <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 text-blue-700 px-3 py-1 text-xs font-semibold">
              <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>Dikerjakan
            </span>
          </div>

          <div class="flex items-center mb-6">
            @foreach (range(1, 5) as $n)
              <span class="w-9 h-9 shrink-0 rounded-full flex items-center justify-center text-xs font-bold {{ $n < 3 ? 'bg-blue-600 text-white' : ($n === 3 ? 'bg-blue-600 text-white ring-4 ring-blue-100' : 'bg-slate-100 text-slate-400') }}">
                @if ($n < 3)
                  <span class="material-symbols-rounded text-[18px]">check</span>
                @elseif ($n === 3)
                  <span class="material-symbols-rounded text-[18px]">settings</span>
                @else
                  {{ $n }}
                @endif
              </span>
              @unless ($loop->last)
                <span class="flex-1 h-1 rounded-full {{ $n < 3 ? 'bg-blue-600' : 'bg-slate-100' }}"></span>
              @endunless
            @endforeach
          </div>

          <div class="divide-y divide-slate-100 border-t border-slate-100 text-sm">
            <div class="flex justify-between py-3"><span class="text-slate-500">Kode tiket</span><span class="font-mono font-bold text-slate-900">SRV-0001</span></div>
            <div class="flex justify-between py-3"><span class="text-slate-500">Diterima</span><span class="font-semibold text-slate-900">16 Nov 2026</span></div>
          </div>
        </div>

        <div class="absolute -bottom-5 -left-3 md:-left-6 bg-white rounded-2xl shadow-lg ring-1 ring-slate-900/5 px-4 py-3 flex items-center gap-3">
          <span class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center"><span class="material-symbols-rounded">notifications_active</span></span>
          <div>
            <p class="text-xs text-slate-500">Kabar dari toko</p>
            <p class="text-sm font-bold text-slate-900">Link status dikirim via WA</p>
          </div>
        </div>
        <p class="text-center text-xs text-slate-500 mt-10">Ilustrasi tampilan cek status</p>
      </div>
    </div>
  </section>

  <section id="cara-kerja" class="max-w-6xl mx-auto px-4 py-14 md:py-20">
    <div class="text-center mb-12">
      <p class="text-sm font-semibold text-blue-600 mb-2">Alur</p>
      <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Cara Kerja</h2>
      <p class="text-slate-500">Empat langkah sederhana dari laptop diserahkan sampai diambil.</p>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      @foreach ([
        ['inventory_2', '1', 'Serahkan laptop ke toko', 'Petugas mencatat keluhan dan kelengkapan laptop Anda.'],
        ['confirmation_number', '2', 'Terima kode tiket', 'Kode tiket diberikan lewat nota atau pesan WhatsApp.'],
        ['location_searching', '3', 'Pantau status servis', 'Masukkan kode tiket di halaman cek status kapan saja.'],
        ['task_alt', '4', 'Ambil laptop', 'Datang ke toko setelah status berubah menjadi Selesai.'],
      ] as [$ikon, $no, $judul, $isi])
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 p-6 hover:shadow-md transition">
          <div class="flex items-center justify-between mb-5">
            <span class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center"><span class="material-symbols-rounded">{{ $ikon }}</span></span>
            <span class="text-4xl font-extrabold text-slate-100">{{ $no }}</span>
          </div>
          <h3 class="font-bold text-slate-900 mb-1">{{ $judul }}</h3>
          <p class="text-sm text-slate-500">{{ $isi }}</p>
        </div>
      @endforeach
    </div>
  </section>

  <section id="keunggulan" class="bg-white border-y border-slate-100">
    <div class="max-w-6xl mx-auto px-4 py-14 md:py-20">
      <div class="text-center mb-12">
        <p class="text-sm font-semibold text-blue-600 mb-2">Mengapa</p>
        <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Keunggulan</h2>
        <p class="text-slate-500">Dibuat supaya pelanggan dan toko sama-sama tenang.</p>
      </div>
      <div class="grid md:grid-cols-3 gap-5">
        @foreach ([
          ['timeline', 'Status jelas per tahap', 'Dari diterima, diperiksa, dikerjakan, selesai, sampai sudah diambil.'],
          ['history', 'Riwayat tercatat rapi', 'Setiap perubahan status tersimpan lengkap dengan tanggal dan jamnya.'],
          ['no_accounts', 'Tanpa daftar akun', 'Pelanggan cukup memakai kode tiket, tanpa registrasi atau kata sandi.'],
        ] as [$ikon, $judul, $isi])
          <div class="rounded-2xl bg-slate-50 ring-1 ring-slate-900/5 p-7">
            <span class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center mb-5 shadow-sm shadow-blue-600/30"><span class="material-symbols-rounded">{{ $ikon }}</span></span>
            <h3 class="font-bold text-slate-900 mb-1">{{ $judul }}</h3>
            <p class="text-sm text-slate-500">{{ $isi }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="max-w-6xl mx-auto px-4 py-14 md:py-20">
    <div class="rounded-3xl bg-gradient-to-br from-[#10294F] to-blue-600 text-white px-8 py-12 text-center">
      <h2 class="text-2xl md:text-3xl font-extrabold mb-2">Sudah punya kode tiket?</h2>
      <p class="text-blue-100 mb-7">Cek perkembangan servis laptop Anda sekarang.</p>
      <a href="{{ route('cek-status') }}" class="inline-flex rounded-xl bg-white text-blue-700 hover:bg-blue-50 font-semibold px-7 py-3.5">Cek Status Servis</a>
    </div>
  </section>
</main>

@include('partials.footer-publik')
@endsection