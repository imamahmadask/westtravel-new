@extends('layouts.app')

@section('content')
    <!-- ═══ HERO ═══ -->
    <section id="hero">
        <div class="hero-bg"></div>
        <div class="hero-content">
            <span class="hero-eyebrow">✦ Lombok · Sumbawa · International</span>
            <h1>West Travel <em>Indonesia</em></h1>
            <h3>Wander Without Worry</h3>
            <div class="hero-cta">
                <a href="#packages" class="btn-hero-primary"><i class="fas fa-map-marked-alt me-2"></i>Lihat Paket
                    Wisata</a>
                <a href="#contact" class="btn-hero-ghost"><i class="fas fa-headset me-2"></i>Konsultasi Gratis</a>
            </div>
        </div>
        <div class="hero-scroll">
            <div class="scroll-dot"></div>
            <span>Scroll</span>
        </div>
        <div class="hero-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" preserveAspectRatio="none" width="100%"
                height="80">
                <path fill="#ffffff" d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" />
            </svg>
        </div>
    </section>

    <!-- ═══ STATS ═══ -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-3">
                <div class="col-6 col-lg-3 fade-up">
                    <div class="stat-pill">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <div>
                            <div class="stat-num">1.200+</div>
                            <div class="stat-label">Wisatawan Puas</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 fade-up" style="transition-delay:.08s">
                    <div class="stat-pill">
                        <div class="stat-icon"><i class="fas fa-suitcase-rolling"></i></div>
                        <div>
                            <div class="stat-num">35+</div>
                            <div class="stat-label">Paket Wisata</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 fade-up" style="transition-delay:.16s">
                    <div class="stat-pill">
                        <div class="stat-icon"><i class="fas fa-award"></i></div>
                        <div>
                            <div class="stat-num">8</div>
                            <div class="stat-label">Tahun Pengalaman</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 fade-up" style="transition-delay:.24s">
                    <div class="stat-pill">
                        <div class="stat-icon"><i class="fas fa-star"></i></div>
                        <div>
                            <div class="stat-num">4.9★</div>
                            <div class="stat-label">Rating Google</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ PACKAGES ═══ -->
    <section id="packages">
        <div class="container">
            <div class="row align-items-end mb-5 fade-up">
                <div class="col-lg-7">
                    <span class="label-tag mb-3">Paket Perjalanan</span>
                    <h2 class="section-title mt-2">Temukan Destinasi <em>Impian Anda</em></h2>
                </div>
                <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                    <div class="package-filter justify-content-lg-end">
                        <button class="filter-btn active" data-filter="all">Semua</button>
                        <button class="filter-btn" data-filter="lombok">Lombok</button>
                        <button class="filter-btn" data-filter="sumbawa">Sumbawa</button>
                        <button class="filter-btn" data-filter="intl">Luar Negeri</button>
                    </div>
                </div>
            </div>
            <div class="row g-4" id="packagesGrid">
                @foreach($packages as $idx => $pkg)
                <div class="col-md-6 col-lg-4 fade-up package-item" data-cat="{{ $pkg->category->slug ?? 'lombok' }}" style="transition-delay:{{ ($idx % 3) * 0.1 }}s">
                    <div class="package-card">
                        <div class="package-img">
                            @if(is_array($pkg->images) && count($pkg->images) > 0)
                                <img src="{{ Storage::url($pkg->images[0]) }}" alt="{{ $pkg->title }}" loading="lazy" />
                            @else
                                <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=700&q=80" alt="{{ $pkg->title }}" loading="lazy" />
                            @endif
                            <span class="pkg-badge pkg-badge-{{ $pkg->category->slug ?? 'lombok' }}">{{ $pkg->category->name ?? 'Lombok' }}</span>
                            <span class="pkg-duration"><i class="fas fa-moon me-1"></i>{{ $pkg->type }}</span>
                        </div>
                        <div class="package-body">
                            <h3>{{ $pkg->title }}</h3>
                            <p class="pkg-desc">{{ \Illuminate\Support\Str::limit(strip_tags($pkg->description), 120) }}</p>
                            <ul class="pkg-highlights">
                                <li>Min {{ $pkg->min_pax }} Pax</li>
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
            <div class="text-center mt-5 fade-up">
                <a href="{{ url('/packages') }}" class="btn-outline-blue"><i class="fas fa-list me-2"></i>Lihat
                    Semua
                    Paket</a>
            </div>
        </div>
    </section>

    <!-- wave divider -->
    <div class="wave-divider" style="background: var(--off-white);">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60" preserveAspectRatio="none" height="60"
            width="100%">
            <path fill="#0057B8" d="M0,30 C480,60 960,0 1440,30 L1440,60 L0,60 Z" />
        </svg>
    </div>

    <!-- ═══ ABOUT ═══ -->
    <section id="about">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 fade-up d-none d-lg-block">
                    <div class="about-img-grid">
                        <img src="https://images.unsplash.com/photo-1506197603052-3cc9c3a201bd?w=800&q=80"
                            alt="Tim WestTravel" />
                        <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=500&q=80"
                            alt="Gili" />
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=500&q=80"
                            alt="Resort" />
                    </div>
                </div>
                <div class="col-lg-7 fade-up" style="transition-delay:.15s">
                    <div class="about-text">
                        <span class="label-tag">Tentang Kami</span>
                        <h2>Kami adalah <em>Teman Perjalanan</em> Terpercaya Anda</h2>
                        <p>Didirikan di Mataram pada 2016, WestTravel.id lahir dari kecintaan mendalam terhadap
                            keindahan alam Nusa Tenggara Barat. Kami percaya setiap perjalanan adalah cerita yang layak
                            diingat seumur hidup.</p>
                        <p>Dengan tim pemandu lokal berpengalaman dan berlisensi, kami menghadirkan pengalaman wisata
                            yang autentik, aman, dan berkesan — bukan sekadar paket tour biasa.</p>
                        <div class="about-values">
                            <div class="about-value"><i class="fas fa-shield-alt"></i>
                                <h4>Aman & Terpercaya</h4>
                                <p>Berizin resmi, diasuransikan, dan telah melayani ribuan wisatawan.</p>
                            </div>
                            <div class="about-value"><i class="fas fa-map-marked-alt"></i>
                                <h4>Pemandu Lokal</h4>
                                <p>Tim kami putra daerah yang fasih bahasa lokal dan budaya setempat.</p>
                            </div>
                            <div class="about-value"><i class="fas fa-star"></i>
                                <h4>Kustom Itinerari</h4>
                                <p>Kami merancang paket sesuai kebutuhan, anggaran, dan preferensi Anda.</p>
                            </div>
                            <div class="about-value"><i class="fas fa-headset"></i>
                                <h4>Dukungan 24/7</h4>
                                <p>Tim kami siap membantu selama perjalanan, kapanpun Anda butuhkan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- wave divider -->
    <div class="wave-divider" style="background: var(--white);">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60" preserveAspectRatio="none" height="60"
            width="100%">
            <path fill="#0057B8" d="M1440,30 C960,0 480,60 0,30 L0,0 L1440,0 Z" />
        </svg>
    </div>

    <!-- ═══ WHY US ═══ -->
    <section id="why-us">
        <div class="container">
            <div class="row justify-content-center text-center mb-5 fade-up">
                <div class="col-lg-6">
                    <span class="label-tag mb-3">Keunggulan Kami</span>
                    <h2 class="section-title mt-2">Mengapa Pilih <em>WestTravel?</em></h2>
                    <p class="mt-3" style="font-size:0.9rem; color:var(--muted);">Kami bukan sekadar agen
                        perjalanan. Kami adalah mitra terpercaya untuk setiap petualangan Anda.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 fade-up">
                    <div class="why-card">
                        <div class="why-num">01</div>
                        <div class="why-icon-wrap"><i class="fas fa-compass"></i></div>
                        <h3>Destinasi Eksklusif</h3>
                        <p>Akses ke lokasi tersembunyi yang tidak ditemukan di paket agen lain — surga rahasia hanya
                            untuk Anda.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 fade-up" style="transition-delay:.1s">
                    <div class="why-card">
                        <div class="why-num">02</div>
                        <div class="why-icon-wrap"><i class="fas fa-tags"></i></div>
                        <h3>Harga Transparan</h3>
                        <p>Tidak ada biaya tersembunyi. Semua tertera jelas — apa yang Anda bayar, itulah yang Anda
                            dapat.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 fade-up" style="transition-delay:.2s">
                    <div class="why-card">
                        <div class="why-num">03</div>
                        <div class="why-icon-wrap"><i class="fas fa-camera-retro"></i></div>
                        <h3>Dokumentasi Gratis</h3>
                        <p>Setiap paket dilengkapi foto dan video profesional sebagai kenangan tak ternilai.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 fade-up" style="transition-delay:.3s">
                    <div class="why-card">
                        <div class="why-num">04</div>
                        <div class="why-icon-wrap"><i class="fas fa-leaf"></i></div>
                        <h3>Wisata Berkelanjutan</h3>
                        <p>Kami berkomitmen menjaga kelestarian alam dan memberdayakan komunitas lokal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ GALLERY ═══ -->
    <section id="gallery">
        <div class="container">
            <div class="row align-items-end mb-5 fade-up">
                <div class="col-lg-7">
                    <span class="label-tag mb-3">Instagram Gallery</span>
                    <h2 class="section-title mt-2">Momen yang Kami <em>Abadikan</em></h2>
                </div>
                <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                    <a href="https://instagram.com/westtravel.id" target="_blank"
                        style="font-size:0.83rem; font-weight:600; color:var(--blue-mid); text-decoration:none;">
                        <i class="fab fa-instagram me-2"></i>@westtravel.id
                    </a>
                </div>
            </div>
            <div class="gallery-grid fade-up">
                <div class="gallery-item"><img
                        src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800&q=80" alt="Gili"
                        loading="lazy" />
                    <div class="gallery-overlay"><i class="fab fa-instagram"></i></div>
                </div>
                <div class="gallery-item"><img
                        src="https://images.unsplash.com/photo-1506197603052-3cc9c3a201bd?w=600&q=80" alt="Sunset"
                        loading="lazy" />
                    <div class="gallery-overlay"><i class="fab fa-instagram"></i></div>
                </div>
                <div class="gallery-item"><img
                        src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600&q=80" alt="Pantai"
                        loading="lazy" />
                    <div class="gallery-overlay"><i class="fab fa-instagram"></i></div>
                </div>
                <div class="gallery-item"><img
                        src="https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=400&q=80" alt="Air Terjun"
                        loading="lazy" />
                    <div class="gallery-overlay"><i class="fab fa-instagram"></i></div>
                </div>
                <div class="gallery-item"><img
                        src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400&q=80" alt="Alam"
                        loading="lazy" />
                    <div class="gallery-overlay"><i class="fab fa-instagram"></i></div>
                </div>
                <div class="gallery-item"><img
                        src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&q=80" alt="Laut"
                        loading="lazy" />
                    <div class="gallery-overlay"><i class="fab fa-instagram"></i></div>
                </div>
            </div>
            <div class="text-center mt-5 fade-up">
                <a href="https://instagram.com/westtravel.id" target="_blank" class="btn-outline-blue"
                    style="display:inline-flex; align-items:center; gap:8px; text-decoration:none;">
                    <i class="fab fa-instagram"></i>Ikuti @westtravel.id
                </a>
            </div>
        </div>
    </section>

    <!-- ═══ CONTACT ═══ -->
    <section id="contact">
        <div class="container">
            <div class="row justify-content-center text-center mb-5 fade-up">
                <div class="col-lg-6">
                    <span class="label-tag mb-3">Hubungi Kami</span>
                    <h2 class="section-title mt-2">Rencanakan Perjalanan <em>Impian Anda</em></h2>
                    <p class="mt-3" style="font-size:0.9rem; color:var(--muted);">Ceritakan destinasi impian Anda,
                        kami siapkan itinerari terbaik.</p>
                </div>
            </div>
            <div class="row g-4 align-items-start">
                <div class="col-lg-5 fade-up">
                    <div class="contact-card">
                        <div class="contact-info-item">
                            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h4>Alamat Kantor</h4>
                                <p>Jl. Pariwisata No. 12, Mataram<br>Nusa Tenggara Barat, 83115</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                            <div>
                                <h4>Telepon / WhatsApp</h4><a href="tel:+6281234567890">+62 812-3456-7890</a>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <h4>Email</h4><a href="mailto:info@westtravel.id">info@westtravel.id</a>
                            </div>
                        </div>
                        <div class="contact-info-item" style="margin-bottom:0">
                            <div class="contact-icon"><i class="fas fa-clock"></i></div>
                            <div>
                                <h4>Jam Operasional</h4>
                                <p>Senin – Sabtu: 08.00 – 17.00 WITA<br>Minggu: 09.00 – 14.00 WITA</p>
                            </div>
                        </div>
                        <hr style="border-color: var(--border); margin: 2rem 0;" />
                        <div class="social-links">
                            <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" title="TikTok"><i class="fab fa-tiktok"></i></a>
                            <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="#" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 fade-up" style="transition-delay:.15s">
                    <div class="contact-card">
                        <form class="contact-form" onsubmit="submitForm(event)">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap *</label>
                                    <input type="text" placeholder="Nama Anda" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nomor WhatsApp *</label>
                                    <input type="tel" placeholder="+62 8xx-xxxx-xxxx" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" placeholder="email@anda.com" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Paket yang Diminati</label>
                                    <select>
                                        <option value="">-- Pilih Paket --</option>
                                        <option>Gili Islands Getaway</option>
                                        <option>Pendakian Rinjani</option>
                                        <option>Lombok Lengkap Tour</option>
                                        <option>Sumbawa Hidden Paradise</option>
                                        <option>Pulau Moyo Retreat</option>
                                        <option>Thailand Grand Tour</option>
                                        <option>Kustom / Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Rencana</label>
                                    <input type="date" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Peserta</label>
                                    <input type="number" placeholder="Contoh: 4 orang" min="1" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Pesan / Permintaan Khusus</label>
                                    <textarea placeholder="Ceritakan keinginan perjalanan Anda..."></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-submit"><i
                                            class="fas fa-paper-plane me-2"></i>Kirim Pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="map-wrap mt-5 fade-up">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31625.408!2d116.105!3d-8.583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdb5e1e0d5d44f%3A0x5b437e40f97e4321!2sMataram%2C+West+Nusa+Tenggara!5e0!3m2!1sen!2sid!4v1"
                    allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    // Package filter
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const f = btn.dataset.filter;
            document.querySelectorAll('.package-item').forEach(item => {
                item.style.display = (f === 'all' || item.dataset.cat === f) ? '' : 'none';
            });
        });
    });

    // Form submit
    function submitForm(e) {
        e.preventDefault();
        const btn = e.target.querySelector('.btn-submit');
        btn.innerHTML = '<i class="fas fa-check me-2"></i>Pesan Terkirim!';
        btn.style.background = '#1A7FD4';
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Kirim Pesan';
            btn.style.background = '';
            e.target.reset();
        }, 3000);
    }
</script>
@endpush
