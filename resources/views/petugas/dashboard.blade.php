@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<main class="max-w-[920px] mx-auto p-margin">
  <h1 class="font-headline-lg text-headline-lg mb-space-xs">Halo, {{ auth()->user()->name }}</h1>
  <p class="text-on-surface-variant mb-space-lg">Peran: {{ auth()->user()->peran }}</p>

  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="h-10 px-space-md rounded-lg border border-outline-variant">Logout</button>
  </form>
</main>
@endsection