<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') - Servis Laptop</title>
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
@endverbatim
</head>
<body class="bg-[#F5F7FB] text-slate-700 text-[15px] antialiased">
@yield('content')
@stack('scripts')
</body>
</html>