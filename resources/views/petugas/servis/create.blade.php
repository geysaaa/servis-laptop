@extends('layouts.petugas')
@section('title', 'Servis Baru')

@php
  $in = 'w-full rounded-xl border border-slate-200 bg-white px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100';
  $lb = 'block text-sm font-semibold text-slate-700 mb-1.5';
  $er = 'text-sm text-red-600 mt-1.5';
@endphp

@section('isi')
<div class="mb-6">
  <h1 class="text-2xl font-extrabold text-slate-900">Servis Baru</h1>
  <p class="text-slate-500">Catat laptop yang baru diterima. Kode tiket dibuat otomatis.</p>
</div>

<form method="POST" action="{{ route('servis.store') }}" class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 max-w-3xl">
  @csrf
  <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
      <label for="nama_pelanggan" class="{{ $lb }}">Nama pelanggan</label>
      <input id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" class="{{ $in }}">
      @error('nama_pelanggan')<p class="{{ $er }}">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="no_wa" class="{{ $lb }}">Nomor WhatsApp</label>
      <input id="no_wa" name="no_wa" value="{{ old('no_wa') }}" inputmode="tel" placeholder="08xxxxxxxxxx" class="{{ $in }}">
      @error('no_wa')<p class="{{ $er }}">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="merk_tipe" class="{{ $lb }}">Merk dan tipe laptop</label>
      <input id="merk_tipe" name="merk_tipe" value="{{ old('merk_tipe') }}" class="{{ $in }}">
      @error('merk_tipe')<p class="{{ $er }}">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="tgl_diterima" class="{{ $lb }}">Tanggal diterima</label>
      <input id="tgl_diterima" name="tgl_diterima" type="date" value="{{ old('tgl_diterima', now()->toDateString()) }}" class="{{ $in }}">
      @error('tgl_diterima')<p class="{{ $er }}">{{ $message }}</p>@enderror
    </div>
    <div class="md:col-span-2">
      <label for="keluhan" class="{{ $lb }}">Keluhan</label>
      <textarea id="keluhan" name="keluhan" rows="3" class="{{ $in }}">{{ old('keluhan') }}</textarea>
      @error('keluhan')<p class="{{ $er }}">{{ $message }}</p>@enderror
    </div>
    <div class="md:col-span-2">
      <label for="kelengkapan" class="{{ $lb }}">Kelengkapan (opsional)</label>
      <input id="kelengkapan" name="kelengkapan" value="{{ old('kelengkapan') }}" placeholder="Charger, tas" class="{{ $in }}">
      @error('kelengkapan')<p class="{{ $er }}">{{ $message }}</p>@enderror
    </div>
  </div>

  <div class="px-6 md:px-8 py-5 border-t border-slate-100 flex gap-3">
    <button type="submit" class="rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 shadow-sm shadow-blue-600/25">Simpan dan buat tiket</button>
    <a href="{{ route('servis.index') }}" class="rounded-xl border border-slate-200 hover:bg-slate-50 font-semibold px-6 py-3">Batal</a>
  </div>
</form>
@endsection