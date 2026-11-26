@extends('layouts.petugas')
@section('title', 'Dashboard')

@php
  $kpi = [
    ['inbox', 'bg-slate-100 text-slate-600'],
    ['manage_search', 'bg-amber-50 text-amber-600'],
    ['build', 'bg-blue-50 text-blue-600'],
    ['task_alt', 'bg-emerald-50 text-emerald-600'],
  ];
  $bar = ['bg-slate-400', 'bg-amber-400', 'bg-blue-500', 'bg-emerald-500'];
  $total = max(array_sum($ringkasan), 1);
@endphp

@section('isi')
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
  <div>
    <h1 class="text-2xl font-extrabold text-slate-900">Halo, {{ auth()->user()->name }} 👋</h1>
    <p class="text-slate-500">{{ now()->translatedFormat('l, d F Y') }}</p>
  </div>
  <a href="{{ route('servis.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-3 shadow-sm shadow-blue-600/25">
    <span class="material-symbols-rounded text-[20px]">add</span>Servis baru
  </a>
</div>

<div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
  @foreach ($ringkasan as $label => $jumlah)
    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 p-5 flex items-center gap-4">
      <span class="w-12 h-12 shrink-0 rounded-xl flex items-center justify-center {{ $kpi[$loop->index][1] }}">
        <span class="material-symbols-rounded">{{ $kpi[$loop->index][0] }}</span>
      </span>
      <div>
        <p class="text-xs font-medium text-slate-500">{{ $label }}</p>
        <p class="text-3xl font-extrabold text-slate-900 leading-tight">{{ $jumlah }}</p>
      </div>
    </div>
  @endforeach
</div>

<div class="grid lg:grid-cols-3 gap-6">
  <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5">
    <div class="flex items-center justify-between px-6 py-5">
      <h2 class="font-bold text-slate-900">Servis terbaru</h2>
      <a href="{{ route('servis.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Lihat semua</a>
    </div>
    <div class="divide-y divide-slate-100 border-t border-slate-100">
      @forelse ($terbaru as $s)
        <a href="{{ route('servis.show', $s) }}" class="flex items-center gap-4 px-6 py-4 hover:bg-slate-50">
          <span class="w-10 h-10 shrink-0 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold">{{ strtoupper(mb_substr($s->nama_pelanggan, 0, 1)) }}</span>
          <div class="min-w-0 flex-1">
            <p class="font-semibold text-slate-900 truncate">{{ $s->nama_pelanggan }}</p>
            <p class="text-sm text-slate-500 truncate">{{ $s->merk_tipe }} &middot; <span class="font-mono">{{ $s->kode_tiket }}</span></p>
          </div>
          <x-status-badge :status="$s->status" />
        </a>
      @empty
        <p class="px-6 py-10 text-center text-slate-500">Belum ada servis. Klik Servis baru untuk mencatat laptop yang masuk.</p>
      @endforelse
    </div>
  </div>

  <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 p-6">
    <h2 class="font-bold text-slate-900 mb-5">Komposisi status</h2>
    <div class="space-y-5">
      @foreach ($ringkasan as $label => $jumlah)
        <div>
          <div class="flex justify-between text-sm mb-1.5">
            <span class="font-medium text-slate-700">{{ $label }}</span>
            <span class="text-slate-500">{{ $jumlah }} servis</span>
          </div>
          <div class="h-2.5 rounded-full bg-slate-100 overflow-hidden">
            <div class="h-full rounded-full {{ $bar[$loop->index] }}" style="width: {{ round($jumlah / $total * 100) }}%"></div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection