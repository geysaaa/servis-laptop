@extends('layouts.app')
@section('title', 'Login Petugas')

@section('content')
<main class="min-h-screen flex items-center justify-center px-margin-mobile">
  <div class="w-full max-w-[400px] bg-surface-container-lowest border border-outline-variant rounded-xl p-space-lg">
    <div class="flex items-center gap-space-sm mb-space-lg">
      <div class="w-9 h-9 rounded bg-primary-container flex items-center justify-center">
        <span class="material-symbols-outlined text-on-primary text-[20px]">build</span>
      </div>
      <span class="font-headline-sm text-headline-sm">Servis Laptop</span>
    </div>

    <h1 class="font-headline-md text-headline-md mb-space-md">Login Petugas</h1>

    <form method="POST" action="{{ url('/login') }}" class="space-y-space-md">
      @csrf
      <div>
        <label for="email" class="block font-label-md text-label-md mb-1">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required
          class="w-full px-3 py-2.5 rounded-lg border border-outline-variant focus:border-primary-container focus:outline-none">
      </div>
      <div>
        <label for="password" class="block font-label-md text-label-md mb-1">Kata sandi</label>
        <input id="password" name="password" type="password" required
          class="w-full px-3 py-2.5 rounded-lg border border-outline-variant focus:border-primary-container focus:outline-none">
      </div>

      @error('email')
        <p class="font-body-sm text-body-sm text-error">{{ $message }}</p>
      @enderror

      <button type="submit"
        class="w-full h-11 bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md rounded-lg">
        Masuk
      </button>
    </form>

    <a href="{{ url('/') }}" class="block text-center mt-space-md font-body-sm text-body-sm text-primary">Kembali ke beranda</a>
  </div>
</main>
@endsection