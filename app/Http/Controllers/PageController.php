<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function portfolioDetail($slug)
    {
        // Mock data - nanti ambil dari database
        $portfolios = [
            'anti-diet-club' => [
                'title' => 'Anti Diet Club',
                'category' => 'Website',
                'description' => 'Landing page modern untuk toko cookies dengan fitur cart system dan WhatsApp integration. Dibangun dengan Laravel 12 + FilamentPHP untuk admin panel yang mudah digunakan.',
                'image' => '🍪',
                'technologies' => ['Laravel 12', 'FilamentPHP 3', 'Tailwind CSS', 'SQLite'],
                'url' => 'https://santrigresik.me/antidietclub',
                'client' => 'Anti Diet Club',
                'year' => '2026'
            ],
            'santrigresik-me' => [
                'title' => 'SantriGresik.me',
                'category' => 'Website',
                'description' => 'Website portfolio untuk SantriGresik Official dengan desain dark theme modern. Dilengkapi animasi scroll, filter portfolio, dan CTA WhatsApp.',
                'image' => '🚀',
                'technologies' => ['Laravel 12', 'Tailwind CSS', 'Vanilla JS', 'Lucide Icons'],
                'url' => 'https://santrigresik.me',
                'client' => 'SantriGresik Official',
                'year' => '2026'
            ],
            'pt-industri-gresik' => [
                'title' => 'Company Profile - PT. Industri Gresik',
                'category' => 'Website',
                'description' => 'Website company profile modern dengan fitur multi-bahasa dan CMS untuk kemudahan update konten.',
                'image' => '🏢',
                'technologies' => ['Laravel 11', 'FilamentPHP', 'Tailwind CSS', 'MySQL'],
                'url' => '#',
                'client' => 'PT. Industri Gresik',
                'year' => '2025'
            ],
            'siakad-an-nibros' => [
                'title' => 'SIAKAD Pesantren An-Nibros',
                'category' => 'Sistem',
                'description' => 'Sistem informasi akademik pesantren terintegrasi dengan pembayaran digital, absensi, dan nilai siswa.',
                'image' => '🏫',
                'technologies' => ['Laravel 11', 'FilamentPHP', 'MySQL', 'Midtrans API'],
                'url' => '#',
                'client' => 'Pesantren An-Nibros',
                'year' => '2025'
            ],
            'majmuah-islamiyah' => [
                'title' => 'Aplikasi Majmu\'ah Islamiyah',
                'category' => 'Aplikasi',
                'description' => 'Aplikasi mobile untuk kumpulan doa, wirid, dan ratib harian dengan fitur reminder dan offline mode.',
                'image' => '📱',
                'technologies' => ['Flutter', 'Dart', 'Firebase', 'SQLite'],
                'url' => '#',
                'client' => 'Majmu\'ah Islamiyah',
                'year' => '2025'
            ],
            'ecommerce-umkm' => [
                'title' => 'E-Commerce UMKM Gresik',
                'category' => 'Website',
                'description' => 'Platform e-commerce untuk UMKM dengan fitur keranjang, checkout, dan integrasi payment gateway.',
                'image' => '🛒',
                'technologies' => ['Laravel 11', 'Livewire', 'Alpine.js', 'Midtrans'],
                'url' => '#',
                'client' => 'UMKM Gresik',
                'year' => '2025'
            ],
            'dashboard-donasi' => [
                'title' => 'Dashboard Donasi Online',
                'category' => 'Sistem',
                'description' => 'Dashboard real-time untuk monitoring donasi dengan fitur export laporan dan integrasi payment gateway.',
                'image' => '💰',
                'technologies' => ['Laravel 11', 'FilamentPHP', 'MySQL', 'Chart.js'],
                'url' => '#',
                'client' => 'Yayasan Amal',
                'year' => '2025'
            ],
            'wedding-press' => [
                'title' => 'WeddingPress — Undangan Digital',
                'category' => 'Aplikasi',
                'description' => 'Platform undangan digital dengan fitur RSVP, galeri foto, dan custom theme untuk pernikahan.',
                'image' => '💒',
                'technologies' => ['Laravel 11', 'Vue.js', 'Firebase', 'Cloudinary'],
                'url' => '#',
                'client' => 'WeddingPress',
                'year' => '2025'
            ]
        ];

        $portfolio = (object)($portfolios[$slug] ?? $portfolios['anti-diet-club']);

        return view('portfolio-detail', compact('portfolio'));
    }

    public function productDetail($slug)
    {
        // Mock data - nanti ambil dari database
        $products = [
            'mebel-custom' => [
                'name' => 'Mebel Custom',
                'category' => 'Produk Fisik',
                'price' => 'Mulai Rp 2.5 Juta',
                'description' => 'Furniture kayu jati berkualitas — meja, kursi, lemari, set ruang tamu, dan mebel custom sesuai keinginan. Dikerjakan oleh pengrajin berpengalaman dengan material premium.',
                'features' => [
                    'Kayu Jati / Glugu Premium',
                    'Desain Custom Sesuai Permintaan',
                    'Finishing Halus & Tahan Lama',
                    'Gratis Pengiriman Area Gresik',
                    'Garansi 1 Tahun',
                    'Tersedia Berbagai Ukuran'
                ],
                'image' => '🪑'
            ],
            'gazebo-kayu' => [
                'name' => 'Gazebo Kayu',
                'category' => 'Produk Fisik',
                'price' => 'Mulai Rp 8 Juta',
                'description' => 'Gazebo kayu jati & glugu premium untuk taman, villa, resort, dan area outdoor dengan desain elegan. Cocok untuk bersantai dan menikmati suasana alam.',
                'features' => [
                    'Kayu Jati / Glugu Pilihan',
                    'Tahan Cuaca & Anti Rayap',
                    'Desain Modern & Elegan',
                    'Tersedia Berbagai Ukuran',
                    'Gratis Pemasangan Area Gresik',
                    'Garansi 2 Tahun'
                ],
                'image' => '🏠'
            ],
            'mimbar-masjid' => [
                'name' => 'Mimbar Masjid',
                'category' => 'Produk Fisik',
                'price' => 'Mulai Rp 5 Juta',
                'description' => 'Mimbar masjid dengan ukiran kaligrafi yang indah dan kokoh. Dibuat dengan penuh ketelitian untuk kenyamanan khatib.',
                'features' => [
                    'Kayu Jati TPK',
                    'Ukiran Kaligrafi Halus',
                    'Cat Pilihan (Melamine/Natural)',
                    'Tinggi Sesuai Standar',
                    'Gratis Pengiriman Area Gresik',
                    'Garansi 1 Tahun'
                ],
                'image' => '🕌'
            ],
            'jasa-cnc' => [
                'name' => 'Jasa CNC',
                'category' => 'Jasa',
                'price' => 'Mulai Rp 50.000/cm',
                'description' => 'Jasa pemotongan CNC presisi untuk berbagai kebutuhan: aksesoris, hiasan dinding, ornamen, dan custom design sesuai keinginan.',
                'features' => [
                    'Mesin CNC Presisi Tinggi',
                    'Bahan: Kayu, Akrilik, MDF',
                    'Custom Design Sesuai Permintaan',
                    'Pengerjaan Cepat',
                    'Hasil Rapi & Detail',
                    'Mendukung File: DXF, AI, CDR'
                ],
                'image' => '⚙️'
            ],
            'kavlingan-tanah' => [
                'name' => 'Kavlingan Tanah',
                'category' => 'Properti',
                'price' => 'Mulai Rp 500 Juta',
                'description' => 'Tanah kavling siap bangun di lokasi strategis. Cocok untuk hunian, ruko, atau investasi jangka panjang.',
                'features' => [
                    'Lokasi Strategis',
                    'Surat Lengkap (SHM)',
                    'Bebas Banjir',
                    'Akses Jalan Lebar',
                    'Dekat Fasilitas Umum',
                    'Potensi Kenaikan Harga Tinggi'
                ],
                'image' => '🏘️'
            ]
        ];

        $product = (object)($products[$slug] ?? $products['mebel-custom']);

        return view('product-detail', compact('product'));
    }
}
