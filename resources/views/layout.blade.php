<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('kichwa', 'ElectroSoko') — ElectroSoko</title>
    @vite(['resources/css/app.css'])
    <style>
        [x-cloak] { display: none !important; }
        .sidebar-link { @apply flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-300 hover:bg-slate-700 hover:text-white transition-all text-sm font-medium; }
        .sidebar-link.active { @apply bg-blue-600 text-white; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-slate-900 flex flex-col fixed inset-y-0 right-0 z-30">
        {{-- Logo --}}
        <div class="px-6 py-5 border-b border-slate-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-base leading-tight">ElectroSoko</p>
                    <p class="text-slate-400 text-xs">نظام إدارة المحل</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <a href="{{ route('dashibodi') }}"
               class="sidebar-link {{ request()->routeIs('dashibodi') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                لوحة التحكم
            </a>

            <a href="{{ route('bidhaa.index') }}"
               class="sidebar-link {{ request()->routeIs('bidhaa.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                المنتجات
            </a>

            <a href="{{ route('wateja.index') }}"
               class="sidebar-link {{ request()->routeIs('wateja.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                العملاء
            </a>

            <a href="{{ route('mauzo.index') }}"
               class="sidebar-link {{ request()->routeIs('mauzo.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                المبيعات
            </a>

            <a href="{{ route('madeni.index') }}"
               class="sidebar-link {{ request()->routeIs('madeni.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                الديون
            </a>

            <a href="{{ route('jardi.index') }}"
               class="sidebar-link {{ request()->routeIs('jardi.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                جرد المخزن
            </a>

            <div class="pt-4 mt-4 border-t border-slate-700">
                <a href="{{ route('mauzo.create') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-blue-500 hover:bg-blue-400 text-white text-sm font-semibold transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    بيع جديد
                </a>
            </div>
        </nav>

        {{-- Footer --}}
        <div class="px-4 py-3 border-t border-slate-700">
            <p class="text-slate-500 text-xs text-center">ElectroSoko &copy; {{ date('Y') }}</p>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 mr-64 flex flex-col min-h-screen">

        {{-- Top Header --}}
        <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
            <h1 class="text-lg font-semibold text-slate-800">@yield('kichwa', 'لوحة التحكم')</h1>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 text-xs font-medium px-3 py-1 rounded-full border border-green-200">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                    النظام يعمل
                </span>
            </div>
        </header>

        {{-- Flash Messages --}}
        <div class="px-6 pt-4">
            @if(session('mafanikio'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center gap-3 mb-0">
                    <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-medium">{{ session('mafanikio') }}</span>
                </div>
            @endif
            @if(session('hitilafu'))
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center gap-3 mb-0">
                    <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-medium">{{ session('hitilafu') }}</span>
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-0">
                    <ul class="text-sm space-y-1 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        {{-- Page Content --}}
        <main class="flex-1 p-6">
            @yield('maudhui')
        </main>

    </div>
</div>

@stack('scripts')
</body>
</html>
