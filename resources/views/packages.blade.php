<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paket Wisata — WestTravel.id | Lombok, Sumbawa & Dunia</title>
    <meta name="description" content="Temukan paket wisata terbaik ke Lombok, Sumbawa, dan destinasi internasional bersama WestTravel.id. Harga terjangkau, pengalaman tak terlupakan." />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Fraunces:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}?v=1.1" />
    <link rel="stylesheet" href="{{ asset('assets/css/packages.css') }}" />
</head>

<body>

    <!-- ═══ NAVBAR ═══ -->
    <nav class="navbar-west scrolled" id="mainNav">
        <a href="{{ url('/') }}" class="brand">
            <img id="navbar-logo" src="{{ asset('assets/img/logo2.png') }}" alt="westtravel" width="200" 
                 data-original="{{ asset('assets/img/logo.png') }}" 
                 data-scrolled="{{ asset('assets/img/logo2.png') }}">
        </a>
        <ul class="nav-links">
            <li><a href="{{ url('/packages') }}" class="active-nav">Paket Wisata</a></li>
            <li><a href="{{ url('/') }}#about">Tentang Kami</a></li>
            <li><a href="{{ url('/') }}#gallery">Galeri</a></li>
            <li><a href="{{ url('/') }}#why-us">Keunggulan</a></li>
        </ul>
        <a href="{{ url('/') }}#contact" class="btn-nav">Hubungi Kami</a>
        <button class="navbar-toggler-west" onclick="toggleMenu()" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </nav>

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
                    <button class="filter-btn" data-filter="lombok" id="filter-lombok">
                        <i class="fas fa-mountain me-1"></i>Lombok
                    </button>
                    <button class="filter-btn" data-filter="sumbawa" id="filter-sumbawa">
                        <i class="fas fa-water me-1"></i>Sumbawa
                    </button>
                    <button class="filter-btn" data-filter="intl" id="filter-intl">
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
                <p class="pkg-result-count"><span id="resultCount">9</span> paket ditemukan</p>
                <div class="view-toggle">
                    <button class="view-btn active" id="viewGrid" title="Grid View"><i class="fas fa-th"></i></button>
                    <button class="view-btn" id="viewList" title="List View"><i class="fas fa-list"></i></button>
                </div>
            </div>

            <!-- Packages Grid -->
            <div class="row g-4" id="packagesGrid">

                <!-- Card 1 -->
                <div class="col-md-6 col-lg-4 fade-up package-item" data-cat="lombok" data-price="1800000" data-duration="3">
                    <div class="package-card">
                        <div class="package-img">
                            <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=700&q=80" alt="Gili Islands" loading="lazy" />
                            <span class="pkg-badge pkg-badge-lombok">Lombok</span>
                            <span class="pkg-duration"><i class="fas fa-moon me-1"></i>3H / 2M</span>
                            <button class="pkg-wishlist" title="Simpan ke Wishlist"><i class="far fa-heart"></i></button>
                        </div>
                        <div class="package-body">
                            <div class="pkg-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <span>4.9 (128 ulasan)</span>
                            </div>
                            <h3>Gili Islands Getaway</h3>
                            <p class="pkg-desc">Nikmati keindahan tiga Gili yang ikonik — Trawangan, Meno, dan Air. Snorkeling, sunset, dan ketenangan pantai tropis.</p>
                            <ul class="pkg-highlights">
                                <li><i class="fas fa-hotel me-1"></i>Hotel Bintang 3</li>
                                <li><i class="fas fa-fish me-1"></i>Snorkeling</li>
                                <li><i class="fas fa-ship me-1"></i>Boat Transfer</li>
                                <li><i class="fas fa-user-tie me-1"></i>Tour Guide</li>
                            </ul>
                            <div class="pkg-footer">
                                <div class="pkg-price">
                                    <span class="from">Mulai dari</span>
                                    <span class="amount">Rp 1,8 Jt</span>
                                    <span class="per">/orang</span>
                                </div>
                                <a href="{{ url('/packages/gili-islands') }}" class="btn-pkg">Detail →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6 col-lg-4 fade-up package-item" data-cat="lombok" data-price="2500000" data-duration="4" style="transition-delay:.08s">
                    <div class="package-card">
                        <div class="package-img">
                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=700&q=80" alt="Rinjani" loading="lazy" />
                            <span class="pkg-badge pkg-badge-lombok">Lombok</span>
                            <span class="pkg-duration"><i class="fas fa-moon me-1"></i>4H / 3M</span>
                            <button class="pkg-wishlist" title="Simpan ke Wishlist"><i class="far fa-heart"></i></button>
                            <div class="pkg-popular-badge">🔥 Terpopuler</div>
                        </div>
                        <div class="package-body">
                            <div class="pkg-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <span>5.0 (94 ulasan)</span>
                            </div>
                            <h3>Pendakian Rinjani</h3>
                            <p class="pkg-desc">Taklukkan puncak Gunung Rinjani 3.726 mdpl. Jelajahi Segara Anak dan danau kawah yang memukau.</p>
                            <ul class="pkg-highlights">
                                <li><i class="fas fa-campground me-1"></i>Tenda Camping</li>
                                <li><i class="fas fa-hands-helping me-1"></i>Porter</li>
                                <li><i class="fas fa-utensils me-1"></i>Makan 3x/hari</li>
                                <li><i class="fas fa-first-aid me-1"></i>Rescue Kit</li>
                            </ul>
                            <div class="pkg-footer">
                                <div class="pkg-price">
                                    <span class="from">Mulai dari</span>
                                    <span class="amount">Rp 2,5 Jt</span>
                                    <span class="per">/orang</span>
                                </div>
                                <a href="{{ url('/packages/pendakian-rinjani') }}" class="btn-pkg">Detail →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-6 col-lg-4 fade-up package-item" data-cat="lombok" data-price="3200000" data-duration="5" style="transition-delay:.16s">
                    <div class="package-card">
                        <div class="package-img">
                            <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=700&q=80" alt="Lombok Tour" loading="lazy" />
                            <span class="pkg-badge pkg-badge-lombok">Lombok</span>
                            <span class="pkg-duration"><i class="fas fa-moon me-1"></i>5H / 4M</span>
                            <button class="pkg-wishlist" title="Simpan ke Wishlist"><i class="far fa-heart"></i></button>
                        </div>
                        <div class="package-body">
                            <div class="pkg-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                <span>4.8 (71 ulasan)</span>
                            </div>
                            <h3>Lombok Lengkap Tour</h3>
                            <p class="pkg-desc">Paket lengkap menjelajahi Lombok — Mandalika, Desa Sade, Air Terjun Sendang Gile, hingga tenun Sukarara.</p>
                            <ul class="pkg-highlights">
                                <li><i class="fas fa-hotel me-1"></i>Hotel Bintang 4</li>
                                <li><i class="fas fa-car me-1"></i>AC Vehicle</li>
                                <li><i class="fas fa-ticket-alt me-1"></i>Semua Entry</li>
                                <li><i class="fas fa-camera me-1"></i>Dokumentasi</li>
                            </ul>
                            <div class="pkg-footer">
                                <div class="pkg-price">
                                    <span class="from">Mulai dari</span>
                                    <span class="amount">Rp 3,2 Jt</span>
                                    <span class="per">/orang</span>
                                </div>
                                <a href="{{ url('/packages/lombok-lengkap') }}" class="btn-pkg">Detail →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-md-6 col-lg-4 fade-up package-item" data-cat="lombok" data-price="4500000" data-duration="5" style="transition-delay:.08s">
                    <div class="package-card">
                        <div class="package-img">
                            <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=700&q=80" alt="Senggigi Beach" loading="lazy" />
                            <span class="pkg-badge pkg-badge-lombok">Lombok</span>
                            <span class="pkg-duration"><i class="fas fa-moon me-1"></i>5H / 4M</span>
                            <button class="pkg-wishlist" title="Simpan ke Wishlist"><i class="far fa-heart"></i></button>
                            <div class="pkg-popular-badge" style="background: #0057B8;">💎 Premium</div>
                        </div>
                        <div class="package-body">
                            <div class="pkg-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <span>4.9 (55 ulasan)</span>
                            </div>
                            <h3>Senggigi Luxury Escape</h3>
                            <p class="pkg-desc">Pengalaman mewah di Senggigi dengan villa tepi pantai, spa, dan sunset cruise eksklusif.</p>
                            <ul class="pkg-highlights">
                                <li><i class="fas fa-star me-1"></i>Villa Bintang 5</li>
                                <li><i class="fas fa-spa me-1"></i>Spa Treatment</li>
                                <li><i class="fas fa-ship me-1"></i>Sunset Cruise</li>
                                <li><i class="fas fa-concierge-bell me-1"></i>Butler Service</li>
                            </ul>
                            <div class="pkg-footer">
                                <div class="pkg-price">
                                    <span class="from">Mulai dari</span>
                                    <span class="amount">Rp 4,5 Jt</span>
                                    <span class="per">/orang</span>
                                </div>
                                <a href="{{ url('/packages/senggigi-luxury-escape') }}" class="btn-pkg">Detail →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="col-md-6 col-lg-4 fade-up package-item" data-cat="sumbawa" data-price="2800000" data-duration="4" style="transition-delay:.1s">
                    <div class="package-card">
                        <div class="package-img">
                            <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=700&q=80" alt="Sumbawa" loading="lazy" />
                            <span class="pkg-badge pkg-badge-sumbawa">Sumbawa</span>
                            <span class="pkg-duration"><i class="fas fa-moon me-1"></i>4H / 3M</span>
                            <button class="pkg-wishlist" title="Simpan ke Wishlist"><i class="far fa-heart"></i></button>
                        </div>
                        <div class="package-body">
                            <div class="pkg-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                <span>4.7 (43 ulasan)</span>
                            </div>
                            <h3>Sumbawa Hidden Paradise</h3>
                            <p class="pkg-desc">Temukan Sumbawa yang masih perawan — Pantai Maluk, Teluk Saleh, dan budaya Mbojo yang autentik.</p>
                            <ul class="pkg-highlights">
                                <li><i class="fas fa-home me-1"></i>Penginapan Lokal</li>
                                <li><i class="fas fa-ship me-1"></i>Boat Charter</li>
                                <li><i class="fas fa-fish me-1"></i>Snorkeling</li>
                                <li><i class="fas fa-user-tie me-1"></i>Guide Lokal</li>
                            </ul>
                            <div class="pkg-footer">
                                <div class="pkg-price">
                                    <span class="from">Mulai dari</span>
                                    <span class="amount">Rp 2,8 Jt</span>
                                    <span class="per">/orang</span>
                                </div>
                                <a href="{{ url('/packages/sumbawa-paradise') }}" class="btn-pkg">Detail →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="col-md-6 col-lg-4 fade-up package-item" data-cat="sumbawa" data-price="3500000" data-duration="3" style="transition-delay:.2s">
                    <div class="package-card">
                        <div class="package-img">
                            <img src="https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=700&q=80" alt="Pulau Moyo" loading="lazy" />
                            <span class="pkg-badge pkg-badge-sumbawa">Sumbawa</span>
                            <span class="pkg-duration"><i class="fas fa-moon me-1"></i>3H / 2M</span>
                            <button class="pkg-wishlist" title="Simpan ke Wishlist"><i class="far fa-heart"></i></button>
                        </div>
                        <div class="package-body">
                            <div class="pkg-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <span>5.0 (62 ulasan)</span>
                            </div>
                            <h3>Pulau Moyo Retreat</h3>
                            <p class="pkg-desc">Pulau Moyo — destinasi eksklusif pernah dikunjungi Lady Diana. Air terjun, diving, dan hutan tropis memukau.</p>
                            <ul class="pkg-highlights">
                                <li><i class="fas fa-campground me-1"></i>Glamping</li>
                                <li><i class="fas fa-swimmer me-1"></i>Diving</li>
                                <li><i class="fas fa-tint me-1"></i>Air Terjun</li>
                                <li><i class="fas fa-sun me-1"></i>Sunset Tour</li>
                            </ul>
                            <div class="pkg-footer">
                                <div class="pkg-price">
                                    <span class="from">Mulai dari</span>
                                    <span class="amount">Rp 3,5 Jt</span>
                                    <span class="per">/orang</span>
                                </div>
                                <a href="{{ url('/packages/pulau-moyo') }}" class="btn-pkg">Detail →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="col-md-6 col-lg-4 fade-up package-item" data-cat="sumbawa" data-price="2200000" data-duration="3" style="transition-delay:.3s">
                    <div class="package-card">
                        <div class="package-img">
                            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=700&q=80" alt="Pantai Maluk" loading="lazy" />
                            <span class="pkg-badge pkg-badge-sumbawa">Sumbawa</span>
                            <span class="pkg-duration"><i class="fas fa-moon me-1"></i>3H / 2M</span>
                            <button class="pkg-wishlist" title="Simpan ke Wishlist"><i class="far fa-heart"></i></button>
                        </div>
                        <div class="package-body">
                            <div class="pkg-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                <span>4.5 (38 ulasan)</span>
                            </div>
                            <h3>Surfing Pantai Maluk</h3>
                            <p class="pkg-desc">Rasakan ombak kelas dunia di Supersuck, Pantai Maluk. Surga para surfer dari seluruh penjuru dunia.</p>
                            <ul class="pkg-highlights">
                                <li><i class="fas fa-water me-1"></i>Surfing Board</li>
                                <li><i class="fas fa-chalkboard-teacher me-1"></i>Instruktur</li>
                                <li><i class="fas fa-home me-1"></i>Penginapan</li>
                                <li><i class="fas fa-utensils me-1"></i>Sarapan</li>
                            </ul>
                            <div class="pkg-footer">
                                <div class="pkg-price">
                                    <span class="from">Mulai dari</span>
                                    <span class="amount">Rp 2,2 Jt</span>
                                    <span class="per">/orang</span>
                                </div>
                                <a href="{{ url('/packages/surfing-pantai-maluk') }}" class="btn-pkg">Detail →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 8 -->
                <div class="col-md-6 col-lg-4 fade-up package-item" data-cat="intl" data-price="8900000" data-duration="7" style="transition-delay:.1s">
                    <div class="package-card">
                        <div class="package-img">
                            <img src="https://images.unsplash.com/photo-1508009603885-50cf7c579365?w=700&q=80" alt="Thailand" loading="lazy" />
                            <span class="pkg-badge pkg-badge-intl">Luar Negeri</span>
                            <span class="pkg-duration"><i class="fas fa-moon me-1"></i>7H / 6M</span>
                            <button class="pkg-wishlist" title="Simpan ke Wishlist"><i class="far fa-heart"></i></button>
                            <div class="pkg-popular-badge">🔥 Terpopuler</div>
                        </div>
                        <div class="package-body">
                            <div class="pkg-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <span>4.9 (201 ulasan)</span>
                            </div>
                            <h3>Thailand Grand Tour</h3>
                            <p class="pkg-desc">Bangkok, Chiang Mai, dan Phuket dalam satu paket. Kuil megah, pasar apung, dan pantai Andaman yang jernih.</p>
                            <ul class="pkg-highlights">
                                <li><i class="fas fa-plane me-1"></i>Tiket PP</li>
                                <li><i class="fas fa-hotel me-1"></i>Hotel Bintang 4</li>
                                <li><i class="fas fa-user-tie me-1"></i>Guide Bahasa</li>
                                <li><i class="fas fa-ticket-alt me-1"></i>Semua Masuk</li>
                            </ul>
                            <div class="pkg-footer">
                                <div class="pkg-price">
                                    <span class="from">Mulai dari</span>
                                    <span class="amount">Rp 8,9 Jt</span>
                                    <span class="per">/orang</span>
                                </div>
                                <a href="{{ url('/packages/thailand-tour') }}" class="btn-pkg">Detail →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 9 -->
                <div class="col-md-6 col-lg-4 fade-up package-item" data-cat="intl" data-price="12500000" data-duration="9" style="transition-delay:.2s">
                    <div class="package-card">
                        <div class="package-img">
                            <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=700&q=80" alt="Bali to Japan" loading="lazy" />
                            <span class="pkg-badge pkg-badge-intl">Luar Negeri</span>
                            <span class="pkg-duration"><i class="fas fa-moon me-1"></i>9H / 8M</span>
                            <button class="pkg-wishlist" title="Simpan ke Wishlist"><i class="far fa-heart"></i></button>
                            <div class="pkg-popular-badge" style="background: #0057B8;">💎 Premium</div>
                        </div>
                        <div class="package-body">
                            <div class="pkg-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <span>4.9 (88 ulasan)</span>
                            </div>
                            <h3>Jepang Sakura Tour</h3>
                            <p class="pkg-desc">Saksikan keajaiban mekar bunga sakura di Tokyo, Kyoto, dan Osaka. Budaya, kuliner, dan alam Jepang dalam satu perjalanan.</p>
                            <ul class="pkg-highlights">
                                <li><i class="fas fa-plane me-1"></i>Tiket PP</li>
                                <li><i class="fas fa-hotel me-1"></i>Hotel Bintang 4+</li>
                                <li><i class="fas fa-subway me-1"></i>JR Pass 7 Hari</li>
                                <li><i class="fas fa-user-tie me-1"></i>Guide Lokal</li>
                            </ul>
                            <div class="pkg-footer">
                                <div class="pkg-price">
                                    <span class="from">Mulai dari</span>
                                    <span class="amount">Rp 12,5 Jt</span>
                                    <span class="per">/orang</span>
                                </div>
                                <a href="{{ url('/packages/jepang-sakura-tour') }}" class="btn-pkg">Detail →</a>
                            </div>
                        </div>
                    </div>
                </div>

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

    <!-- ═══ FOOTER ═══ -->
    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <a href="{{ url('/') }}" class="brand">West<span>Travel</span>.id</a>
                    <p class="footer-desc">Agen perjalanan wisata terpercaya di Lombok dan Sumbawa. Menghadirkan pengalaman tak terlupakan sejak 2016.</p>
                    <div class="social-links mt-4">
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" title="TikTok"><i class="fab fa-tiktok"></i></a>
                        <a href="#" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <h5>Paket Wisata</h5>
                    <ul>
                        <li><a href="#">Gili Islands</a></li>
                        <li><a href="#">Rinjani Trek</a></li>
                        <li><a href="#">Lombok Tour</a></li>
                        <li><a href="#">Sumbawa</a></li>
                        <li><a href="#">Pulau Moyo</a></li>
                        <li><a href="#">Luar Negeri</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <h5>Perusahaan</h5>
                    <ul>
                        <li><a href="{{ url('/') }}#about">Tentang Kami</a></li>
                        <li><a href="{{ url('/') }}#why-us">Keunggulan</a></li>
                        <li><a href="{{ url('/') }}#gallery">Galeri</a></li>
                        <li><a href="#">Blog & Tips</a></li>
                        <li><a href="{{ url('/') }}#contact">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5>Newsletter</h5>
                    <p style="font-size:0.83rem; margin-bottom:1rem;">Dapatkan promo dan inspirasi wisata terbaru langsung di inbox Anda.</p>
                    <div class="newsletter-wrap">
                        <input type="email" placeholder="Email Anda..." />
                        <button>Daftar</button>
                    </div>
                    <p style="font-size:0.75rem; margin-top:0.65rem; opacity:0.5;">✓ Tanpa spam. Unsubscribe kapanpun.</p>
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

        function handleNavbarScroll() {
            const isScrolled = window.scrollY > 60;
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
            const btn = document.querySelector('.btn-nav');
            if (!links) return;
            const open = links.style.display === 'flex';
            links.style.cssText = open ? '' :
                'display:flex;flex-direction:column;position:fixed;top:68px;left:0;right:0;background:rgba(255,255,255,0.97);backdrop-filter:blur(16px);padding:2rem;gap:1.5rem;z-index:999;box-shadow:0 8px 30px rgba(0,87,184,0.1);';
            if (btn) btn.style.display = open ? 'none' : 'block';
        }

        // All package items
        const allItems = document.querySelectorAll('.package-item');
        const noResult = document.getElementById('noResult');
        const resultCount = document.getElementById('resultCount');

        function updateCount() {
            const visible = [...allItems].filter(el => el.style.display !== 'none');
            resultCount.textContent = visible.length;
            noResult.classList.toggle('hidden', visible.length > 0);
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
        document.getElementById('searchInput').addEventListener('input', e => {
            currentSearch = e.target.value.toLowerCase().trim();
            applyFilters();
        });

        // Sort
        document.getElementById('sortSelect').addEventListener('change', e => {
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

        // Reset filter
        function resetFilter() {
            currentFilter = 'all';
            currentSearch = '';
            document.getElementById('searchInput').value = '';
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            document.querySelector('[data-filter="all"]').classList.add('active');
            applyFilters();
        }

        // View toggle
        const grid = document.getElementById('packagesGrid');
        document.getElementById('viewGrid').addEventListener('click', function() {
            this.classList.add('active');
            document.getElementById('viewList').classList.remove('active');
            grid.classList.remove('list-view');
            allItems.forEach(item => {
                item.className = item.className.replace(/col-\d+/g, '').trim();
                item.classList.add('col-md-6', 'col-lg-4');
            });
        });
        document.getElementById('viewList').addEventListener('click', function() {
            this.classList.add('active');
            document.getElementById('viewGrid').classList.remove('active');
            grid.classList.add('list-view');
            allItems.forEach(item => {
                item.classList.remove('col-md-6', 'col-lg-4');
                item.classList.add('col-12');
            });
        });

        // Wishlist toggle
        document.querySelectorAll('.pkg-wishlist').forEach(btn => {
            btn.addEventListener('click', () => {
                const icon = btn.querySelector('i');
                icon.classList.toggle('far');
                icon.classList.toggle('fas');
                icon.style.color = icon.classList.contains('fas') ? '#e74c3c' : '';
            });
        });

        // Scroll reveal
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
        }, { threshold: 0.1 });
        document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));
    </script>

</body>
</html>
