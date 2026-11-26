@extends('layouts.app')
@section('title', 'Login Petugas')

@section('content')
<div class="min-h-screen bg-[#0B1220] flex flex-col items-center justify-center px-4 py-10"
  style="background-image:radial-gradient(rgba(148,163,184,.16) 1px,transparent 1px);background-size:22px 22px">

  <a href="{{ url('/') }}" class="flex items-center gap-3 mb-8">
    <span class="w-11 h-11 rounded-xl bg-blue-500 text-white flex items-center justify-center"><span class="material-symbols-rounded text-[24px]">laptop_mac</span></span>
    <span class="text-xl font-extrabold text-white">Servis Laptop</span>
  </a>

  <div class="w-full max-w-md rounded-3xl bg-white p-8 shadow-2xl shadow-black/40">
    <span class="inline-flex rounded-full bg-blue-50 text-blue-700 px-3 py-1 text-xs font-semibold mb-4">Khusus petugas toko</span>
    <h1 class="text-2xl font-extrabold text-slate-900">Masuk ke akun Anda</h1>
    <p class="text-slate-500 mt-1 mb-7">Kelola laptop yang masuk dan perbarui status servisnya.</p>

    <form method="POST" action="{{ url('/login') }}" class="space-y-5">
      @csrf
      <div>
        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
        <div class="relative">
          <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">mail</span>
          <input id="email" name="email" type="email" value="{{ old('email') }}" required
            class="w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-4 py-3 focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
        </div>
      </div>

      <div>
        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Kata sandi</label>
        <div class="relative">
          <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
          <input id="password" name="password" type="password" required
            class="w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-4 py-3 focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
        </div>
      </div>

      @error('email')
        <p class="flex items-start gap-2 rounded-xl bg-red-50 text-red-700 px-4 py-3 text-sm">
          <span class="material-symbols-rounded text-[20px] shrink-0">error</span>{{ $message }}
        </p>
      @enderror

      <button type="submit" class="w-full rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5">Masuk</button>
    </form>
  </div>

  <a href="{{ url('/') }}" class="mt-6 inline-flex items-center gap-1.5 text-sm font-semibold text-slate-400 hover:text-white">
    <span class="material-symbols-rounded text-[18px]">arrow_back</span>Kembali ke beranda
  </a>
</div>
@endsection