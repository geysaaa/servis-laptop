@extends('layouts.petugas')
@section('title', 'Servis Baru')

@php
  $in = 'w-full px-3 py-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest focus:border-primary-container focus:outline-none';
@endphp

@section('isi')
<h1 class="font-headline-lg text-headline-lg mb-space-lg">Servis Baru</h1>

<form method="POST" action="{{ route('servis.store') }}" class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-lg">
  @csrf
  <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
    <div>
      <label for="nama_pelanggan" class="block font-label-md text-label-md mb-1">Nama pelanggan</label>
      <input id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" class="{{ $in }}">
      @error('nama_pelanggan')<p class="font-body-sm text-body-sm text-error mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="no_wa" class="block font-label-md text-label-md mb-1">Nomor WhatsApp</label>
      <input id="no_wa" name="no_wa" value="{{ old('no_wa') }}" inputmode="tel" placeholder="08xxxxxxxxxx" class="{{ $in }}">
      @error('no_wa')<p class="font-body-sm text-body-sm text-error mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="merk_tipe" class="block font-label-md text-label-md mb-1">Merk dan tipe laptop</label>
      <input id="merk_tipe" name="merk_tipe" value="{{ old('merk_tipe') }}" class="{{ $in }}">
      @error('merk_tipe')<p class="font-body-sm text-body-sm text-error mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="tgl_diterima" class="block font-label-md text-label-md mb-1">Tanggal diterima</label>
      <input id="tgl_diterima" name="tgl_diterima" type="date" value="{{ old('tgl_diterima', now()->toDateString()) }}" class="{{ $in }}">
      @error('tgl_diterima')<p class="font-body-sm text-body-sm text-error mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="md:col-span-2">
      <label for="keluhan" class="block font-label-md text-label-md mb-1">Keluhan</label>
      <textarea id="keluhan" name="keluhan" rows="3" class="{{ $in }}">{{ old('keluhan') }}</textarea>
      @error('keluhan')<p class="font-body-sm text-body-sm text-error mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="md:col-span-2">
      <label for="kelengkapan" class="block font-label-md text-label-md mb-1">Kelengkapan (opsional)</label>
      <input id="kelengkapan" name="kelengkapan" value="{{ old('kelengkapan') }}" placeholder="Charger, tas" class="{{ $in }}">
      @error('kelengkapan')<p class="font-body-sm text-body-sm text-error mt-1">{{ $message }}</p>@enderror
    </div>
  </div>

  <div class="flex gap-space-sm mt-space-lg">
    <button type="submit" class="h-10 px-space-md bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-md text-label-md">Simpan dan buat tiket</button>
    <a href="{{ route('servis.index') }}" class="inline-flex items-center h-10 px-space-md border border-outline-variant rounded-lg font-label-md text-label-md">Batal</a>
  </div>
</form>
@endsection