@props(['status'])
@php
  $warna = [
    0 => 'bg-slate-100 text-slate-700',
    1 => 'bg-amber-50 text-amber-700',
    2 => 'bg-blue-50 text-blue-700',
    3 => 'bg-emerald-50 text-emerald-700',
    4 => 'bg-violet-50 text-violet-700',
  ];
  $titik = [0 => 'bg-slate-400', 1 => 'bg-amber-500', 2 => 'bg-blue-500', 3 => 'bg-emerald-500', 4 => 'bg-violet-500'];
@endphp
<span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold {{ $warna[$status] }}">
  <span class="w-1.5 h-1.5 rounded-full {{ $titik[$status] }}"></span>{{ \App\Models\Servis::STATUS[$status] }}
</span>