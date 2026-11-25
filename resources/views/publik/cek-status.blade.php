@extends('layouts.publik')
@section('title', 'Cek Status Servis')

@section('isi')
<div class="mb-space-lg">
  <h1 class="font-headline-lg text-headline-lg mb-space-xs">Cek Status Servis</h1>
  <p class="text-on-surface-variant max-w-[620px]">Masukkan kode tiket dari nota atau pesan WhatsApp toko untuk melihat perkembangan servis laptop Anda.</p>
</div>

<form method="GET" action="{{ route('cek-status') }}" class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-md md:p-space-lg mb-space-lg">
  <label for="kode" class="block font-label-md text-label-md mb-1">Kode tiket servis</label>
  <div class="flex flex-col sm:flex-row gap-space-sm">
    <input id="kode" name="kode" value="{{ $kode }}" placeholder="Contoh: SRV-0001" autocomplete="off"
      class="flex-1 font-ticket-code text-ticket-code uppercase px-3 py-2.5 rounded-lg border border-outline-variant focus:border-primary-container focus:outline-none">
    <button type="submit" class="h-[42px] px-space-lg bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-md text-label-md">Cek Status</button>
  </div>
  <p class="font-body-sm text-body-sm text-on-surface-variant mt-space-sm">Demi privasi, nomor telepon dan rincian keluhan tidak ditampilkan.</p>
</form>

@if ($kode === '')
  <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-xl text-center">
    <h2 class="font-headline-sm text-headline-sm mb-space-xs">Cari status tiket Anda</h2>
    <p class="text-on-surface-variant">Masukkan kode tiket dari nota atau pesan WhatsApp toko pada kolom di atas.</p>
  </div>

@elseif (! $servis)
  <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-xl text-center">
    <h2 class="font-headline-sm text-headline-sm mb-space-xs">Kode tiket tidak ditemukan</h2>
    <p class="text-on-surface-variant">Periksa kode di nota atau pesan WhatsApp dari toko, lalu coba lagi.</p>
  </div>

@else
  @php
    $riwayat = $servis->riwayat->keyBy('status');
    $selesai = $servis->status >= 3;
  @endphp

  <div class="relative bg-secondary-container rounded-xl p-space-lg mb-space-md">
    <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-secondary-container block">Kode tiket</span>
    <div class="font-ticket-code text-[28px] leading-tight text-on-secondary-container tracking-wider">{{ $servis->kode_tiket }}</div>
    <p class="text-on-secondary-container font-medium mt-1">{{ $servis->merk_tipe }}</p>
  </div>

  <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-md md:p-space-lg">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-space-md pb-space-lg border-b border-outline-variant">
      <div>
        <span class="font-label-sm text-label-sm text-on-surface-variant block mb-1">Status</span>
        <span class="inline-block px-2.5 py-1 rounded font-label-md text-label-md {{ $selesai ? 'bg-tertiary-fixed text-tertiary' : 'bg-surface-container text-primary' }}">
          {{ \App\Models\Servis::STATUS[$servis->status] }}
        </span>
      </div>
      <div>
        <span class="font-label-sm text-label-sm text-on-surface-variant block mb-1">Tanggal diterima</span>
        <span class="font-semibold">{{ $servis->tgl_diterima->format('d M Y') }}</span>
      </div>
      <div>
        <span class="font-label-sm text-label-sm text-on-surface-variant block mb-1">Tanggal selesai</span>
        <span class="font-semibold">{{ $servis->tgl_selesai ? $servis->tgl_selesai->format('d M Y') : '-' }}</span>
      </div>
      <div>
        <span class="font-label-sm text-label-sm text-on-surface-variant block mb-1">Biaya servis</span>
        <span class="font-headline-sm text-headline-sm text-primary-container">{{ $servis->harga !== null ? 'Rp ' . number_format($servis->harga, 0, ',', '.') : '-' }}</span>
      </div>
    </div>

    <h2 class="font-headline-sm text-headline-sm mt-space-lg mb-space-lg">Alur progres pengerjaan</h2>
    <ol class="relative pl-6 space-y-space-lg">
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
@endif
@endsection