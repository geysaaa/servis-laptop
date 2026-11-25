@extends('layouts.petugas')
@section('title', 'Dashboard')

@section('isi')
<div class="flex items-start justify-between gap-space-sm flex-wrap mb-space-lg">
  <div>
    <h1 class="font-headline-lg text-headline-lg">Halo, {{ auth()->user()->name }}</h1>
    <p class="text-on-surface-variant">Ringkasan servis yang sedang berjalan di toko.</p>
  </div>
  <a href="{{ route('servis.create') }}" class="inline-flex items-center h-10 px-space-md bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-md text-label-md">Servis baru</a>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-space-md mb-space-lg">
  @foreach ($ringkasan as $label => $jumlah)
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-md">
      <span class="font-label-sm text-label-sm text-on-surface-variant block mb-1">{{ $label }}</span>
      <span class="font-headline-lg text-headline-lg">{{ $jumlah }}</span>
    </div>
  @endforeach
</div>

<div class="bg-surface-container-lowest border border-outline-variant rounded-xl">
  <div class="flex items-center justify-between px-4 py-3 border-b border-outline-variant">
    <h2 class="font-headline-sm text-headline-sm">Servis terbaru</h2>
    <a href="{{ route('servis.index') }}" class="font-label-md text-label-md text-primary">Lihat semua</a>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full min-w-[480px] text-left">
      <thead>
        <tr class="border-b border-outline-variant font-label-sm text-label-sm text-on-surface-variant">
          <th class="px-4 py-3">Kode</th>
          <th class="px-4 py-3">Pelanggan</th>
          <th class="px-4 py-3">Laptop</th>
          <th class="px-4 py-3">Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($terbaru as $s)
          <tr class="border-b border-outline-variant last:border-0 hover:bg-surface-container-low cursor-pointer" onclick="location.href='{{ route('servis.show', $s) }}'">
            <td class="px-4 py-3 font-ticket-code text-ticket-code"><a href="{{ route('servis.show', $s) }}">{{ $s->kode_tiket }}</a></td>
            <td class="px-4 py-3">{{ $s->nama_pelanggan }}</td>
            <td class="px-4 py-3">{{ $s->merk_tipe }}</td>
            <td class="px-4 py-3">
              <span class="px-2.5 py-0.5 rounded-full font-label-sm text-label-sm {{ $s->status >= 3 ? 'bg-tertiary-fixed text-tertiary' : 'bg-surface-container text-primary' }}">
                {{ \App\Models\Servis::STATUS[$s->status] }}
              </span>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="px-4 py-6 text-center text-on-surface-variant">Belum ada servis. Klik Servis baru untuk mencatat laptop yang masuk.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection