@extends('layouts.petugas')
@section('title', $servis->kode_tiket)

@php
  $in = 'w-full rounded-xl border border-slate-200 bg-white px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100';
  $lb = 'block text-sm font-semibold text-slate-700 mb-1.5';
  $er = 'text-sm text-red-600 mt-1.5';
  $nomor = str_starts_with($servis->no_wa, '0') ? '62' . substr($servis->no_wa, 1) : $servis->no_wa;
  $pesan = "Halo {$servis->nama_pelanggan}, laptop {$servis->merk_tipe} Anda ({$servis->kode_tiket}) saat ini berstatus "
         . \App\Models\Servis::STATUS[$servis->status]
         . ". Cek perkembangan servis dengan kode tiket {$servis->kode_tiket}.";
  $linkWa = 'https://wa.me/' . $nomor . '?text=' . rawurlencode($pesan);
@endphp

@section('isi')
@if (session('baru') || session('tersimpan'))
  <div class="mb-5 flex items-center gap-3 rounded-xl bg-emerald-50 text-emerald-800 px-4 py-3 text-sm font-semibold">
    <span class="material-symbols-rounded text-[22px]">check_circle</span>
    {{ session('baru') ? 'Tiket servis dibuat. Berikan kode ini kepada pelanggan.' : 'Perubahan disimpan.' }}
  </div>
@endif

<a href="{{ route('servis.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:text-blue-700">
  <span class="material-symbols-rounded text-[18px]">arrow_back</span>Kembali ke daftar
</a>

<div class="rounded-2xl bg-gradient-to-br from-[#10294F] via-[#1D4ED8] to-blue-500 text-white p-6 md:p-8 mt-3 mb-6 shadow-lg shadow-blue-900/10">
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
  <p class="mt-6 pt-4 border-t border-white/20 text-sm text-blue-100">Diterima {{ $servis->tgl_diterima->translatedFormat('d F Y') }}</p>
</div>

<div class="grid md:grid-cols-2 gap-6 items-start">
  <section class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5">
    <h2 class="px-6 py-5 font-bold text-slate-900">Data servis</h2>
    <dl class="divide-y divide-slate-100 border-t border-slate-100 text-sm">
      <div class="grid grid-cols-[110px_1fr] gap-3 px-6 py-3"><dt class="text-slate-500">Pelanggan</dt><dd class="font-medium text-slate-900">{{ $servis->nama_pelanggan }}</dd></div>
      <div class="grid grid-cols-[110px_1fr] gap-3 px-6 py-3"><dt class="text-slate-500">WhatsApp</dt><dd class="font-medium text-slate-900">{{ $servis->no_wa }}</dd></div>
      <div class="grid grid-cols-[110px_1fr] gap-3 px-6 py-3"><dt class="text-slate-500">Keluhan</dt><dd class="font-medium text-slate-900">{{ $servis->keluhan }}</dd></div>
      <div class="grid grid-cols-[110px_1fr] gap-3 px-6 py-3"><dt class="text-slate-500">Kelengkapan</dt><dd class="font-medium text-slate-900">{{ $servis->kelengkapan ?: '-' }}</dd></div>
      <div class="grid grid-cols-[110px_1fr] gap-3 px-6 py-3"><dt class="text-slate-500">Selesai</dt><dd class="font-medium text-slate-900">{{ $servis->tgl_selesai ? $servis->tgl_selesai->translatedFormat('d F Y') : '-' }}</dd></div>
      <div class="grid grid-cols-[110px_1fr] gap-3 px-6 py-3"><dt class="text-slate-500">Biaya</dt><dd class="font-medium text-slate-900">{{ $servis->harga !== null ? 'Rp ' . number_format($servis->harga, 0, ',', '.') : '-' }}</dd></div>
    </dl>
  </section>

  <form method="POST" action="{{ route('servis.update', $servis) }}" class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5">
    @csrf
    @method('PUT')
    <h2 class="px-6 py-5 font-bold text-slate-900">Perbarui servis</h2>
    <div class="px-6 pb-6 space-y-4 border-t border-slate-100 pt-5">
      <div>
        <label for="status" class="{{ $lb }}">Status</label>
        <select id="status" name="status" class="{{ $in }}">
          @foreach (\App\Models\Servis::STATUS as $i => $nama)
            <option value="{{ $i }}" @selected((int) old('status', $servis->status) === $i)>{{ $nama }}</option>
          @endforeach
        </select>
        @error('status')<p class="{{ $er }}">{{ $message }}</p>@enderror
      </div>
      <div>
        <label for="tgl_selesai" class="{{ $lb }}">Tanggal selesai</label>
        <input id="tgl_selesai" name="tgl_selesai" type="date" value="{{ old('tgl_selesai', $servis->tgl_selesai?->toDateString()) }}" class="{{ $in }}">
        @error('tgl_selesai')<p class="{{ $er }}">{{ $message }}</p>@enderror
      </div>
      <div>
        <label for="harga" class="{{ $lb }}">Harga servis (Rp)</label>
        <input id="harga" name="harga" type="number" min="0" step="1000" value="{{ old('harga', $servis->harga) }}" class="{{ $in }}">
        @error('harga')<p class="{{ $er }}">{{ $message }}</p>@enderror
      </div>
      <div class="flex flex-wrap gap-3 pt-2">
        <button type="submit" class="rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 shadow-sm shadow-blue-600/25">Simpan perubahan</button>
        <a href="{{ $linkWa }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 hover:bg-slate-50 font-semibold px-5 py-3">
          <span class="material-symbols-rounded text-[20px] text-emerald-600">chat</span>Kirim link ke WA
        </a>
      </div>
    </div>
  </form>
</div>

<section class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 mt-6">
  <h2 class="px-6 py-5 font-bold text-slate-900">Riwayat status</h2>
  <div class="border-t border-slate-100 pt-4">
    <x-timeline :servis="$servis" />
  </div>
</section>
@endsection