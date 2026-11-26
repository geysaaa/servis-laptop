@extends('layouts.app')
@section('title', 'Login Petugas')

@section('content')
<div class="min-h-screen grid lg:grid-cols-2">
  <div class="hidden lg:flex flex-col justify-between bg-gradient-to-br from-[#10294F] via-[#14407F] to-blue-600 text-white p-12">
    <div class="flex items-center gap-3">
      <span class="w-11 h-11 rounded-xl bg-white/15 flex items-center justify-center"><span class="material-symbols-rounded">laptop_mac</span></span>
      <span class="text-xl font-extrabold">Servis Laptop</span>
    </div>
    <div>
      <h2 class="text-4xl font-extrabold leading-tight mb-4">Catat servis,<br>kabari pelanggan,<br>tanpa ribet.</h2>
      <p class="text-blue-100/80 max-w-sm">Kelola laptop yang masuk, perbarui statusnya, dan biarkan pelanggan memantau sendiri.</p>
    </div>
    <p class="text-sm text-blue-100/60">&copy; {{ date('Y') }} Servis Laptop</p>
  </div>

  <div class="flex items-center justify-center p-6">
    <div class="w-full max-w-sm">
      <div class="lg:hidden flex items-center gap-3 mb-8">
        <span class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center"><span class="material-symbols-rounded">laptop_mac</span></span>
        <span class="font-extrabold text-slate-900 text-lg">Servis Laptop</span>
      </div>

      <h1 class="text-2xl font-extrabold text-slate-900">Selamat datang kembali</h1>
      <p class="text-slate-500 mb-8">Masuk untuk mengelola servis laptop.</p>

      <form method="POST" action="{{ url('/login') }}" class="space-y-5">
        @csrf
        <div>
          <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
          <div class="relative">
            <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">mail</span>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
              class="w-full rounded-xl border border-slate-200 bg-white pl-11 pr-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
          </div>
        </div>
        <div>
          <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Kata sandi</label>
          <div class="relative">
            <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
            <input id="password" name="password" type="password" required
              class="w-full rounded-xl border border-slate-200 bg-white pl-11 pr-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
          </div>
        </div>

        @error('email')
          <p class="flex items-center gap-2 rounded-xl bg-red-50 text-red-700 px-4 py-3 text-sm">
            <span class="material-symbols-rounded text-[20px]">error</span>{{ $message }}
          </p>
        @enderror

        <button type="submit" class="w-full rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 shadow-sm shadow-blue-600/25">Masuk</button>
      </form>

      <a href="{{ url('/') }}" class="mt-6 inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:text-blue-700">
        <span class="material-symbols-rounded text-[18px]">arrow_back</span>Kembali ke beranda
      </a>
    </div>
  </div>
</div>
@endsection