<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<title>@yield('title') - Servis Laptop</title>

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet"/>

<style>
@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}
::-webkit-scrollbar{display:none;}
body, input, button, select, textarea { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>

<script src="https://cdn.tailwindcss.com"></script>
@verbatim
<script id="tailwind-config">
tailwind.config={
  darkMode:"class",
  theme:{extend:{
    colors:{
      "outline-variant":"#c3c6d6","on-tertiary-fixed":"#002110","secondary":"#7e5700","surface-variant":"#d4e3ff",
      "on-secondary-fixed":"#281900","error-container":"#ffdad6","inverse-on-surface":"#ebf1ff","surface-bright":"#f9f9ff",
      "on-tertiary":"#ffffff","secondary-container":"#fdbb3e","tertiary-fixed":"#9ef5be","error":"#ba1a1a",
      "on-surface-variant":"#424653","on-error-container":"#93000a","surface-tint":"#0d58ca","primary":"#0047ab",
      "surface-container-low":"#eff3ff","surface-container-high":"#dde9ff","on-primary-container":"#dbe3ff","on-primary":"#ffffff",
      "primary-fixed":"#d9e2ff","primary-fixed-dim":"#b1c5ff","tertiary":"#005a34","surface-container":"#e6eeff",
      "surface-dim":"#cadbf8","outline":"#737785","tertiary-fixed-dim":"#82d8a3","surface":"#f9f9ff",
      "on-primary-fixed-variant":"#00419d","on-error":"#ffffff","secondary-fixed-dim":"#fdbb3e","surface-container-lowest":"#ffffff",
      "on-tertiary-container":"#9ff7bf","on-secondary":"#ffffff","on-secondary-container":"#6e4c00","background":"#f9f9ff",
      "inverse-primary":"#b1c5ff","on-secondary-fixed-variant":"#5f4100","surface-container-highest":"#d4e3ff","on-primary-fixed":"#001946",
      "on-tertiary-fixed-variant":"#00522f","primary-container":"#1d5fd1","secondary-fixed":"#ffdeac","inverse-surface":"#213147",
      "on-surface":"#0b1c31","tertiary-container":"#167448","on-background":"#0b1c31"
    },
    borderRadius:{DEFAULT:"0.25rem",lg:"0.5rem",xl:"0.75rem",full:"9999px"},
    spacing:{
      "gutter-mobile":"0.75rem","space-sm":"0.5rem","margin-mobile":"1rem",gutter:"1rem","space-lg":"1.5rem",
      "space-xl":"2rem",margin:"1.5rem","space-xs":"0.25rem","space-md":"1rem"
    },
    fontFamily:{
      "body-sm":["Plus Jakarta Sans","sans-serif"],
      "headline-md":["Plus Jakarta Sans","sans-serif"],
      "ticket-code":["JetBrains Mono","monospace"],
      "headline-lg-mobile":["Plus Jakarta Sans","sans-serif"],
      "body-lg":["Plus Jakarta Sans","sans-serif"],
      "headline-lg":["Plus Jakarta Sans","sans-serif"],
      "body-md":["Plus Jakarta Sans","sans-serif"],
      "label-md":["Plus Jakarta Sans","sans-serif"],
      "label-sm":["Plus Jakarta Sans","sans-serif"],
      "headline-sm":["Plus Jakarta Sans","sans-serif"]
    },
    fontSize:{
      "body-sm":["14px",{lineHeight:"20px",fontWeight:"600"}],
      "headline-md":["24px",{lineHeight:"32px",fontWeight:"700"}],
      "ticket-code":["16px",{lineHeight:"22px",letterSpacing:"0.05em",fontWeight:"700"}],
      "headline-lg-mobile":["28px",{lineHeight:"36px",fontWeight:"700"}],
      "body-lg":["18px",{lineHeight:"28px",fontWeight:"400"}],
      "headline-lg":["36px",{lineHeight:"44px",fontWeight:"700"}],
      "body-md":["16px",{lineHeight:"24px",fontWeight:"400"}],
      "label-md":["15px",{lineHeight:"20px",fontWeight:"600"}],
      "label-sm":["13px",{lineHeight:"18px",fontWeight:"600"}],
      "headline-sm":["20px",{lineHeight:"28px",fontWeight:"700"}]
    }
  }}
}
</script>
@endverbatim
</head>
<body class="bg-background font-body-md text-body-md text-on-surface">
@yield('content')
@stack('scripts')
</body>
</html>