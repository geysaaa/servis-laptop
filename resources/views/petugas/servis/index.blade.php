@extends('layouts.petugas')
@section('title', 'Daftar Servis')

@section('isi')
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
  <div>
    <h1 class="text-2xl font-extrabold text-slate-900">Daftar Servis</h1>
    <p class="text-slate-500">Semua laptop yang masuk ke toko.</p>
  </div>
  <a href="{{ route('servis.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-3 shadow-sm shadow-blue-600/25">
    <span class="material-symbols-rounded text-[20px]">add</span>Servis baru
  </a>
</div>

<form method="GET" class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 p-3 flex flex-col sm:flex-row gap-3 mb-4">
  <div class="relative flex-1">
    <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
    <input type="text" name="q" value="{{ $q }}" placeholder="Cari kode tiket, nama, atau nomor WA"
      class="w-full rounded-xl border border-slate-200 bg-white pl-11 pr-4 py-2.5 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
  </div>
  <select name="status" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
    <option value="">Semua status</option>
    @foreach (\App\Models\Servis::STATUS as $i => $nama)
      <option value="{{ $i }}" @selected((string) $status === (string) $i)>{{ $nama }}</option>
    @endforeach
  </select>
  <button type="submit" class="rounded-xl bg-slate-900 hover:bg-slate-700 text-white font-semibold px-6 py-2.5">Cari</button>
</form>

<div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 overflow-x-auto">
  <table class="w-full min-w-[620px] text-left text-sm">
    <thead>
      <tr class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
        <th class="px-6 py-3.5 font-semibold">Kode</th>
        <th class="px-6 py-3.5 font-semibold">Pelanggan</th>
        <th class="px-6 py-3.5 font-semibold">Laptop</th>
        <th class="px-6 py-3.5 font-semibold">Diterima</th>
        <th class="px-6 py-3.5 font-semibold">Status</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-slate-100">
      @forelse ($daftar as $s)
        <tr class="hover:bg-slate-50 cursor-pointer" onclick="location.href='{{ route('servis.show', $s) }}'">
          <td class="px-6 py-4 font-mono font-bold text-slate-900"><a href="{{ route('servis.show', $s) }}">{{ $s->kode_tiket }}</a></td>
          <td class="px-6 py-4 font-medium text-slate-900">{{ $s->nama_pelanggan }}</td>
          <td class="px-6 py-4">{{ $s->merk_tipe }}</td>
          <td class="px-6 py-4">{{ $s->tgl_diterima->translatedFormat('d M Y') }}</td>
          <td class="px-6 py-4"><x-status-badge :status="$s->status" /></td>
        </tr>
      @empty
        <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500">Tidak ada servis yang cocok. Coba kata kunci lain atau buat servis baru.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{{ $daftar->links() }}</div>
@endsection