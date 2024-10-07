<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="navbar container-fluid">
        <!-- Brand Logo -->
        <a href="https://www.nusakita.id/" target="_blank" class="navbar-brand">
            <img src="{{ asset('lte/assets/img/nusakita.png') }}" alt="Brand Logo" class="img-fluid logo" style="height: 40px;">
        </a>
        
        <!-- Tombol Toggle untuk Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Menu Admin (Ditampilkan untuk Semua) -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link custom-color {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                        Admin
                    </a>
                </li>

                <!-- Menu Dashboard Umum (Ditampilkan untuk Semua) -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.umum') }}" class="nav-link custom-color {{ Request::is('dashboardumum') ? 'active' : '' }}">
                        Dashboard
                    </a>
                </li>

                <!-- Menu Daftar Produk (Ditampilkan untuk Semua) -->
                <li class="nav-item">
                    <a href="{{ route('produks.index') }}" class="nav-link custom-color {{ Request::routeIs('produks.index') ? 'active' : '' }}">
                        Product List
                    </a>
                </li>

                <!-- Jika Belum Login -->
                @guest
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link custom-color {{ Request::routeIs('login') ? 'active' : '' }}">
                        Login
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link custom-color {{ Request::routeIs('register') ? 'active' : '' }}">
                        Register
                    </a>
                </li>
                @endguest

                <!-- Jika Sudah Login -->
                @auth
                <li class="nav-item">
                    <a href="{{ route('pengaturan.profil') }}" class="nav-link custom-color {{ Request::routeIs('pengaturan.profil') ? 'active' : '' }}">
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link custom-color"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
                <!-- Form Logout -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endauth
            </ul>

            <!-- Gambar Notifikasi (Ditampilkan untuk Semua) -->
            <a class="nav custom-color" href="{{ route('notifikasis.index') }}">
                <img src="{{ asset('lte/assets/img/chat.png') }}" alt="Notifikasi" style="width: 20px; height: 20px;">
            </a>
        </div>
    </div>
</nav>
