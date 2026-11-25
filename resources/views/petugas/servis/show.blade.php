@extends('layouts.petugas')
@section('title', $servis->kode_tiket)

@php
  $in = 'w-full px-3 py-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest focus:border-primary-container focus:outline-none';
  $riwayat = $servis->riwayat->keyBy('status');
  $nomor = str_starts_with($servis->no_wa, '0') ? '62' . substr($servis->no_wa, 1) : $servis->no_wa;
  $pesan = "Halo {$servis->nama_pelanggan}, laptop {$servis->merk_tipe} Anda ({$servis->kode_tiket}) saat ini berstatus "
         . \App\Models\Servis::STATUS[$servis->status]
         . ". Cek perkembangan servis dengan kode tiket {$servis->kode_tiket}.";
  $linkWa = 'https://wa.me/' . $nomor . '?text=' . rawurlencode($pesan);
@endphp

@section('isi')
@if (session('baru'))
  <div class="mb-space-md p-space-md rounded-xl bg-tertiary-fixed text-tertiary font-label-md text-label-md">
    Tiket servis dibuat. Berikan kode ini kepada pelanggan.
  </div>
@endif
@if (session('tersimpan'))
  <div class="mb-space-md p-space-md rounded-xl bg-tertiary-fixed text-tertiary font-label-md text-label-md">
    Perubahan disimpan.
  </div>
@endif

<a href="{{ route('servis.index') }}" class="font-body-sm text-body-sm text-primary">&larr; Kembali ke daftar</a>

<div class="relative bg-secondary-container rounded-xl p-space-lg mt-space-sm mb-space-lg">
  <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-secondary-container block">Kode tiket</span>
  <div class="font-ticket-code text-[28px] leading-tight text-on-secondary-container tracking-wider">{{ $servis->kode_tiket }}</div>
  <p class="text-on-secondary-container font-medium mt-1">{{ $servis->merk_tipe }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
  <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-lg">
    <h2 class="font-headline-sm text-headline-sm mb-space-sm">Data servis</h2>
    <dl class="grid grid-cols-[110px_1fr] gap-y-1 gap-x-3">
      <dt class="text-on-surface-variant">Pelanggan</dt><dd>{{ $servis->nama_pelanggan }}</dd>
      <dt class="text-on-surface-variant">WhatsApp</dt><dd>{{ $servis->no_wa }}</dd>
      <dt class="text-on-surface-variant">Keluhan</dt><dd>{{ $servis->keluhan }}</dd>
      <dt class="text-on-surface-variant">Kelengkapan</dt><dd>{{ $servis->kelengkapan ?: '-' }}</dd>
      <dt class="text-on-surface-variant">Diterima</dt><dd>{{ $servis->tgl_diterima->format('d M Y') }}</dd>
      <dt class="text-on-surface-variant">Selesai</dt><dd>{{ $servis->tgl_selesai ? $servis->tgl_selesai->format('d M Y') : '-' }}</dd>
      <dt class="text-on-surface-variant">Biaya</dt><dd>{{ $servis->harga !== null ? 'Rp ' . number_format($servis->harga, 0, ',', '.') : '-' }}</dd>
    </dl>
  </div>

  <form method="POST" action="{{ route('servis.update', $servis) }}" class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-lg">
    @csrf
    @method('PUT')
    <h2 class="font-headline-sm text-headline-sm mb-space-sm">Perbarui servis</h2>

    <div class="space-y-space-md">
      <div>
        <label for="status" class="block font-label-md text-label-md mb-1">Status</label>
        <select id="status" name="status" class="{{ $in }}">
          @foreach (\App\Models\Servis::STATUS as $i => $nama)
            <option value="{{ $i }}" @selected((int) old('status', $servis->status) === $i)>{{ $nama }}</option>
          @endforeach
        </select>
        @error('status')<p class="font-body-sm text-body-sm text-error mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label for="tgl_selesai" class="block font-label-md text-label-md mb-1">Tanggal selesai</label>
        <input id="tgl_selesai" name="tgl_selesai" type="date" value="{{ old('tgl_selesai', $servis->tgl_selesai?->toDateString()) }}" class="{{ $in }}">
        @error('tgl_selesai')<p class="font-body-sm text-body-sm text-error mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label for="harga" class="block font-label-md text-label-md mb-1">Harga servis (Rp)</label>
        <input id="harga" name="harga" type="number" min="0" step="1000" value="{{ old('harga', $servis->harga) }}" class="{{ $in }}">
        @error('harga')<p class="font-body-sm text-body-sm text-error mt-1">{{ $message }}</p>@enderror
      </div>
    </div>

    <div class="flex flex-wrap gap-space-sm mt-space-lg">
      <button type="submit" class="h-10 px-space-md bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-md text-label-md">Simpan perubahan</button>
      <a href="{{ $linkWa }}" target="_blank" rel="noopener" class="inline-flex items-center h-10 px-space-md border border-outline-variant rounded-lg font-label-md text-label-md hover:bg-surface-container-low">Kirim link ke WA</a>
    </div>
  </form>
</div>

<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-lg mt-space-md">
  <h2 class="font-headline-sm text-headline-sm mb-space-md">Riwayat status</h2>
  <ol class="relative pl-6 space-y-space-md">
    <div aria-hidden="true" class="absolute left-3 top-2 bottom-3 w-[2px] bg-outline-variant -translate-x-1/2"></div>
    @foreach (\App\Models\Servis::STATUS as $i => $nama)
      @php
        $h = $riwayat->get($i);
        $lewat = $i < $servis->status;
        $sekarang = $i === $servis->status;
      @endphp
      <li class="relative flex items-start justify-between gap-space-sm {{ $i > $servis->status ? 'opacity-60' : '' }}">
        @if ($sekarang)
          <span class="absolute -left-6 top-0.5 w-6 h-6 rounded-full bg-primary-container ring-4 ring-primary-fixed"></span>
        @elseif ($lewat)
          <span class="absolute -left-6 top-0.5 w-6 h-6 rounded-full bg-primary-container ring-4 ring-surface-container-lowest"></span>
        @else
          <span class="absolute -left-6 top-0.5 w-6 h-6 rounded-full bg-surface-container-lowest border-2 border-outline-variant ring-4 ring-surface-container-lowest"></span>
        @endif
        <span class="{{ $sekarang ? 'font-bold text-primary' : '' }}">{{ $i + 1 }}. {{ $nama }}</span>
        <span class="font-body-sm text-body-sm text-on-surface-variant">{{ $h ? $h->waktu->format('d M Y, H:i') : '' }}</span>
      </li>
    @endforeach
  </ol>
</div>
@endsection