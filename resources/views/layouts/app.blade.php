<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kasir Pintar - POS')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Ionicons for beautiful UI icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Flag to indicate Laravel Environment to JS -->
    <script>
        window.isLaravel = true;
    </script>
</head>
<body class="light-mode">
    <div class="app-container">
        <!-- Sidebar Kiri -->
        <aside class="app-sidebar">
            <div class="sidebar-brand">
                <div class="brand-logo">
                    <ion-icon name="wallet"></ion-icon>
                </div>
                <div class="brand-text">
                    <h2>KasirPintar</h2>
                    <span>Point of Sale</span>
                </div>
            </div>
            
            <nav class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <ion-icon name="grid-outline"></ion-icon>
                    <span>Ringkasan</span>
                </a>
                <a href="{{ route('pos.cashier') }}" class="menu-item {{ request()->routeIs('pos.cashier') ? 'active' : '' }}">
                    <ion-icon name="calculator-outline"></ion-icon>
                    <span>Kasir Utama</span>
                </a>
                <a href="{{ route('pos.transactions') }}" class="menu-item {{ request()->routeIs('pos.transactions') ? 'active' : '' }}">
                    <ion-icon name="receipt-outline"></ion-icon>
                    <span>Riwayat Transaksi</span>
                </a>
                @if(Auth::check() && Auth::user()->role === \App\Enums\Role::ADMIN)
                <a href="{{ route('pos.products.index') }}" class="menu-item {{ request()->routeIs('pos.products.*') ? 'active' : '' }}">
                    <ion-icon name="fast-food-outline"></ion-icon>
                    <span>Manajemen Produk</span>
                </a>
                @endif
            </nav>
            
            <div class="sidebar-user-section" style="margin-top: auto; border-top: 1px solid var(--border-color); position: relative; z-index: 999;">
                <a href="{{ route('profile.edit') }}" class="sidebar-user" style="border-top: none; margin-bottom: 0; text-decoration: none; display: flex; align-items: center; gap: 12px; padding: 20px 24px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='var(--color-primary-light)'" onmouseout="this.style.backgroundColor='transparent'">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'SA', 0, 2)) }}</div>
                    <div class="user-info">
                        <h4 style="color: var(--text-primary);">{{ Auth::user()->name ?? 'Pengguna' }}</h4>
                        <span>{{ Auth::user()->role ? Auth::user()->role->label() : 'Kasir' }}</span>
                    </div>
                </a>
                
                <div style="padding: 12px 24px 20px 24px;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="menu-item" style="width: 100%; background: transparent; border: none; cursor: pointer; color: var(--color-danger); display: flex; align-items: center; gap: 12px; font-weight: 600; font-family: inherit; font-size: 14px; padding: 10px 12px; border-radius: 12px; transition: all 0.2s;">
                            <ion-icon name="log-out-outline" style="font-size: 20px;"></ion-icon>
                            <span>Keluar Aplikasi</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Konten Utama -->
        <main class="app-main">
            <!-- Topbar / Header -->
            <header class="app-header">
                <div class="header-left">
                    <h1>@yield('header_title', 'Ringkasan Laporan')</h1>
                    <p class="header-subtitle">@yield('header_subtitle', 'Selamat datang kembali!')</p>
                </div>
                <div class="header-right">
                    <div class="header-date">
                        <ion-icon name="calendar-outline"></ion-icon>
                        <span>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                    </div>
                    <div class="header-status">
                        <span class="status-indicator online"></span>
                        <span>Sistem Online</span>
                    </div>
                </div>
            </header>

            <!-- dynamic content area -->
            <div class="main-content" style="flex: 1; overflow-y: auto; padding: 24px; position: relative;">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
