<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="SantriGresik.id — Agency digital terpercaya untuk pembuatan web, digitalisasi pesantren, automasi sistem, aplikasi mobile, dan produk mebel premium."
    />
    <meta
      name="keywords"
      content="agency digital, pembuatan web, digitalisasi pesantren, automasi, aplikasi mobile, mebel, gazebo, mimbar, CNC, kavlingan, Gresik"
    />
    <meta name="author" content="SantriGresik.id" />
    <title>SantriGresik.id — Digital Agency & Premium Products</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap"
      rel="stylesheet"
    />

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  </head>
  <body>
    <!-- ===== NAVBAR ===== -->
    <nav id="navbar" class="navbar">
      <div class="container navbar-inner">
        <a href="#" class="logo">
          <span class="logo-icon">☪</span>
          <span class="logo-text"
            >Santri<span class="logo-highlight">Gresik</span>.id</span
          >
        </a>
        <ul class="nav-links" id="navLinks">
          <li><a href="#home" class="nav-link active">Beranda</a></li>
          <li><a href="#services" class="nav-link">Layanan</a></li>
          <li><a href="#portfolio" class="nav-link">Portfolio</a></li>
          <li><a href="#shop" class="nav-link">Produk Fisik</a></li>
          <li><a href="#about" class="nav-link">Tentang</a></li>
          <li><a href="#contact" class="nav-link cta-btn">Hubungi Kami</a></li>
        </ul>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
          <span></span><span></span><span></span>
        </button>
      </div>
    </nav>

    <!-- ===== HERO ===== -->
    <section id="home" class="hero">
      <div class="hero-bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="hero-grid-overlay"></div>
      </div>
      <div class="container hero-content">
        <div class="hero-badge" data-animate="fade-up">
          <span class="badge-dot"></span>
          Agency Digital Terpercaya di Gresik
        </div>
        <h1 data-animate="fade-up" data-delay="100">
          Wujudkan <span class="gradient-text">Transformasi Digital</span> untuk
          Bisnis & Pesantren Anda
        </h1>
        <p class="hero-subtitle" data-animate="fade-up" data-delay="200">
          Kami membantu UMKM, pesantren, dan lembaga pendidikan untuk go digital
          — dari website profesional, aplikasi mobile, hingga automasi sistem
          yang efisien.
        </p>
        <div class="hero-actions" data-animate="fade-up" data-delay="300">
          <a href="#services" class="btn btn-primary">
            <span>Lihat Layanan</span>
            <i data-lucide="arrow-right"></i>
          </a>
          <a href="#portfolio" class="btn btn-outline">
            <i data-lucide="play-circle"></i>
            <span>Portfolio Kami</span>
          </a>
        </div>
        <div class="hero-stats" data-animate="fade-up" data-delay="400">
          @foreach($stats as $stat)
          <div class="stat">
            <span class="stat-number" data-count="{{ (int)$stat->value }}">{{ $stat->value }}</span>
            <span class="stat-label">{{ $stat->label }}</span>
          </div>
          @if(!$loop->last) <div class="stat-divider"></div> @endif
          @endforeach
        </div>
      </div>
      <div class="hero-scroll-indicator">
        <div class="scroll-line"></div>
        <span>Scroll</span>
      </div>
    </section>

    <!-- ===== SERVICES ===== -->
    <section id="services" class="section services">
      <div class="container">
        <div class="section-header" data-animate="fade-up">
          <span class="section-tag">Layanan Kami</span>
          <h2>Solusi Digital <span class="gradient-text">Lengkap</span></h2>
          <p class="section-desc">
            Dari ide hingga implementasi, kami menyediakan layanan digital
            end-to-end untuk membantu bisnis Anda tumbuh.
          </p>
        </div>
        <div class="services-grid">
          @foreach($services as $index => $service)
          <div class="service-card {{ $service->is_featured ? 'featured' : '' }}" data-animate="fade-up" data-delay="{{ $index * 100 }}">
            @if($service->is_featured)
            <div class="featured-badge">Unggulan</div>
            @endif
            <div class="service-icon" style="--accent: {{ $service->color }}">
              <i data-lucide="{{ $service->icon }}"></i>
            </div>
            <h3>{{ $service->name }}</h3>
            <p>{{ $service->description }}</p>
            <ul class="service-features">
              @if($service->features)
                @foreach(json_decode($service->features) as $feature)
                <li><i data-lucide="check"></i> {{ $feature }}</li>
                @endforeach
              @endif
            </ul>
            <a href="#contact" class="service-link">
              <span>Konsultasi Gratis</span>
              <i data-lucide="arrow-right"></i>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- ===== PORTFOLIO ===== -->
    <section id="portfolio" class="section portfolio">
      <div class="container">
        <div class="section-header" data-animate="fade-up">
          <span class="section-tag">Portfolio</span>
          <h2>Karya <span class="gradient-text">Terbaik</span> Kami</h2>
          <p class="section-desc">
            Beberapa proyek yang telah kami kerjakan dengan penuh dedikasi dan
            profesionalisme.
          </p>
        </div>
        <div class="portfolio-filter" data-animate="fade-up" data-delay="100">
          <button class="filter-btn active" data-filter="all">Semua</button>
          <button class="filter-btn" data-filter="web">Website</button>
          <button class="filter-btn" data-filter="app">Aplikasi</button>
          <button class="filter-btn" data-filter="system">Sistem</button>
        </div>
        <div class="portfolio-grid">
          @foreach($portfolios as $index => $portfolio)
          <div
            class="portfolio-card"
            data-category="{{ Str::lower($portfolio->category) == 'website' ? 'web' : (Str::lower($portfolio->category) == 'aplikasi' ? 'app' : 'system') }}"
            data-animate="fade-up"
            data-delay="{{ $index * 100 }}"
          >
            <div class="portfolio-thumb" style="--card-accent: {{ $portfolio->color }}">
              <div class="portfolio-thumb-icon">
                <i data-lucide="{{ $portfolio->category == 'Website' ? 'globe' : ($portfolio->category == 'Aplikasi' ? 'smartphone' : 'database') }}"></i>
              </div>
              <div class="portfolio-overlay">
                <a href="{{ route('portfolio.detail', $portfolio->slug) }}" class="portfolio-view"
                  ><i data-lucide="external-link"></i
                ></a>
              </div>
            </div>
            <div class="portfolio-info">
              <span class="portfolio-tag">{{ $portfolio->category }}</span>
              <h4>{{ $portfolio->title }}</h4>
              <p>{{ $portfolio->description }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- ===== SHOP (Physical Products) ===== -->
    <section id="shop" class="section shop">
      <div class="container">
        <div class="section-header" data-animate="fade-up">
          <span class="section-tag">Produk Fisik</span>
          <h2>
            Kerajinan & Properti <span class="gradient-text">Premium</span>
          </h2>
          <p class="section-desc">
            Produk berkualitas tinggi dari mitra terpercaya kami — mebel custom,
            gazebo, mimbar masjid, ukiran CNC, dan kavlingan strategis.
          </p>
        </div>
        <div class="shop-grid">
          @foreach($products as $index => $product)
          <div class="product-card" data-animate="fade-up" data-delay="{{ $index * 100 }}">
            <div class="product-image" style="--product-accent: {{ $product->color }}">
              <div class="product-icon-wrap">
                <!-- Fallback icon based on category/name if no SVG -->
                @if(Str::contains(Str::lower($product->name), 'mebel'))
                  <i data-lucide="armchair" style="width:60px;height:60px;opacity:0.8"></i>
                @elseif(Str::contains(Str::lower($product->name), 'gazebo'))
                  <i data-lucide="home" style="width:60px;height:60px;opacity:0.8"></i>
                @elseif(Str::contains(Str::lower($product->name), 'mimbar'))
                  <i data-lucide="mic-2" style="width:60px;height:60px;opacity:0.8"></i>
                @elseif(Str::contains(Str::lower($product->name), 'cnc'))
                  <i data-lucide="scissors" style="width:60px;height:60px;opacity:0.8"></i>
                @elseif(Str::contains(Str::lower($product->name), 'kavling'))
                  <i data-lucide="map" style="width:60px;height:60px;opacity:0.8"></i>
                @else
                  <i data-lucide="package" style="width:60px;height:60px;opacity:0.8"></i>
                @endif
              </div>
              @if($product->badge)
              <div class="product-badge">{{ $product->badge }}</div>
              @endif
            </div>
            <div class="product-info">
              <h4>{{ $product->name }}</h4>
              <p>{{ $product->description }}</p>
              <div class="product-meta">
                <span class="product-price">{{ $product->price > 0 ? 'Mulai Rp ' . number_format($product->price, 0, ',', '.') : 'Hubungi Kami' }}</span>
              </div>
              <a
                href="https://wa.me/6281234567890?text={{ rawurlencode($product->whatsapp_message) }}"
                target="_blank"
                class="btn btn-product"
              >
                <i data-lucide="message-circle"></i>
                <span>Pesan via WhatsApp</span>
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- ===== ABOUT ===== -->
    <section id="about" class="section about">
      <div class="container">
        <div class="about-grid">
          <div class="about-visual" data-animate="fade-right">
            <div class="about-visual-card">
              <div class="about-pattern"></div>
              @foreach($stats as $index => $stat)
                @if($index < 2)
                <div class="about-stat-card about-stat-{{ $index + 1 }}">
                  <i data-lucide="{{ $stat->icon }}"></i>
                  <div>
                    <strong>{{ $stat->value }}</strong>
                    <span>{{ $stat->label }}</span>
                  </div>
                </div>
                @endif
              @endforeach
              <div class="about-main-icon">
                <i data-lucide="building-2"></i>
              </div>
            </div>
          </div>
          <div class="about-content" data-animate="fade-left">
            <span class="section-tag">Tentang Kami</span>
            <h2>
              Mengapa Memilih
              <span class="gradient-text">SantriGresik.id</span>?
            </h2>
            <p>
              Kami adalah agency digital yang berbasis di Gresik, Jawa Timur.
              Didirikan oleh para santri yang memiliki passion di bidang
              teknologi, kami menggabungkan nilai-nilai kepesantrenan dengan
              keahlian teknologi modern.
            </p>
            <div class="about-features">
              <div class="about-feature">
                <div class="about-feature-icon">
                  <i data-lucide="shield-check"></i>
                </div>
                <div>
                  <h4>Terpercaya & Amanah</h4>
                  <p>
                    Memegang teguh nilai kejujuran dan profesionalisme dalam
                    setiap proyek.
                  </p>
                </div>
              </div>
              <div class="about-feature">
                <div class="about-feature-icon"><i data-lucide="zap"></i></div>
                <div>
                  <h4>Cepat & Responsif</h4>
                  <p>
                    Pengerjaan tepat waktu dengan support responsif setelah
                    proyek selesai.
                  </p>
                </div>
              </div>
              <div class="about-feature">
                <div class="about-feature-icon">
                  <i data-lucide="heart-handshake"></i>
                </div>
                <div>
                  <h4>Harga Bersahabat</h4>
                  <p>
                    Harga terjangkau tanpa mengorbankan kualitas — khusus untuk
                    pesantren & UMKM.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== CTA ===== -->
    <section class="cta-section">
      <div class="container">
        <div class="cta-card" data-animate="fade-up">
          <div class="cta-bg-pattern"></div>
          <h2>Siap Memulai Proyek Anda?</h2>
          <p>
            Konsultasikan kebutuhan digital Anda secara gratis. Kami siap
            membantu mewujudkan visi Anda.
          </p>
          <div class="cta-actions">
            <a
              href="https://wa.me/6281234567890?text=Halo%20SantriGresik.id,%20saya%20ingin%20konsultasi"
              target="_blank"
              class="btn btn-primary btn-lg"
            >
              <i data-lucide="message-circle"></i>
              <span>Chat WhatsApp</span>
            </a>
            <a href="#contact" class="btn btn-outline-white btn-lg">
              <i data-lucide="mail"></i>
              <span>Kirim Email</span>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== CONTACT ===== -->
    <section id="contact" class="section contact">
      <div class="container">
        <div class="section-header" data-animate="fade-up">
          <span class="section-tag">Kontak</span>
          <h2>Hubungi <span class="gradient-text">Kami</span></h2>
          <p class="section-desc">
            Punya pertanyaan atau ingin memulai proyek? Jangan ragu untuk
            menghubungi kami.
          </p>
        </div>
        <div class="contact-grid">
          <div class="contact-info-col" data-animate="fade-right">
            <div class="contact-info-card">
              <div class="contact-item">
                <div class="contact-item-icon">
                  <i data-lucide="map-pin"></i>
                </div>
                <div>
                  <h4>Alamat</h4>
                  <p>Gresik, Jawa Timur, Indonesia</p>
                </div>
              </div>
              <div class="contact-item">
                <div class="contact-item-icon"><i data-lucide="phone"></i></div>
                <div>
                  <h4>Telepon</h4>
                  <p>+62 812-3456-7890</p>
                </div>
              </div>
              <div class="contact-item">
                <div class="contact-item-icon"><i data-lucide="mail"></i></div>
                <div>
                  <h4>Email</h4>
                  <p>hello@santrigresik.id</p>
                </div>
              </div>
              <div class="contact-item">
                <div class="contact-item-icon"><i data-lucide="clock"></i></div>
                <div>
                  <h4>Jam Operasional</h4>
                  <p>Senin - Sabtu, 08:00 - 17:00 WIB</p>
                </div>
              </div>
            </div>
            <div class="contact-socials">
              <a href="#" class="social-link" aria-label="Instagram"
                ><i data-lucide="instagram"></i
              ></a>
              <a href="#" class="social-link" aria-label="Facebook"
                ><i data-lucide="facebook"></i
              ></a>
              <a href="#" class="social-link" aria-label="Youtube"
                ><i data-lucide="youtube"></i
              ></a>
              <a href="#" class="social-link" aria-label="Github"
                ><i data-lucide="github"></i
              ></a>
            </div>
          </div>
          <div class="contact-form-col" data-animate="fade-left">
            <form class="contact-form" id="contactForm">
              <div class="form-row">
                <div class="form-group">
                  <label for="name">Nama Lengkap</label>
                  <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Masukkan nama Anda"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="email@contoh.com"
                    required
                  />
                </div>
              </div>
              <div class="form-group">
                <label for="subject">Subjek</label>
                <select id="subject" name="subject" required>
                  <option value="">Pilih layanan yang diinginkan</option>
                  <option value="website">Pembuatan Website</option>
                  <option value="pesantren">Digitalisasi Pesantren</option>
                  <option value="automasi">Automasi Sistem</option>
                  <option value="digitalisasi">Digitalisasi Sistem</option>
                  <option value="mobile">Aplikasi Mobile</option>
                  <option value="produk">
                    Produk Fisik (Mebel/Gazebo/dll)
                  </option>
                  <option value="lainnya">Lainnya</option>
                </select>
              </div>
              <div class="form-group">
                <label for="message">Pesan</label>
                <textarea
                  id="message"
                  name="message"
                  rows="5"
                  placeholder="Ceritakan kebutuhan proyek Anda..."
                  required
                ></textarea>
              </div>
              <button
                type="submit"
                class="btn btn-primary btn-lg btn-block"
                id="submitBtn"
              >
                <i data-lucide="send"></i>
                <span>Kirim Pesan</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
      <div class="container">
        <div class="footer-grid">
          <div class="footer-brand">
            <a href="#" class="logo">
              <span class="logo-icon">☪</span>
              <span class="logo-text"
                >Santri<span class="logo-highlight">Gresik</span>.id</span
              >
            </a>
            <p>
              Agency digital terpercaya di Gresik — membantu bisnis & pesantren
              untuk go digital.
            </p>
            <div class="footer-socials">
              <a href="#" aria-label="Instagram"
                ><i data-lucide="instagram"></i
              ></a>
              <a href="#" aria-label="Facebook"
                ><i data-lucide="facebook"></i
              ></a>
              <a href="#" aria-label="Youtube"><i data-lucide="youtube"></i></a>
            </div>
          </div>
          <div class="footer-links-group">
            <h4>Layanan</h4>
            <ul>
              <li><a href="#services">Pembuatan Website</a></li>
              <li><a href="#services">Digitalisasi Pesantren</a></li>
              <li><a href="#services">Automasi Sistem</a></li>
              <li><a href="#services">Aplikasi Mobile</a></li>
            </ul>
          </div>
          <div class="footer-links-group">
            <h4>Produk Fisik</h4>
            <ul>
              <li><a href="#shop">Mebel Custom</a></li>
              <li><a href="#shop">Gazebo Kayu</a></li>
              <li><a href="#shop">Mimbar Masjid</a></li>
              <li><a href="#shop">Jasa CNC</a></li>
              <li><a href="#shop">Kavlingan Tanah</a></li>
            </ul>
          </div>
          <div class="footer-links-group">
            <h4>Tautan</h4>
            <ul>
              <li><a href="#home">Beranda</a></li>
              <li><a href="#portfolio">Portfolio</a></li>
              <li><a href="#about">Tentang Kami</a></li>
              <li><a href="#contact">Kontak</a></li>
            </ul>
          </div>
        </div>
        <div class="footer-bottom">
          <p>&copy; 2026 SantriGresik.id — All rights reserved.</p>
          <p>
            Dibuat dengan <span style="color: #ef4444">❤</span> di Gresik, Jawa
            Timur
          </p>
        </div>
      </div>
    </footer>

    <!-- Back to top -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
      <i data-lucide="chevron-up"></i>
    </button>

    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>
