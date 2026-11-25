@extends('layouts.petugas')
@section('title', $servis->kode_tiket)

@section('isi')
@if (session('baru'))
  <div class="mb-space-md p-space-md rounded-xl bg-tertiary-fixed text-tertiary font-label-md text-label-md">
    Tiket servis dibuat. Berikan kode ini kepada pelanggan.
  </div>
@endif

<h1 class="font-ticket-code text-[28px] mb-space-xs">{{ $servis->kode_tiket }}</h1>
<p class="mb-space-md">{{ \App\Models\Servis::STATUS[$servis->status] }}</p>

<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-lg space-y-1">
  <p><b>Pelanggan:</b> {{ $servis->nama_pelanggan }} ({{ $servis->no_wa }})</p>
  <p><b>Laptop:</b> {{ $servis->merk_tipe }}</p>
  <p><b>Keluhan:</b> {{ $servis->keluhan }}</p>
  <p><b>Kelengkapan:</b> {{ $servis->kelengkapan ?: '-' }}</p>
  <p><b>Diterima:</b> {{ $servis->tgl_diterima->format('d M Y') }}</p>
</div>

<h2 class="font-headline-sm text-headline-sm mt-space-lg mb-space-sm">Riwayat status</h2>
<ul class="space-y-1">
  @foreach ($servis->riwayat as $r)
    <li>{{ \App\Models\Servis::STATUS[$r->status] }} <span class="text-on-surface-variant">({{ $r->waktu->format('d M Y H:i') }})</span></li>
  @endforeach
</ul>
@endsection