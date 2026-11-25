@extends('layouts.petugas')
@section('title', 'Daftar Servis')

@section('isi')
<div class="flex items-center justify-between gap-space-sm mb-space-lg flex-wrap">
  <h1 class="font-headline-lg text-headline-lg">Daftar Servis</h1>
  <a href="{{ route('servis.create') }}" class="inline-flex items-center h-10 px-space-md bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-md text-label-md">Servis baru</a>
</div>

<form method="GET" class="flex flex-col sm:flex-row gap-space-sm mb-space-md">
  <input type="text" name="q" value="{{ $q }}" placeholder="Cari kode tiket, nama, atau nomor WA"
    class="flex-1 px-3 py-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest focus:border-primary-container focus:outline-none">
  <select name="status" class="px-3 py-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest">
    <option value="">Semua status</option>
    @foreach (\App\Models\Servis::STATUS as $i => $nama)
      <option value="{{ $i }}" @selected((string) $status === (string) $i)>{{ $nama }}</option>
    @endforeach
  </select>
  <button type="submit" class="h-[42px] px-space-md rounded-lg border border-outline-variant font-label-md text-label-md hover:bg-surface-container-low">Cari</button>
</form>

<div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-x-auto">
  <table class="w-full min-w-[560px] text-left">
    <thead>
      <tr class="border-b border-outline-variant font-label-sm text-label-sm text-on-surface-variant">
        <th class="px-4 py-3">Kode</th>
        <th class="px-4 py-3">Pelanggan</th>
        <th class="px-4 py-3">Laptop</th>
        <th class="px-4 py-3">Diterima</th>
        <th class="px-4 py-3">Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($daftar as $s)
        <tr class="border-b border-outline-variant last:border-0 hover:bg-surface-container-low cursor-pointer" onclick="location.href='{{ route('servis.show', $s) }}'">
          <td class="px-4 py-3 font-ticket-code text-ticket-code"><a href="{{ route('servis.show', $s) }}">{{ $s->kode_tiket }}</a></td>
          <td class="px-4 py-3">{{ $s->nama_pelanggan }}</td>
          <td class="px-4 py-3">{{ $s->merk_tipe }}</td>
          <td class="px-4 py-3">{{ $s->tgl_diterima->format('d M Y') }}</td>
          <td class="px-4 py-3">
            <span class="px-2.5 py-0.5 rounded-full font-label-sm text-label-sm {{ $s->status >= 3 ? 'bg-tertiary-fixed text-tertiary' : 'bg-surface-container text-primary' }}">
              {{ \App\Models\Servis::STATUS[$s->status] }}
            </span>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="px-4 py-6 text-center text-on-surface-variant">Tidak ada servis yang cocok. Coba kata kunci lain atau buat servis baru.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-space-md">{{ $daftar->links() }}</div>
@endsection