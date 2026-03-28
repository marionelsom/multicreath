<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title', 'Admin') — MULTICREATH</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['DM Sans', 'sans-serif'], mono: ['DM Mono', 'monospace'] },
                    colors: {
                        primary:   { DEFAULT: '#135bec', 50: '#eff4ff', 100: '#dbe8ff', 200: '#bfd2ff', 300: '#93b2fd', 400: '#6088fa', 500: '#3b60f5', 600: '#135bec', 700: '#1a44cc', 800: '#1b38a3', 900: '#1c3481' },
                        surface:   { DEFAULT: '#0f1117', card: '#161b27', border: '#1e2535', hover: '#1a2035' },
                        ink:       { DEFAULT: '#f0f4ff', muted: '#8896b3', faint: '#4a5568' },
                    },
                    boxShadow: {
                        'card': '0 1px 3px rgba(0,0,0,0.4), 0 1px 2px rgba(0,0,0,0.3)',
                        'glow': '0 0 20px rgba(19,91,236,0.25)',
                    }
                }
            }
        }
    </script>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background: #0f1117; color: #f0f4ff; }
        .material-symbols-outlined { font-size: 20px; line-height: 1; vertical-align: middle; }
        .nav-item { @apply flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-ink-muted transition-all duration-150 hover:bg-surface-hover hover:text-ink; }
        .nav-item.active { @apply bg-primary/10 text-primary; }
        .stat-card { background: #161b27; border: 1px solid #1e2535; border-radius: 12px; }
        .data-table th { font-size: 11px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: #8896b3; padding: 12px 16px; border-bottom: 1px solid #1e2535; }
        .data-table td { padding: 13px 16px; border-bottom: 1px solid #111827; font-size: 14px; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: rgba(255,255,255,0.02); }
        .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 999px; font-size: 11px; font-weight: 600; letter-spacing: 0.04em; }
        .btn-primary { background: #135bec; color: white; padding: 8px 16px; border-radius: 8px; font-size: 14px; font-weight: 500; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: background 0.15s; }
        .btn-primary:hover { background: #1a44cc; }
        .btn-ghost { background: transparent; color: #8896b3; padding: 8px 16px; border-radius: 8px; font-size: 14px; font-weight: 500; border: 1px solid #1e2535; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.15s; }
        .btn-ghost:hover { border-color: #4a5568; color: #f0f4ff; }
        .form-input { background: #1e2535; border: 1px solid #2d3748; border-radius: 8px; color: #f0f4ff; padding: 9px 14px; font-size: 14px; width: 100%; outline: none; transition: border-color 0.15s; font-family: 'DM Sans', sans-serif; }
        .form-input:focus { border-color: #135bec; box-shadow: 0 0 0 3px rgba(19,91,236,0.15); }
        .form-input::placeholder { color: #4a5568; }
        .form-label { font-size: 12px; font-weight: 600; letter-spacing: 0.06em; text-transform: uppercase; color: #8896b3; margin-bottom: 6px; display: block; }
        select.form-input option { background: #1e2535; }
        .card { background: #161b27; border: 1px solid #1e2535; border-radius: 12px; padding: 24px; }
        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #2d3748; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #4a5568; }
        /* Alert flash */
        .flash-success { background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); color: #6ee7b7; border-radius: 8px; padding: 12px 16px; font-size: 14px; }
        .flash-error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #fca5a5; border-radius: 8px; padding: 12px 16px; font-size: 14px; }
    </style>
    @stack('styles')
</head>
<body class="h-full flex">

{{-- Sidebar --}}
<aside id="sidebar" class="w-60 flex-shrink-0 flex flex-col h-screen sticky top-0 border-r border-surface-border" style="background:#0d1120;">
    {{-- Logo --}}
    <div class="px-5 py-5 border-b border-surface-border flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center flex-shrink-0">
            <svg width="18" height="18" fill="none" viewBox="0 0 48 48">
                <path clip-rule="evenodd" d="M24 0.757L47.24 24 24 47.24 0.757 24 24 0.757zM21 35.76V12.24L9.24 24 21 35.76z" fill="white" fill-rule="evenodd"/>
            </svg>
        </div>
        <div>
            <p class="text-sm font-bold text-ink leading-none">MULTICREATH</p>
            <p class="text-[10px] text-ink-faint mt-0.5">Panel Admin</p>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <p class="text-[10px] font-semibold uppercase tracking-widest text-ink-faint px-3 mb-2">Principal</p>

        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="material-symbols-outlined">grid_view</span> Dashboard
        </a>

        <p class="text-[10px] font-semibold uppercase tracking-widest text-ink-faint px-3 mt-4 mb-2">Tienda</p>

        <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">inventory_2</span> Productos
        </a>
        <a href="{{ route('admin.inventory.index') }}" class="nav-item {{ request()->routeIs('admin.inventory*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">warehouse</span> Inventario
        </a>
        <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">receipt_long</span> Órdenes
        </a>
        <a href="{{ route('admin.suppliers.index') }}" class="nav-item {{ request()->routeIs('admin.suppliers*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">local_shipping</span> Proveedores
        </a>

        <p class="text-[10px] font-semibold uppercase tracking-widest text-ink-faint px-3 mt-4 mb-2">Agencia</p>

        <a href="{{ route('admin.services.index') }}" class="nav-item {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">design_services</span> Servicios
        </a>
        <a href="{{ route('admin.projects.index') }}" class="nav-item {{ request()->routeIs('admin.projects*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">folder_open</span> Proyectos
        </a>

        <p class="text-[10px] font-semibold uppercase tracking-widest text-ink-faint px-3 mt-4 mb-2">CRM</p>

        <a href="{{ route('admin.customers.index') }}" class="nav-item {{ request()->routeIs('admin.customers*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">group</span> Clientes
        </a>
    </nav>

    {{-- User --}}
    <div class="px-3 py-4 border-t border-surface-border">
        <div class="flex items-center gap-3 px-3 py-2">
            <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center text-primary text-sm font-bold flex-shrink-0">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-ink truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                <p class="text-xs text-ink-faint truncate">Administrador</p>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}" class="mt-1">
            @csrf
            <button type="submit" class="nav-item w-full text-left">
                <span class="material-symbols-outlined">logout</span> Cerrar sesión
            </button>
        </form>
    </div>
</aside>

{{-- Main --}}
<div class="flex-1 flex flex-col min-h-screen min-w-0">
    {{-- Topbar --}}
    <header class="h-14 flex items-center justify-between px-6 border-b border-surface-border flex-shrink-0" style="background:#0d1120;">
        <div>
            <h1 class="text-sm font-semibold text-ink">@yield('page-title', 'Dashboard')</h1>
            <p class="text-xs text-ink-faint">@yield('page-subtitle', '')</p>
        </div>
        <div class="flex items-center gap-3">
            @yield('header-actions')
        </div>
    </header>

    {{-- Content --}}
    <main class="flex-1 p-6 overflow-auto">
        {{-- Flash messages --}}
        @if(session('success'))
            <div class="flash-success mb-5 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-400" style="font-size:16px;">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="flash-error mb-5 flex items-center gap-2">
                <span class="material-symbols-outlined text-red-400" style="font-size:16px;">error</span>
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="flash-error mb-5">
                <ul class="space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined" style="font-size:14px;">error</span>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>
