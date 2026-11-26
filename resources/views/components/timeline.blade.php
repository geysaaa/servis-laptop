@props(['servis'])
@php $riwayat = $servis->riwayat->keyBy('status'); @endphp
<ol class="px-6 pb-6 pt-2">
  @foreach (\App\Models\Servis::STATUS as $i => $nama)
    @php
      $h = $riwayat->get($i);
      $lewat = $i < $servis->status;
      $sekarang = $i === $servis->status;
    @endphp
    <li class="relative flex gap-4 pb-6 last:pb-0">
      @unless ($loop->last)
        <span class="absolute left-[15px] top-8 bottom-0 w-0.5 {{ $lewat ? 'bg-blue-600' : 'bg-slate-200' }}"></span>
      @endunless
      <span class="relative z-10 w-8 h-8 shrink-0 rounded-full flex items-center justify-center {{ $lewat ? 'bg-blue-600 text-white' : ($sekarang ? 'bg-blue-600 text-white ring-4 ring-blue-100' : 'bg-white ring-2 ring-slate-200 text-slate-400') }}">
        @if ($lewat)
          <span class="material-symbols-rounded text-[18px]">check</span>
        @else
          <span class="text-xs font-bold">{{ $i + 1 }}</span>
        @endif
      </span>
      <div class="flex-1 flex flex-wrap items-center justify-between gap-1 pt-1">
        <p class="{{ $sekarang ? 'font-bold text-slate-900' : ($lewat ? 'font-semibold text-slate-800' : 'font-medium text-slate-400') }}">{{ $nama }}</p>
        <p class="text-xs text-slate-500">{{ $h ? $h->waktu->translatedFormat('d M Y, H:i') : '' }}</p>
      </div>
    </li>
  @endforeach
</ol>