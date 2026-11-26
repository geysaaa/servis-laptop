@extends('layouts.app')

@section('content')
@include('partials.header-publik')
<main class="max-w-3xl mx-auto px-4 py-10">
  @yield('isi')
</main>
@include('partials.footer-publik')
@endsection