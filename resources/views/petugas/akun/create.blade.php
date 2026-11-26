@extends('layouts.petugas')
@section('title', 'Tambah Petugas')

@php
  $in = 'w-full rounded-xl border border-slate-200 bg-white px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100';
  $lb = 'block text-sm font-semibold text-slate-700 mb-1.5';
  $er = 'text-sm text-red-600 mt-1.5';
@endphp

@section('isi')
<div class="mb-6">
  <h1 class="text-2xl font-extrabold text-slate-900">Tambah Petugas</h1>
  <p class="text-slate-500">Buat akun baru untuk kasir atau penerima servis.</p>
</div>

<form method="POST" action="{{ route('akun.store') }}" class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 max-w-xl">
  @csrf
  <div class="p-6 md:p-8 space-y-5">
    <div>
      <label for="name" class="{{ $lb }}">Nama</label>
      <input id="name" name="name" value="{{ old('name') }}" class="{{ $in }}">
      @error('name')<p class="{{ $er }}">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="email" class="{{ $lb }}">Email (dipakai untuk login)</label>
      <input id="email" name="email" type="email" value="{{ old('email') }}" class="{{ $in }}">
      @error('email')<p class="{{ $er }}">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="password" class="{{ $lb }}">Kata sandi</label>
      <input id="password" name="password" type="password" class="{{ $in }}">
      @error('password')<p class="{{ $er }}">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="password_confirmation" class="{{ $lb }}">Ulangi kata sandi</label>
      <input id="password_confirmation" name="password_confirmation" type="password" class="{{ $in }}">
    </div>
    <p class="rounded-xl bg-slate-50 px-4 py-3 text-sm text-slate-600">Peran akun ini otomatis <span class="font-semibold text-slate-900">Petugas</span>.</p>
  </div>

  <div class="px-6 md:px-8 py-5 border-t border-slate-100 flex gap-3">
    <button type="submit" class="rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 shadow-sm shadow-blue-600/25">Simpan akun</button>
    <a href="{{ route('akun.index') }}" class="rounded-xl border border-slate-200 hover:bg-slate-50 font-semibold px-6 py-3">Batal</a>
  </div>
</form>
@endsection