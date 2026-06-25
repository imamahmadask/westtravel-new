<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @yield('meta')
    <title>{{ $title ?? 'West Travel Indonesia - Wander Without Worry' }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Fraunces:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}?v=1.3" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @livewireStyles
</head>

<body>

    <!-- ═══ NAVBAR ═══ -->
    <nav class="navbar-west {{ !empty($navbarScrolled) ? 'scrolled' : '' }}" id="mainNav">
        <a href="/" class="brand">
            <img id="navbar-logo" src="{{ asset(!empty($navbarScrolled) ? 'assets/img/logo2.png' : 'assets/img/logo.png') }}" alt="westtravel" width="200"
                data-original="{{ asset('assets/img/logo.png') }}" data-scrolled="{{ asset('assets/img/logo2.png') }}">
        </a>
        <ul class="nav-links">
            <li><a href="{{ url('/packages') }}" class="{{ ($activeNav ?? '') === 'packages' ? 'active-nav' : '' }}">Paket Wisata</a></li>
            <li><a href="/#about">Tentang Kami</a></li>
            <li><a href="/#gallery">Galeri</a></li>
            <li><a href="/#why-us">Keunggulan</a></li>
            <li class="nav-btn-mobile-wrapper"><a href="/#contact" class="btn-nav-mobile">Hubungi Kami</a></li>
        </ul>
        <a href="/#contact" class="btn-nav">Hubungi Kami</a>
        <button class="navbar-toggler-west" onclick="toggleMenu()" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </nav>

    <!-- ═══ MAIN CONTENT ═══ -->
    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- ═══ FOOTER ═══ -->
    <footer>
        <div class="container">
            <div class="row g-4 footer-top">
                <div class="col-lg-4">
                    <a href="/" class="brand" style="margin-bottom: 1.5rem; display: inline-block;">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="WestTravel.id" width="180">
                    </a>
                    <p style="color:var(--muted); font-size:0.95rem; line-height:1.7; margin-bottom:1.5rem;">
                        Spesialis perjalanan premium Anda untuk wilayah Nusa Tenggara dan destinasi internasional
                        pilihan.
                        Memberikan pengalaman otentik dengan layanan kelas satu.
                    </p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="footer-title">Layanan</h5>
                    <ul class="footer-links">
                        <li><a href="/packages">Open Trip</a></li>
                        <li><a href="/packages">Private Trip</a></li>
                        <li><a href="/packages">Honeymoon</a></li>
                        <li><a href="#">Corporate</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="footer-title">Perusahaan</h5>
                    <ul class="footer-links">
                        <li><a href="/#about">Tentang Kami</a></li>
                        <li><a href="/#gallery">Galeri</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="/#contact">Karir</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <ul class="footer-links" style="color:var(--muted);">
                        <li style="display:flex; gap:.75rem; margin-bottom:.75rem;">
                            <i class="fas fa-map-marker-alt" style="margin-top:4px; color:var(--blue-mid)"></i>
                            <span>Jl. Pariwisata No. 123, Mataram<br>Nusa Tenggara Barat 83115</span>
                        </li>
                        <li style="display:flex; gap:.75rem; margin-bottom:.75rem;">
                            <i class="fas fa-phone-alt" style="margin-top:4px; color:var(--blue-mid)"></i>
                            <span>+62 812 3456 7890</span>
                        </li>
                        <li style="display:flex; gap:.75rem;">
                            <i class="fas fa-envelope" style="margin-top:4px; color:var(--blue-mid)"></i>
                            <span>hello@westtravel.id</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2025 WestTravel.id — All rights reserved.</p>
                <p>
                    <a href="#" style="margin-right:1.5rem;">Kebijakan Privasi</a>
                    <a href="#">Syarat & Ketentuan</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float -->
    <a href="https://wa.me/6281234567890?text=Halo%20WestTravel%2C%20saya%20ingin%20info%20paket%20wisata"
        class="whatsapp-float" target="_blank" title="Chat WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll
        const nav = document.getElementById('mainNav');
        const logo = document.getElementById('navbar-logo');
        const forceNavbarScrolled = @json(!empty($navbarScrolled));

        function handleNavbarScroll() {
            const isScrolled = forceNavbarScrolled || window.scrollY > 60;
            nav.classList.toggle('scrolled', isScrolled);
            if (logo) {
                logo.src = isScrolled ? logo.dataset.scrolled : logo.dataset.original;
            }
        }

        window.addEventListener('scroll', handleNavbarScroll);
        handleNavbarScroll(); // Run on page load/refresh

        // Mobile menu
        function toggleMenu() {
            const links = document.querySelector('.nav-links');
            if (!links) return;
            const open = links.style.display === 'flex';
            links.style.cssText = open ? '' :
                'display:flex;flex-direction:column;position:absolute;top:100%;left:0;right:0;background:rgba(255,255,255,0.97);backdrop-filter:blur(16px);padding:1.75rem 1.5rem;gap:1.25rem;z-index:999;box-shadow:0 10px 30px rgba(0,87,184,0.08);border-top:1.5px solid var(--border);';
        }

        // Scroll reveal
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));
    </script>

    @stack('scripts')
    @livewireScripts
</body>

</html>
