@extends('layouts.app', [
    'title' => $package['name'] . ' — WestTravel.id',
    'activeNav' => 'packages',
])

@section('meta')
    <meta name="description" content="{{ $package['desc'] }}" />
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/packages.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/package-detail.css') }}?v=1.3" />
@endpush

@section('content')
    <!-- DETAIL HERO -->
    <section class="detail-hero" style="background-image: url('{{ $package['hero_img'] }}');"
        aria-labelledby="packageHeroTitle">
        <div class="detail-hero-overlay"></div>
        <div class="detail-hero-content container">
            <div class="detail-hero-body">
                <div>
                    <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
                        <span class="pkg-badge {{ $package['badge_class'] }}">{{ $package['category'] }}</span>
                        @if ($package['popular_badge'])
                            <span class="pkg-popular-badge-inline">{{ $package['popular_badge'] }}</span>
                        @endif
                    </div>
                    <h1 id="packageHeroTitle">{{ $package['name'] }}</h1>
                    <div class="detail-hero-meta">
                        <span><i class="fas fa-moon"></i> {{ $package['duration'] }}</span>
                        <span><i class="fas fa-map-marker-alt"></i> {{ $package['location'] }}</span>
                        <span><i class="fas fa-users"></i> Min. {{ $package['min_pax'] }} orang</span>
                        <div class="detail-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="fas fa-star{{ $i > $package['rating'] ? ($package['rating'] - floor($package['rating']) >= 0.5 && $i == ceil($package['rating']) ? '-half-alt' : '') : '' }}"></i>
                            @endfor
                            <span>{{ $package['rating'] }} ({{ $package['reviews'] }} ulasan)</span>
                        </div>
                    </div>
                </div>
                <div class="detail-hero-price-box">
                    <span class="from">Mulai dari</span>
                    <div class="price">{{ $package['price_display'] }}</div>
                    <span class="per">/orang</span>
                    <a href="#booking" class="btn-book-now">
                        <i class="fas fa-calendar-check me-2"></i>Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>

        <!-- Photo Scroll Hint -->
        <div class="detail-hero-photos" id="photoStrip">
            @foreach ($package['gallery'] as $i => $img)
                <div class="detail-thumb {{ $i === 0 ? 'active' : '' }}" onclick="openLightbox({{ $i }})">
                    <img src="{{ $img }}" alt="Gallery {{ $i + 1 }}" loading="lazy" />
                </div>
            @endforeach
            <button class="thumb-more" onclick="openLightbox(0)">
                <i class="fas fa-th"></i> Semua Foto
            </button>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="detail-layout container">
        <div class="row g-5">

            <!-- LEFT: Main Content -->
            <div class="col-lg-8">

                <!-- Quick Stats -->
                <div class="detail-quick-stats fade-up">
                    <div class="quick-stat">
                        <i class="fas fa-clock"></i>
                        <div>
                            <span class="qs-label">Durasi</span>
                            <span class="qs-val">{{ $package['duration'] }}</span>
                        </div>
                    </div>
                    <div class="quick-stat">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <span class="qs-label">Destinasi</span>
                            <span class="qs-val">{{ $package['location'] }}</span>
                        </div>
                    </div>
                    <div class="quick-stat">
                        <i class="fas fa-users"></i>
                        <div>
                            <span class="qs-label">Grup Min.</span>
                            <span class="qs-val">{{ $package['min_pax'] }} orang</span>
                        </div>
                    </div>
                    <div class="quick-stat">
                        <i class="fas fa-language"></i>
                        <div>
                            <span class="qs-label">Bahasa</span>
                            <span class="qs-val">{{ $package['language'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Tab Navigation -->
                <div class="detail-tabs fade-up" id="detailTabs">
                    <button class="dtab active" data-tab="overview" onclick="switchTab('overview')">Overview</button>
                    <button class="dtab" data-tab="itinerary" onclick="switchTab('itinerary')">Itinerary</button>
                    <button class="dtab" data-tab="includes" onclick="switchTab('includes')">Include/Exclude</button>
                    <button class="dtab" data-tab="reviews" onclick="switchTab('reviews')">Ulasan</button>
                </div>

                <!-- Tab: Overview -->
                <div class="tab-content-panel active" id="tab-overview">
                    <div class="detail-section fade-up">
                        <h2 class="detail-section-title">Tentang Paket Ini</h2>
                        <p class="detail-desc-full">{{ $package['desc_long'] }}</p>
                    </div>

                    <div class="detail-section fade-up">
                        <h2 class="detail-section-title">Highlight Paket</h2>
                        <div class="highlight-grid">
                            @foreach ($package['highlights'] as $h)
                                <div class="highlight-item">
                                    <div class="highlight-icon"><i class="{{ $h['icon'] }}"></i></div>
                                    <div>
                                        <div class="highlight-title">{{ $h['title'] }}</div>
                                        <div class="highlight-sub">{{ $h['sub'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="detail-section fade-up">
                        <h2 class="detail-section-title">Peta Destinasi</h2>
                        <div class="map-wrap" style="height: 280px;">
                            <iframe src="{{ $package['map_embed'] }}" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>

                <!-- Tab: Itinerary -->
                <div class="tab-content-panel" id="tab-itinerary">
                    <div class="detail-section fade-up">
                        <h2 class="detail-section-title">Jadwal Perjalanan</h2>
                        <div class="itinerary-list">
                            @foreach ($package['itinerary'] as $day)
                                <div class="itinerary-day">
                                    <div class="itin-day-badge">Hari {{ $day['day'] }}</div>
                                    <div class="itin-body">
                                        <h4>{{ $day['title'] }}</h4>
                                        <p>{{ $day['desc'] }}</p>
                                        @if (isset($day['activities']))
                                            <ul class="itin-activities">
                                                @foreach ($day['activities'] as $act)
                                                    <li><i class="fas fa-circle-dot"></i> {{ $act }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        @if (isset($day['note']))
                                            <div class="itin-note"><i
                                                    class="fas fa-info-circle me-2"></i>{{ $day['note'] }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Tab: Include / Exclude -->
                <div class="tab-content-panel" id="tab-includes">
                    <div class="detail-section fade-up">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h2 class="detail-section-title text-success-custom">
                                    <i class="fas fa-check-circle me-2"></i>Sudah Termasuk
                                </h2>
                                <ul class="incl-list incl-yes">
                                    @foreach ($package['includes'] as $inc)
                                        <li><i class="fas fa-check"></i>{{ $inc }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h2 class="detail-section-title text-danger-custom">
                                    <i class="fas fa-times-circle me-2"></i>Tidak Termasuk
                                </h2>
                                <ul class="incl-list incl-no">
                                    @foreach ($package['excludes'] as $exc)
                                        <li><i class="fas fa-times"></i>{{ $exc }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if (isset($package['notes']))
                            <div class="important-notes mt-4">
                                <h4><i class="fas fa-exclamation-triangle me-2"></i>Catatan Penting</h4>
                                <ul>
                                    @foreach ($package['notes'] as $note)
                                        <li>{{ $note }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tab: Reviews -->
                <div class="tab-content-panel" id="tab-reviews">
                    <div class="detail-section fade-up">
                        <div class="reviews-summary">
                            <div class="reviews-score">
                                <div class="score-big">{{ $package['rating'] }}</div>
                                <div class="score-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <div class="score-count">{{ $package['reviews'] }} ulasan</div>
                            </div>
                            <div class="reviews-bars">
                                @foreach ([5 => 92, 4 => 6, 3 => 1, 2 => 1, 1 => 0] as $star => $pct)
                                    <div class="rating-bar-row">
                                        <span>{{ $star }}<i class="fas fa-star ms-1"></i></span>
                                        <div class="rating-bar">
                                            <div class="rating-bar-fill" style="width:{{ $pct }}%"></div>
                                        </div>
                                        <span>{{ $pct }}%</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="reviews-list mt-4">
                            @foreach ($package['review_list'] as $rev)
                                <div class="review-card">
                                    <div class="review-header">
                                        <div class="reviewer-avatar">{{ strtoupper(substr($rev['name'], 0, 1)) }}</div>
                                        <div>
                                            <div class="reviewer-name">{{ $rev['name'] }}</div>
                                            <div class="reviewer-date">{{ $rev['date'] }}</div>
                                        </div>
                                        <div class="review-stars ms-auto">
                                            @for ($i = 0; $i < $rev['rating']; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="review-text">{{ $rev['text'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT: Sticky Booking Sidebar -->
            <div class="col-lg-4">
                <div class="booking-sidebar" id="booking">
                    <div class="booking-price-header">
                        <span class="from">Mulai dari</span>
                        <div class="booking-price">{{ $package['price_display'] }}</div>
                        <span class="per">/orang</span>
                    </div>

                    <div class="booking-rating">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                        <span>{{ $package['rating'] }} · {{ $package['reviews'] }} ulasan</span>
                    </div>

                    <form class="booking-form" onsubmit="submitBooking(event)">
                        <div class="booking-field">
                            <label for="bookDate"><i class="fas fa-calendar me-2"></i>Tanggal Berangkat</label>
                            <input type="date" id="bookDate" required
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" />
                        </div>
                        <div class="booking-field-row">
                            <div class="booking-field">
                                <label for="bookPax"><i class="fas fa-users me-2"></i>Jumlah Pax</label>
                                <input type="number" id="bookPax" value="{{ $package['min_pax'] }}"
                                    min="{{ $package['min_pax'] }}" max="50" required />
                            </div>
                            <div class="booking-field">
                                <label for="bookType"><i class="fas fa-bed me-2"></i>Tipe Kamar</label>
                                <select id="bookType">
                                    <option>Double</option>
                                    <option>Twin</option>
                                    <option>Triple</option>
                                </select>
                            </div>
                        </div>
                        <div class="booking-field">
                            <label for="bookName"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
                            <input type="text" id="bookName" placeholder="Nama Anda" required />
                        </div>
                        <div class="booking-field">
                            <label for="bookPhone"><i class="fas fa-phone me-2"></i>No. WhatsApp</label>
                            <input type="tel" id="bookPhone" placeholder="08xxxxxxxxxx" required />
                        </div>
                        <div class="booking-price-breakdown" id="priceBreakdown">
                            <div class="pb-row">
                                <span>{{ $package['price_display'] }} × <span
                                        id="paxCount">{{ $package['min_pax'] }}</span> orang</span>
                                <span id="pbTotal">—</span>
                            </div>
                            <div class="pb-row pb-total">
                                <span>Total Estimasi</span>
                                <span id="pbGrandTotal">—</span>
                            </div>
                        </div>
                        <button type="submit" class="btn-book-submit" id="bookSubmitBtn">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Permintaan
                        </button>
                        <p class="booking-note"><i class="fas fa-shield-alt me-1"></i>Gratis konsultasi · Tanpa biaya
                            tambahan</p>
                    </form>

                    <div class="booking-whatsapp">
                        <a href="https://wa.me/6281234567890?text=Halo%20WestTravel!%20Saya%20tertarik%20dengan%20paket%20{{ urlencode($package['name']) }}"
                            target="_blank">
                            <i class="fab fa-whatsapp"></i> Chat Langsung via WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Info Cards -->
                <div class="sidebar-info-cards">
                    <div class="sic-item">
                        <i class="fas fa-shield-virus"></i>
                        <div>
                            <div class="sic-title">Terpercaya & Berpengalaman</div>
                            <div class="sic-sub">Beroperasi sejak 2016 dengan 1.200+ wisatawan puas</div>
                        </div>
                    </div>
                    <div class="sic-item">
                        <i class="fas fa-headset"></i>
                        <div>
                            <div class="sic-title">Support 24/7</div>
                            <div class="sic-sub">Tim kami siap membantu kapanpun Anda butuhkan</div>
                        </div>
                    </div>
                    <div class="sic-item">
                        <i class="fas fa-undo-alt"></i>
                        <div>
                            <div class="sic-title">Fleksibel Reschedule</div>
                            <div class="sic-sub">Ubah jadwal hingga 7 hari sebelum keberangkatan</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Related Packages -->
        <div class="related-packages fade-up">
            <h2 class="section-title mb-4">Paket <em>Terkait</em></h2>
            <div class="row g-4">
                @foreach ($package['related'] as $rel)
                    <div class="col-md-6 col-lg-4">
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

    </div>

    <!-- Lightbox -->
    <div class="lightbox-overlay" id="lightboxOverlay" onclick="closeLightbox()">
        <button class="lightbox-close" onclick="closeLightbox()"><i class="fas fa-times"></i></button>
        <button class="lightbox-prev" onclick="event.stopPropagation(); moveLightbox(-1)"><i
                class="fas fa-chevron-left"></i></button>
        <div class="lightbox-img-wrap" onclick="event.stopPropagation()">
            <img id="lightboxImg" src="" alt="" />
        </div>
        <button class="lightbox-next" onclick="event.stopPropagation(); moveLightbox(1)"><i
                class="fas fa-chevron-right"></i></button>
        <div class="lightbox-counter" id="lightboxCounter"></div>
    </div>

@endsection

@push('scripts')
    <script>
        // Tabs
        function switchTab(tab) {
            document.querySelectorAll('.dtab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content-panel').forEach(p => p.classList.remove('active'));
            document.querySelector(`[data-tab="${tab}"]`).classList.add('active');
            document.getElementById(`tab-${tab}`).classList.add('active');
        }

        // Price Breakdown
        const basePrice = {{ $package['price_raw'] }};
        const paxInput = document.getElementById('bookPax');

        function updateBreakdown() {
            const pax = parseInt(paxInput.value) || 1;
            document.getElementById('paxCount').textContent = pax;
            const total = basePrice * pax;
            const fmt = n => 'Rp ' + n.toLocaleString('id-ID');
            document.getElementById('pbTotal').textContent = fmt(total);
            document.getElementById('pbGrandTotal').textContent = fmt(total);
        }

        paxInput.addEventListener('input', updateBreakdown);
        updateBreakdown();

        // Booking Submit
        function submitBooking(e) {
            e.preventDefault();
            const btn = document.getElementById('bookSubmitBtn');
            const date = document.getElementById('bookDate').value;
            const pax = document.getElementById('bookPax').value;
            const name = document.getElementById('bookName').value;
            const phone = document.getElementById('bookPhone').value;

            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
            btn.disabled = true;

            setTimeout(() => {
                const waMsg = encodeURIComponent(
                    `Halo WestTravel! Saya ingin pesan paket:\n\n` +
                    `📦 Paket: {{ $package['name'] }}\n` +
                    `📅 Tanggal: ${date}\n` +
                    `👥 Jumlah Pax: ${pax} orang\n` +
                    `👤 Nama: ${name}\n` +
                    `📱 No. HP: ${phone}`
                );
                window.open(`https://wa.me/6281234567890?text=${waMsg}`, '_blank');
                btn.innerHTML = '<i class="fas fa-check me-2"></i>Permintaan Terkirim!';
                btn.style.background = '#1A7FD4';
                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Kirim Permintaan';
                    btn.style.background = '';
                    btn.disabled = false;
                }, 3000);
            }, 800);
        }

        // Lightbox
        const gallery = @json($package['gallery']);
        let currentPhoto = 0;

        function openLightbox(idx) {
            currentPhoto = idx;
            document.getElementById('lightboxImg').src = gallery[idx];
            document.getElementById('lightboxCounter').textContent = `${idx + 1} / ${gallery.length}`;
            document.getElementById('lightboxOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightboxOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }

        function moveLightbox(dir) {
            currentPhoto = (currentPhoto + dir + gallery.length) % gallery.length;
            openLightbox(currentPhoto);
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') moveLightbox(1);
            if (e.key === 'ArrowLeft') moveLightbox(-1);
        });

        // Sticky Sidebar
        const sidebar = document.querySelector('.booking-sidebar');
        const sidebarParent = sidebar?.parentElement;
        window.addEventListener('scroll', () => {
            if (!sidebar) return;
            const top = sidebarParent.getBoundingClientRect().top;
            sidebar.classList.toggle('stuck', top < 80);
        });

        // Scroll reveal
        const obs2 = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, {
            threshold: 0.08
        });
        document.querySelectorAll('.fade-up').forEach(el => obs2.observe(el));
    </script>
@endpush
