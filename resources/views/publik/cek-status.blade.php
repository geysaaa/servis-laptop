@extends('layouts.publik')
@section('title', 'Cek Status Servis')

@section('isi')
<div class="text-center mb-8">
  <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 text-blue-700 px-3 py-1 text-xs font-semibold mb-4">
    <span class="material-symbols-rounded text-[16px]">verified</span>Pelacak servis laptop
  </span>
  <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900">Cek Status Servis</h1>
  <p class="text-slate-500 mt-2 max-w-lg mx-auto">Masukkan kode tiket dari nota atau pesan WhatsApp toko untuk melihat perkembangan servis laptop Anda.</p>
</div>

<form method="GET" action="{{ route('cek-status') }}" class="bg-white rounded-2xl shadow-lg shadow-blue-900/5 ring-1 ring-slate-900/5 p-3 flex flex-col sm:flex-row gap-3 mb-3">
  <div class="relative flex-1">
    <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">confirmation_number</span>
    <input id="kode" name="kode" value="{{ $kode }}" placeholder="Contoh: SRV-0001" autocomplete="off"
      class="w-full rounded-xl border border-slate-200 bg-white pl-12 pr-4 py-3.5 font-mono font-bold uppercase tracking-wider focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
  </div>
  <button type="submit" class="rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3.5 shadow-sm shadow-blue-600/25">Cek Status</button>
</form>
<p class="text-center text-xs text-slate-500 mb-8">Demi privasi, nomor telepon dan rincian keluhan tidak ditampilkan.</p>

@if ($kode === '')
  <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 p-10 text-center">
    <span class="w-14 h-14 mx-auto rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4"><span class="material-symbols-rounded text-[30px]">location_searching</span></span>
    <h2 class="font-bold text-slate-900 mb-1">Cari status tiket Anda</h2>
    <p class="text-slate-500 text-sm">Masukkan kode tiket pada kolom di atas untuk melihat progres servis.</p>
  </div>

@elseif (! $servis)
  <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 p-10 text-center">
    <span class="w-14 h-14 mx-auto rounded-2xl bg-red-50 text-red-600 flex items-center justify-center mb-4"><span class="material-symbols-rounded text-[30px]">search_off</span></span>
    <h2 class="font-bold text-slate-900 mb-1">Kode tiket tidak ditemukan</h2>
    <p class="text-slate-500 text-sm">Periksa kode di nota atau pesan WhatsApp dari toko, lalu coba lagi.</p>
  </div>

@else
  <div class="rounded-2xl bg-gradient-to-br from-[#10294F] via-[#1D4ED8] to-blue-500 text-white p-6 md:p-8 mb-5 shadow-lg shadow-blue-900/10">
    <div class="flex flex-wrap items-start justify-between gap-4">
      <div>
        <p class="text-xs font-semibold uppercase tracking-widest text-blue-100/80">Kode tiket</p>
        <p class="font-mono text-4xl font-bold tracking-wider mt-1">{{ $servis->kode_tiket }}</p>
        <p class="text-blue-100 mt-1">{{ $servis->merk_tipe }}</p>
      </div>
      <span class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold">
        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>{{ \App\Models\Servis::STATUS[$servis->status] }}
      </span>
    </div>
  </div>

  <div class="grid grid-cols-3 gap-3 mb-5">
    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 p-4">
      <p class="text-xs font-medium text-slate-500">Diterima</p>
      <p class="font-bold text-slate-900 mt-1">{{ $servis->tgl_diterima->translatedFormat('d M Y') }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 p-4">
      <p class="text-xs font-medium text-slate-500">Selesai</p>
      <p class="font-bold text-slate-900 mt-1">{{ $servis->tgl_selesai ? $servis->tgl_selesai->translatedFormat('d M Y') : '-' }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 p-4">
      <p class="text-xs font-medium text-slate-500">Biaya servis</p>
      <p class="font-bold text-blue-600 mt-1">{{ $servis->harga !== null ? 'Rp ' . number_format($servis->harga, 0, ',', '.') : '-' }}</p>
    </div>
  </div>

  <section class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5">
    <h2 class="px-6 py-5 font-bold text-slate-900">Alur progres pengerjaan</h2>
    <div class="border-t border-slate-100 pt-4">
      <x-timeline :servis="$servis" />
    </div>
  </section>
@endif
@endsection