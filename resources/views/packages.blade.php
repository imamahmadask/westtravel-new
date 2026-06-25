@extends('layouts.app', [
    'title' => 'Paket Wisata — WestTravel.id | Lombok, Sumbawa & Dunia',
    'activeNav' => 'packages',
])

@section('meta')
    <meta name="description" content="Temukan paket wisata terbaik ke Lombok, Sumbawa, dan destinasi internasional bersama WestTravel.id. Harga terjangkau, pengalaman tak terlupakan." />
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/packages.css') }}" />
@endpush

@section('content')
    <!-- ═══ PAGE HERO ═══ -->
    <section class="page-hero">
        <div class="page-hero-bg"></div>
        <div class="page-hero-content">
            <span class="hero-eyebrow">✦ 35+ Paket Tersedia</span>
            <h1>Temukan <em>Paket Wisata</em><br>Impian Anda</h1>
            <p>Dari Gili Trawangan yang memukau hingga petualangan internasional. Semua tersedia dengan harga terbaik dan layanan premium.</p>
            <div class="page-hero-search">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari destinasi, paket, atau aktivitas..." />
                </div>
            </div>
        </div>
        <div class="page-hero-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" preserveAspectRatio="none" width="100%" height="80">
                <path fill="#F6FAFF" d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" />
            </svg>
        </div>
    </section>

    <!-- ═══ PACKAGES LIST ═══ -->
    <section class="packages-page-section">
        <div class="container">

            <!-- Filter & Sort Bar -->
            <div class="pkg-toolbar fade-up">
                <div class="pkg-filters">
                    <span class="filter-label"><i class="fas fa-sliders-h me-2"></i>Filter:</span>
                    <button class="filter-btn active" data-filter="all" id="filter-all">Semua</button>
                    <button class="filter-btn" data-filter="lombok-package" id="filter-lombok">
                        <i class="fas fa-mountain me-1"></i>Lombok
                    </button>
                    <button class="filter-btn" data-filter="gili-package" id="filter-gili">
                        <i class="fas fa-mountain me-1"></i>Gili
                    </button>
                    <button class="filter-btn" data-filter="rinjani-package" id="filter-rinjani">
                        <i class="fas fa-mountain me-1"></i>Rinjani
                    </button>
                    <button class="filter-btn" data-filter="sumbawa-package" id="filter-sumbawa">
                        <i class="fas fa-water me-1"></i>Sumbawa
                    </button>
                    <button class="filter-btn" data-filter="international-package" id="filter-international">
                        <i class="fas fa-globe me-1"></i>Luar Negeri
                    </button>
                </div>
                <div class="pkg-sort">
                    <label for="sortSelect"><i class="fas fa-sort me-1"></i></label>
                    <select id="sortSelect" class="sort-select">
                        <option value="default">Urutkan: Default</option>
                        <option value="price-asc">Harga: Terendah</option>
                        <option value="price-desc">Harga: Tertinggi</option>
                        <option value="duration-asc">Durasi: Terpendek</option>
                        <option value="duration-desc">Durasi: Terlama</option>
                    </select>
                </div>
            </div>

            <!-- Result Count -->
            <div class="pkg-result-bar fade-up">
                <p class="pkg-result-count"><span id="resultCount">{{ $packages->count() }}</span> paket ditemukan</p>
                <div class="view-toggle">
                    <button class="view-btn active" id="viewGrid" title="Grid View"><i class="fas fa-th"></i></button>
                    <button class="view-btn" id="viewList" title="List View"><i class="fas fa-list"></i></button>
                </div>
            </div>

            <!-- Packages Grid -->
            <div class="row g-4" id="packagesGrid">
                @foreach($packages as $idx => $pkg)
                <div class="col-md-6 col-lg-4 fade-up package-item" data-cat="{{ $pkg->category->slug ?? 'lombok' }}" data-price="{{ $pkg->price }}" data-duration="{{ preg_match('/\d+/', $pkg->type, $matches) ? $matches[0] : 3 }}" style="transition-delay:{{ ($idx % 3) * 0.08 }}s">
                    <div class="package-card">
                        <div class="package-img">
                            @if(is_array($pkg->images) && count($pkg->images) > 0)
                                <img src="{{ Storage::url($pkg->images[0]) }}" alt="{{ $pkg->title }}" loading="lazy" />
                            @else
                                <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=700&q=80" alt="{{ $pkg->title }}" loading="lazy" />
                            @endif
                            <span class="pkg-badge pkg-badge-{{ $pkg->category->slug ?? 'lombok' }}">{{ $pkg->category->name ?? 'Lombok' }}</span>
                            <span class="pkg-duration"><i class="fas fa-moon me-1"></i>{{ $pkg->type }}</span>
                            <button class="pkg-wishlist" title="Simpan ke Wishlist"><i class="far fa-heart"></i></button>
                            @if($pkg->is_featured)
                                <div class="pkg-popular-badge">🔥 Terpopuler</div>
                            @endif
                        </div>
                        <div class="package-body">
                            <div class="pkg-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <span>4.9 (120 ulasan)</span>
                            </div>
                            <h3>{{ $pkg->title }}</h3>
                            <p class="pkg-desc">{{ \Illuminate\Support\Str::limit(strip_tags($pkg->description), 120) }}</p>
                            <ul class="pkg-highlights">
                                <li>Min {{ $pkg->min_pax }} Pax</li>
                                <li>{{ $pkg->type }}</li>
                                <li>{{ $pkg->location }}</li>
                                <li>{{ is_array($pkg->country) ? implode(', ', $pkg->country) : $pkg->country }}</li>
                            </ul>
                            <div class="pkg-footer">
                                <div class="pkg-price">
                                    <span class="from">Mulai dari</span>
                                    <span class="amount">Rp {{ number_format($pkg->price / 1000000, 1, ',', '.') }} Jt</span>
                                    <span class="per">/orang</span>
                                </div>
                                <a href="{{ url('/packages/' . $pkg->slug) }}" class="btn-pkg">Detail →</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- No Result State -->
            <div class="no-result hidden" id="noResult">
                <i class="fas fa-search-minus"></i>
                <h3>Tidak ada paket ditemukan</h3>
                <p>Coba ubah kata kunci pencarian atau filter Anda.</p>
                <button class="btn-outline-blue" onclick="resetFilter()">Reset Filter</button>
            </div>

            <!-- CTA Banner -->
            <div class="custom-cta-banner fade-up">
                <div class="cta-banner-content">
                    <div class="cta-icon"><i class="fas fa-headset"></i></div>
                    <div>
                        <h3>Tidak menemukan paket yang cocok?</h3>
                        <p>Tim kami siap membuatkan itinerary custom sesuai budget dan keinginan Anda.</p>
                    </div>
                </div>
                <a href="{{ url('/') }}#contact" class="btn-hero-primary">
                    <i class="fas fa-paper-plane me-2"></i>Konsultasi Gratis
                </a>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
<script>
    // All package items
    const allItems = document.querySelectorAll('.package-item');
    const noResult = document.getElementById('noResult');
    const resultCount = document.getElementById('resultCount');

    function updateCount() {
        const visible = [...allItems].filter(el => el.style.display !== 'none');
        resultCount.textContent = visible.length;
        if(noResult) noResult.classList.toggle('hidden', visible.length > 0);
    }

    // Package filter
    let currentFilter = 'all';
    let currentSearch = '';

    function applyFilters() {
        allItems.forEach(item => {
            const matchCat = currentFilter === 'all' || item.dataset.cat === currentFilter;
            const name = item.querySelector('h3').textContent.toLowerCase();
            const desc = item.querySelector('.pkg-desc').textContent.toLowerCase();
            const matchSearch = currentSearch === '' || name.includes(currentSearch) || desc.includes(currentSearch);
            item.style.display = (matchCat && matchSearch) ? '' : 'none';
        });
        updateCount();
    }

    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentFilter = btn.dataset.filter;
            applyFilters();
        });
    });

    // Search
    const searchInput = document.getElementById('searchInput');
    if(searchInput) {
        searchInput.addEventListener('input', e => {
            currentSearch = e.target.value.toLowerCase().trim();
            applyFilters();
        });
    }

    // Sort
    const sortSelect = document.getElementById('sortSelect');
    if(sortSelect) {
        sortSelect.addEventListener('change', e => {
            const grid = document.getElementById('packagesGrid');
            const items = [...document.querySelectorAll('.package-item')];
            items.sort((a, b) => {
                const pA = parseInt(a.dataset.price), pB = parseInt(b.dataset.price);
                const dA = parseInt(a.dataset.duration), dB = parseInt(b.dataset.duration);
                if (e.target.value === 'price-asc') return pA - pB;
                if (e.target.value === 'price-desc') return pB - pA;
                if (e.target.value === 'duration-asc') return dA - dB;
                if (e.target.value === 'duration-desc') return dB - dA;
                return 0;
            });
            items.forEach(item => grid.appendChild(item));
        });
    }

    // Reset filter
    window.resetFilter = function() {
        currentFilter = 'all';
        currentSearch = '';
        if(searchInput) searchInput.value = '';
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        const allBtn = document.querySelector('[data-filter="all"]');
        if(allBtn) allBtn.classList.add('active');
        applyFilters();
    }

    // View toggle
    const grid = document.getElementById('packagesGrid');
    const viewGrid = document.getElementById('viewGrid');
    const viewList = document.getElementById('viewList');
    
    if(viewGrid && viewList) {
        viewGrid.addEventListener('click', function() {
            this.classList.add('active');
            viewList.classList.remove('active');
            grid.classList.remove('list-view');
            allItems.forEach(item => {
                item.className = item.className.replace(/col-\d+/g, '').trim();
                item.classList.add('col-md-6', 'col-lg-4');
            });
        });
        viewList.addEventListener('click', function() {
            this.classList.add('active');
            viewGrid.classList.remove('active');
            grid.classList.add('list-view');
            allItems.forEach(item => {
                item.classList.remove('col-md-6', 'col-lg-4');
                item.classList.add('col-12');
            });
        });
    }

    // Wishlist toggle
    document.querySelectorAll('.pkg-wishlist').forEach(btn => {
        btn.addEventListener('click', () => {
            const icon = btn.querySelector('i');
            icon.classList.toggle('far');
            icon.classList.toggle('fas');
            icon.style.color = icon.classList.contains('fas') ? '#e74c3c' : '';
        });
    });
</script>
@endpush
