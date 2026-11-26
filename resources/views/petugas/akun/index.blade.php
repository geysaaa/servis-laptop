@extends('layouts.petugas')
@section('title', 'Kelola Akun')

@section('isi')
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
  <div>
    <h1 class="text-2xl font-extrabold text-slate-900">Kelola Akun</h1>
    <p class="text-slate-500">Akun yang bisa masuk ke aplikasi. Halaman ini khusus admin.</p>
  </div>
  <a href="{{ route('akun.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-3 shadow-sm shadow-blue-600/25">
    <span class="material-symbols-rounded text-[20px]">person_add</span>Tambah petugas
  </a>
</div>

@if (session('ok'))
  <div class="mb-5 flex items-center gap-3 rounded-xl bg-emerald-50 text-emerald-800 px-4 py-3 text-sm font-semibold">
    <span class="material-symbols-rounded text-[22px]">check_circle</span>{{ session('ok') }}
  </div>
@endif

@error('hapus')
  <div class="mb-5 flex items-center gap-3 rounded-xl bg-red-50 text-red-700 px-4 py-3 text-sm font-semibold">
    <span class="material-symbols-rounded text-[22px]">error</span>{{ $message }}
  </div>
@enderror

<div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 overflow-x-auto">
  <table class="w-full min-w-[680px] text-left text-sm">
    <thead>
      <tr class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
        <th class="px-6 py-3.5 font-semibold">Nama</th>
        <th class="px-6 py-3.5 font-semibold">Email</th>
        <th class="px-6 py-3.5 font-semibold">Peran</th>
        <th class="px-6 py-3.5 font-semibold">Status</th>
        <th class="px-6 py-3.5 font-semibold">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-slate-100">
      @foreach ($akun as $a)
        <tr>
          <td class="px-6 py-4 font-medium text-slate-900">
            {{ $a->name }}
            @if ($a->id === auth()->id())
              <span class="ml-1 text-xs font-semibold text-slate-400">(Anda)</span>
            @endif
          </td>
          <td class="px-6 py-4">{{ $a->email }}</td>
          <td class="px-6 py-4">
            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold capitalize {{ $a->peran === 'admin' ? 'bg-violet-50 text-violet-700' : 'bg-blue-50 text-blue-700' }}">{{ $a->peran }}</span>
          </td>
          <td class="px-6 py-4">
            <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold {{ $a->aktif ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
              <span class="w-1.5 h-1.5 rounded-full {{ $a->aktif ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>{{ $a->aktif ? 'Aktif' : 'Nonaktif' }}
            </span>
          </td>
          <td class="px-6 py-4">
            @if ($a->peran === 'petugas')
              <div class="flex flex-wrap gap-2">
                <form method="POST" action="{{ route('akun.status', $a) }}" @if ($a->aktif) onsubmit="return confirm('Nonaktifkan akun ini? Petugas tidak akan bisa login lagi.')" @endif>
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="rounded-lg border border-slate-200 hover:bg-slate-50 px-3 py-1.5 text-sm font-semibold {{ $a->aktif ? 'text-amber-700' : 'text-emerald-700' }}">
                    {{ $a->aktif ? 'Nonaktifkan' : 'Aktifkan' }}
                  </button>
                </form>

                @unless ($a->aktif)
                  <form method="POST" action="{{ route('akun.destroy', $a) }}" onsubmit="return confirm('Hapus akun ini secara permanen? Tindakan ini tidak bisa dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-lg bg-red-50 hover:bg-red-100 px-3 py-1.5 text-sm font-semibold text-red-700">Hapus</button>
                  </form>
                @endunless
              </div>
            @else
              <span class="text-slate-400">-</span>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection