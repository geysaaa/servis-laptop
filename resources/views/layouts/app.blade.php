<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') - Farih Servis Laptop</title>

@if (file_exists(public_path('images/favicon.png')))
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
@endif

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
@verbatim
<script>
tailwind.config = { theme: { extend: { fontFamily: {
  sans: ['"Plus Jakarta Sans"', 'sans-serif'],
  mono: ['"JetBrains Mono"', 'monospace']
} } } }
</script>
<style>
  svg.lucide { width: 1em; height: 1em; stroke-width: 1.75; flex-shrink: 0; }
  aside nav svg.lucide { width: 18px; height: 18px; }
  .w-12.h-12 svg.lucide { width: 22px; height: 22px; }

  h1.text-2xl { font-size: 22px; font-weight: 700; }
  p.text-3xl.font-extrabold { font-size: 28px; font-weight: 700; }
  aside nav a.font-semibold { font-weight: 500; }
</style>
@endverbatim
</head>
<body class="bg-[#F5F7FB] text-slate-700 text-[14px] antialiased">
@yield('content')
@stack('scripts')

<script>
  window.LOGO_URL = @json(file_exists(public_path('images/logo.png')) ? asset('images/logo.png') : null);
</script>
<script src="https://unpkg.com/lucide@0.475.0/dist/umd/lucide.min.js"></script>
@verbatim
<script>
(function () {
  var peta = {
    laptop_mac: 'laptop', space_dashboard: 'layout-dashboard', build_circle: 'wrench',
    add_circle: 'circle-plus', logout: 'log-out', manage_accounts: 'user-cog',
    add: 'plus', inbox: 'inbox', manage_search: 'search', build: 'wrench',
    task_alt: 'circle-check', search: 'search', check_circle: 'circle-check',
    arrow_back: 'arrow-left', chat: 'message-circle', person_add: 'user-plus',
    error: 'circle-alert', mail: 'mail', lock: 'lock', verified: 'badge-check',
    confirmation_number: 'ticket', location_searching: 'crosshair', search_off: 'search-x',
    settings: 'settings', check: 'check', notifications_active: 'bell-ring',
    inventory_2: 'package', timeline: 'activity', history: 'history', no_accounts: 'user-x'
  };

  document.querySelectorAll('.material-symbols-rounded').forEach(function (el) {
    var asal = el.textContent.trim();

    // Ikon laptop pada kotak logo diganti logo Farih Laptop
    if (asal === 'laptop_mac' && window.LOGO_URL && el.parentElement) {
      var p = el.parentElement;
      var ukuran = (p.className.match(/\b[wh]-\d+\b/g) || ['w-10', 'h-10']).join(' ');
      var img = document.createElement('img');
      img.src = window.LOGO_URL;
      img.alt = 'Logo Farih Laptop';
      img.className = ukuran + ' rounded-full object-cover shrink-0';
      p.replaceWith(img);
      return;
    }

    var i = document.createElement('i');
    i.setAttribute('data-lucide', peta[asal] || 'circle');
    i.className = el.className.replace('material-symbols-rounded', '').trim();
    if (!/text-\[/.test(i.className)) i.className += ' text-[20px]';
    el.replaceWith(i);
  });
  lucide.createIcons();
})();
</script>
@endverbatim
</body>
</html>