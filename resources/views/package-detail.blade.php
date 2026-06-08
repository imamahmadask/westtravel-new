@extends('layouts.app', [
    'title' => $package['name'] . ' — WestTravel.id | Lombok, Sumbawa & Dunia',
    'activeNav' => 'packages',
    'navbarScrolled' => true,
])

@section('meta')
    <meta name="description" content="{{ $package['desc'] }}" />
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/package-detail.css') }}" />
@endpush

@section('content')

    {{-- ═══ HERO ═══ --}}
    <section class="pkd-hero">
        <div class="pkd-hero-bg" style="background-image: url('{{ $package['hero_img'] }}');"></div>
        <div class="pkd-hero-overlay"></div>
        <div class="pkd-hero-content container">
            {{-- Breadcrumb --}}
            <nav class="pkd-breadcrumb" aria-label="breadcrumb">
                <a href="{{ url('/') }}"><i class="fas fa-home"></i> Beranda</a>
                <span><i class="fas fa-chevron-right"></i></span>
                <a href="{{ url('/packages') }}">Paket Wisata</a>
                <span><i class="fas fa-chevron-right"></i></span>
                <span class="current">{{ $package['name'] }}</span>
            </nav>

            <div class="pkd-hero-meta">
                <span class="pkg-badge {{ $package['badge_class'] }}">{{ $package['category'] }}</span>
                @if(!empty($package['popular_badge']))
                    <span class="pkd-popular">{{ $package['popular_badge'] }}</span>
                @endif
            </div>

            <h1>{{ $package['name'] }}</h1>
            <p class="pkd-hero-desc">{{ $package['desc'] }}</p>

            <div class="pkd-hero-stats">
                <div class="pkd-stat">
                    <i class="fas fa-star"></i>
                    <span><strong>{{ $package['rating'] }}</strong> ({{ $package['reviews'] }} ulasan)</span>
                </div>
                <div class="pkd-stat-divider"></div>
                <div class="pkd-stat">
                    <i class="fas fa-moon"></i>
                    <span>{{ $package['duration'] }}</span>
                </div>
                <div class="pkd-stat-divider"></div>
                <div class="pkd-stat">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $package['location'] }}</span>
                </div>
                <div class="pkd-stat-divider"></div>
                <div class="pkd-stat">
                    <i class="fas fa-users"></i>
                    <span>Min {{ $package['min_pax'] }} orang</span>
                </div>
            </div>
        </div>

        {{-- Wave --}}
        <div class="pkd-hero-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" preserveAspectRatio="none" width="100%" height="80">
                <path fill="#F6FAFF" d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" />
            </svg>
        </div>
    </section>

    {{-- ═══ MAIN CONTENT ═══ --}}
    <section class="pkd-main-section">
        <div class="container">
            <div class="pkd-layout">

                {{-- ── LEFT COLUMN (content) ── --}}
                <div class="pkd-content-col">

                    {{-- Gallery --}}
                    <div class="pkd-block fade-up" id="pkd-gallery">
                        <div class="pkd-gallery-grid">
                            @foreach($package['gallery'] as $idx => $img)
                                <div class="pkd-gallery-item {{ $idx === 0 ? 'pkd-gallery-main' : '' }}"
                                     onclick="openLightbox({{ $idx }})">
                                    <img src="{{ $img }}" alt="{{ $package['name'] }} foto {{ $idx + 1 }}" loading="{{ $idx > 0 ? 'lazy' : 'eager' }}" />
                                    @if($idx === 0)
                                        <div class="pkd-gallery-overlay">
                                            <i class="fas fa-expand-alt"></i>
                                        </div>
                                    @endif
                                    @if($idx === 3 && count($package['gallery']) > 4)
                                        <div class="pkd-gallery-more">
                                            <span>+{{ count($package['gallery']) - 4 }} foto</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Tab Navigation --}}
                    <div class="pkd-tabs fade-up">
                        <button class="pkd-tab active" data-tab="overview" id="tab-overview">
                            <i class="fas fa-info-circle"></i> Overview
                        </button>
                        <button class="pkd-tab" data-tab="itinerary" id="tab-itinerary">
                            <i class="fas fa-route"></i> Itinerary
                        </button>
                        <button class="pkd-tab" data-tab="includes" id="tab-includes">
                            <i class="fas fa-check-circle"></i> Include/Exclude
                        </button>
                        <button class="pkd-tab" data-tab="reviews" id="tab-reviews">
                            <i class="fas fa-star"></i> Ulasan
                        </button>
                        <button class="pkd-tab" data-tab="location" id="tab-location">
                            <i class="fas fa-map-marked-alt"></i> Lokasi
                        </button>
                    </div>

                    {{-- ── TAB: OVERVIEW ── --}}
                    <div class="pkd-tab-content active" id="tab-content-overview">

                        {{-- About Package --}}
                        <div class="pkd-block fade-up">
                            <h2 class="pkd-section-title">
                                <span class="pkd-title-accent"></span>
                                Tentang Paket Ini
                            </h2>
                            <p class="pkd-long-desc">{{ $package['desc_long'] }}</p>
                        </div>

                        {{-- Highlights --}}
                        <div class="pkd-block fade-up">
                            <h2 class="pkd-section-title">
                                <span class="pkd-title-accent"></span>
                                Fasilitas & Keunggulan
                            </h2>
                            <div class="pkd-highlights-grid">
                                @foreach($package['highlights'] as $item)
                                    <div class="pkd-highlight-card">
                                        <div class="pkd-highlight-icon">
                                            <i class="{{ $item['icon'] }}"></i>
                                        </div>
                                        <div class="pkd-highlight-text">
                                            <strong>{{ $item['title'] }}</strong>
                                            <span>{{ $item['sub'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    {{-- ── TAB: ITINERARY ── --}}
                    <div class="pkd-tab-content" id="tab-content-itinerary">
                        <div class="pkd-block">
                            <h2 class="pkd-section-title">
                                <span class="pkd-title-accent"></span>
                                Rencana Perjalanan
                            </h2>
                            <div class="pkd-itinerary">
                                @foreach($package['itinerary'] as $day)
                                    <div class="pkd-day-card">
                                        <div class="pkd-day-header" onclick="toggleDay(this)">
                                            <div class="pkd-day-badge">Hari {{ $day['day'] }}</div>
                                            <div class="pkd-day-info">
                                                <h3>{{ $day['title'] }}</h3>
                                                <p>{{ $day['desc'] }}</p>
                                            </div>
                                            <i class="fas fa-chevron-down pkd-day-arrow"></i>
                                        </div>
                                        <div class="pkd-day-body {{ $loop->first ? 'open' : '' }}">
                                            <ul class="pkd-activities">
                                                @foreach($day['activities'] as $act)
                                                    <li>
                                                        <span class="act-dot"></span>
                                                        {{ $act }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @if(!empty($day['note']))
                                                <div class="pkd-day-note">
                                                    <i class="fas fa-info-circle"></i>
                                                    {{ $day['note'] }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- ── TAB: INCLUDES / EXCLUDES ── --}}
                    <div class="pkd-tab-content" id="tab-content-includes">
                        <div class="pkd-block">
                            <h2 class="pkd-section-title">
                                <span class="pkd-title-accent"></span>
                                Yang Sudah Termasuk
                            </h2>
                            <div class="pkd-inc-exc-grid">
                                <div class="pkd-inc-col">
                                    <h4><i class="fas fa-check-circle"></i> Termasuk</h4>
                                    <ul class="pkd-inc-list">
                                        @foreach($package['includes'] as $inc)
                                            <li><i class="fas fa-check"></i> {{ $inc }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="pkd-exc-col">
                                    <h4><i class="fas fa-times-circle"></i> Tidak Termasuk</h4>
                                    <ul class="pkd-exc-list">
                                        @foreach($package['excludes'] as $exc)
                                            <li><i class="fas fa-times"></i> {{ $exc }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            @if(!empty($package['notes']))
                                <div class="pkd-notes-box">
                                    <h4><i class="fas fa-exclamation-circle me-2"></i>Catatan Penting</h4>
                                    <ul>
                                        @foreach($package['notes'] as $note)
                                            <li>{{ $note }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- ── TAB: REVIEWS ── --}}
                    <div class="pkd-tab-content" id="tab-content-reviews">
                        <div class="pkd-block">
                            <h2 class="pkd-section-title">
                                <span class="pkd-title-accent"></span>
                                Ulasan Wisatawan
                            </h2>

                            {{-- Rating Summary --}}
                            <div class="pkd-rating-summary">
                                <div class="pkd-rating-big">
                                    <span class="pkd-rating-num">{{ number_format($package['rating'], 1) }}</span>
                                    <div class="pkd-stars-big">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= floor($package['rating']) ? 'fas' : ($i - 0.5 <= $package['rating'] ? 'fas fa-star-half-alt' : 'far') }} fa-star"></i>
                                        @endfor
                                    </div>
                                    <span class="pkd-rating-total">{{ $package['reviews'] }} ulasan</span>
                                </div>
                                <div class="pkd-rating-bars">
                                    @foreach([5,4,3,2,1] as $star)
                                        <div class="pkd-rating-bar-row">
                                            <span>{{ $star }} <i class="fas fa-star"></i></span>
                                            <div class="pkd-rating-bar">
                                                <div class="pkd-rating-bar-fill" style="width: {{ $star === 5 ? '82' : ($star === 4 ? '14' : ($star === 3 ? '4' : '0')) }}%"></div>
                                            </div>
                                            <span class="pkd-bar-pct">{{ $star === 5 ? '82' : ($star === 4 ? '14' : ($star === 3 ? '4' : '0')) }}%</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Review Cards --}}
                            <div class="pkd-reviews">
                                @foreach($package['review_list'] as $review)
                                    <div class="pkd-review-card">
                                        <div class="pkd-review-header">
                                            <div class="pkd-reviewer-avatar">
                                                {{ strtoupper(substr($review['name'], 0, 1)) }}
                                            </div>
                                            <div class="pkd-reviewer-info">
                                                <strong>{{ $review['name'] }}</strong>
                                                <span>{{ $review['date'] }}</span>
                                            </div>
                                            <div class="pkd-review-stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="{{ $i <= $review['rating'] ? 'fas' : 'far' }} fa-star"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="pkd-review-text">"{{ $review['text'] }}"</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- ── TAB: LOCATION ── --}}
                    <div class="pkd-tab-content" id="tab-content-location">
                        <div class="pkd-block">
                            <h2 class="pkd-section-title">
                                <span class="pkd-title-accent"></span>
                                Lokasi Destinasi
                            </h2>
                            <div class="pkd-map-info">
                                <div class="pkd-map-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <strong>Lokasi</strong>
                                        <span>{{ $package['location'] }}</span>
                                    </div>
                                </div>
                                <div class="pkd-map-detail">
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Bahasa Pemandu</strong>
                                        <span>{{ $package['language'] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pkd-map-embed">
                                <iframe
                                    src="{{ $package['map_embed'] }}"
                                    width="100%"
                                    height="400"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="Peta lokasi {{ $package['name'] }}"
                                ></iframe>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ── RIGHT COLUMN (booking sidebar) ── --}}
                <aside class="pkd-sidebar">
                    <div class="pkd-booking-card">
                        {{-- Price --}}
                        <div class="pkd-booking-price">
                            <span class="pkd-booking-from">Mulai dari</span>
                            <div class="pkd-booking-amount">{{ $package['price_display'] }}</div>
                            <span class="pkd-booking-per">/orang</span>
                        </div>

                        {{-- Quick Info --}}
                        <div class="pkd-booking-info">
                            <div class="pkd-binfo-row">
                                <span><i class="fas fa-moon"></i> Durasi</span>
                                <strong>{{ $package['duration'] }}</strong>
                            </div>
                            <div class="pkd-binfo-row">
                                <span><i class="fas fa-users"></i> Min. Peserta</span>
                                <strong>{{ $package['min_pax'] }} orang</strong>
                            </div>
                            <div class="pkd-binfo-row">
                                <span><i class="fas fa-language"></i> Bahasa</span>
                                <strong>{{ $package['language'] }}</strong>
                            </div>
                            <div class="pkd-binfo-row">
                                <span><i class="fas fa-star"></i> Rating</span>
                                <strong>{{ $package['rating'] }} ⭐</strong>
                            </div>
                        </div>

                        {{-- CTA --}}
                        <a href="https://wa.me/6281234567890?text=Halo%20WestTravel%2C%20saya%20ingin%20booking%20paket%20{{ urlencode($package['name']) }}"
                           class="pkd-btn-book" target="_blank" id="btn-book-whatsapp">
                            <i class="fab fa-whatsapp me-2"></i>Pesan via WhatsApp
                        </a>
                        <a href="{{ url('/') }}#contact" class="pkd-btn-consult" id="btn-consult">
                            <i class="fas fa-headset me-2"></i>Konsultasi Gratis
                        </a>

                        <p class="pkd-booking-note">
                            <i class="fas fa-shield-alt"></i>
                            Pembayaran aman. DP 30% untuk konfirmasi booking.
                        </p>
                    </div>

                    {{-- Share --}}
                    <div class="pkd-share-card">
                        <h4>Bagikan Paket Ini</h4>
                        <div class="pkd-share-btns">
                            <a href="https://wa.me/?text={{ urlencode($package['name'] . ' - ' . url()->current()) }}" target="_blank" class="pkd-share-btn pkd-share-wa" title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="pkd-share-btn pkd-share-fb" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($package['name']) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="pkd-share-btn pkd-share-tw" title="Twitter/X">
                                <i class="fab fa-x-twitter"></i>
                            </a>
                            <button class="pkd-share-btn pkd-share-copy" onclick="copyLink()" title="Salin Link" id="btn-copy-link">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </section>

    {{-- ═══ RELATED PACKAGES ═══ --}}
    @if(!empty($package['related']))
    <section class="pkd-related-section">
        <div class="container">
            <div class="pkd-related-header fade-up">
                <span class="label-tag"><i class="fas fa-compass me-1"></i> Paket Lainnya</span>
                <h2 class="section-title mt-2">Paket yang <em>Mungkin Anda Suka</em></h2>
            </div>
            <div class="row g-4 mt-2">
                @foreach($package['related'] as $rel)
                    <div class="col-md-6 col-lg-4 fade-up">
                        <div class="package-card">
                            <div class="package-img">
                                <img src="{{ $rel['img'] }}" alt="{{ $rel['name'] }}" loading="lazy" />
                                <span class="pkg-badge {{ $rel['badge_class'] }}">{{ $rel['category'] }}</span>
                                <span class="pkg-duration"><i class="fas fa-moon me-1"></i>{{ $rel['duration'] }}</span>
                            </div>
                            <div class="package-body">
                                <h3>{{ $rel['name'] }}</h3>
                                <p class="pkg-desc">{{ $rel['desc'] }}</p>
                                <div class="pkg-footer">
                                    <div class="pkg-price">
                                        <span class="from">Mulai dari</span>
                                        <span class="amount">{{ $rel['price'] }}</span>
                                        <span class="per">/orang</span>
                                    </div>
                                    <a href="{{ url('/packages/' . $rel['slug']) }}" class="btn-pkg">Detail →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ═══ LIGHTBOX ═══ --}}
    <div class="pkd-lightbox" id="pkdLightbox" onclick="closeLightbox(event)">
        <div class="pkd-lightbox-inner">
            <button class="pkd-lb-close" onclick="closeLightbox()" aria-label="Tutup">
                <i class="fas fa-times"></i>
            </button>
            <button class="pkd-lb-prev" onclick="lbPrev(event)" aria-label="Sebelumnya">
                <i class="fas fa-chevron-left"></i>
            </button>
            <img src="" id="lbImage" alt="Gallery" />
            <button class="pkd-lb-next" onclick="lbNext(event)" aria-label="Berikutnya">
                <i class="fas fa-chevron-right"></i>
            </button>
            <div class="pkd-lb-counter" id="lbCounter"></div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // ── Gallery Images Data ──
    const galleryImages = @json($package['gallery']);

    // ── Lightbox ──
    let currentLbIndex = 0;
    function openLightbox(idx) {
        currentLbIndex = idx;
        updateLightbox();
        document.getElementById('pkdLightbox').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox(e) {
        if (!e || e.target === document.getElementById('pkdLightbox') || e.currentTarget.classList.contains('pkd-lb-close')) {
            document.getElementById('pkdLightbox').classList.remove('open');
            document.body.style.overflow = '';
        }
    }
    function lbPrev(e) {
        e.stopPropagation();
        currentLbIndex = (currentLbIndex - 1 + galleryImages.length) % galleryImages.length;
        updateLightbox();
    }
    function lbNext(e) {
        e.stopPropagation();
        currentLbIndex = (currentLbIndex + 1) % galleryImages.length;
        updateLightbox();
    }
    function updateLightbox() {
        const img = document.getElementById('lbImage');
        img.src = galleryImages[currentLbIndex];
        document.getElementById('lbCounter').textContent = (currentLbIndex + 1) + ' / ' + galleryImages.length;
    }
    document.addEventListener('keydown', (e) => {
        if (!document.getElementById('pkdLightbox').classList.contains('open')) return;
        if (e.key === 'ArrowLeft') lbPrev(e);
        if (e.key === 'ArrowRight') lbNext(e);
        if (e.key === 'Escape') closeLightbox();
    });

    // ── Tab Navigation ──
    document.querySelectorAll('.pkd-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.pkd-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.pkd-tab-content').forEach(c => c.classList.remove('active'));
            tab.classList.add('active');
            const target = document.getElementById('tab-content-' + tab.dataset.tab);
            if (target) target.classList.add('active');
        });
    });

    // ── Itinerary Accordion ──
    function toggleDay(header) {
        const body = header.nextElementSibling;
        const arrow = header.querySelector('.pkd-day-arrow');
        const isOpen = body.classList.contains('open');
        body.classList.toggle('open', !isOpen);
        arrow.style.transform = !isOpen ? 'rotate(180deg)' : 'rotate(0deg)';
    }

    // ── Copy Link ──
    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            const btn = document.getElementById('btn-copy-link');
            btn.innerHTML = '<i class="fas fa-check"></i>';
            setTimeout(() => { btn.innerHTML = '<i class="fas fa-link"></i>'; }, 2000);
        });
    }

    // ── Sticky Sidebar ──
    const sidebar = document.querySelector('.pkd-sidebar');
    const bookingCard = document.querySelector('.pkd-booking-card');
    if (sidebar && bookingCard) {
        window.addEventListener('scroll', () => {
            const sidebarRect = sidebar.getBoundingClientRect();
            const isNearBottom = sidebarRect.bottom < window.innerHeight;
            // handled by CSS position: sticky
        });
    }
</script>
@endpush
