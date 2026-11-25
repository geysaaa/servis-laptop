@extends('layouts.petugas')
@section('title', 'Dashboard')

@section('isi')
<h1 class="font-headline-lg text-headline-lg mb-space-xs">Halo, {{ auth()->user()->name }}</h1>
<p class="text-on-surface-variant">Dashboard lengkap menyusul di langkah berikutnya.</p>
@endsection