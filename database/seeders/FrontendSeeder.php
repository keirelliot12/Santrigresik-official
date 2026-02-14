<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\Category;
use App\Models\Stat;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FrontendSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin SantriGresik',
            'email' => 'admin@santrigresik.id',
            'password' => Hash::make('password'),
        ]);

        // Categories (Optional if tables use string)
        // But let's create them for completeness
        $webCat = Category::create(['name' => 'Website', 'slug' => 'website']);
        $appCat = Category::create(['name' => 'Aplikasi', 'slug' => 'aplikasi']);
        $sysCat = Category::create(['name' => 'Sistem', 'slug' => 'sistem']);

        // Services
        Service::create([
            'name' => 'Pembuatan Website',
            'slug' => Str::slug('Pembuatan Website'),
            'icon' => 'globe',
            'description' => 'Website profesional, responsif, dan SEO-friendly untuk bisnis, toko online, company profile, dan landing page.',
            'features' => json_encode(['Desain Custom & Modern', 'SEO Optimized', 'Mobile Responsive']),
            'color' => '#10b981'
        ]);
        Service::create([
            'name' => 'Digitalisasi Pesantren',
            'slug' => Str::slug('Digitalisasi Pesantren'),
            'icon' => 'school',
            'description' => 'Sistem informasi akademik, manajemen santri, pembayaran SPP digital, absensi online, dan e-learning pesantren.',
            'features' => json_encode(['Manajemen Santri & Guru', 'Pembayaran Digital', 'Rapor & Absensi Online']),
            'color' => '#f59e0b',
            'is_featured' => true
        ]);
        Service::create([
            'name' => 'Automasi Sistem',
            'slug' => Str::slug('Automasi Sistem'),
            'icon' => 'bot',
            'description' => 'Otomasi workflow bisnis, chatbot WhatsApp, integrasi API, dan sistem notifikasi otomatis untuk efisiensi operasional.',
            'features' => json_encode(['WhatsApp Bot & CRM', 'Integrasi API', 'Workflow Automation']),
            'color' => '#8b5cf6'
        ]);
        Service::create([
            'name' => 'Digitalisasi Sistem',
            'slug' => Str::slug('Digitalisasi Sistem'),
            'icon' => 'database',
            'description' => 'Transformasi proses manual menjadi sistem digital terintegrasi — inventory, akuntansi, HRD, dan manajemen operasional.',
            'features' => json_encode(['ERP & Inventory', 'Akuntansi Digital', 'Dashboard Analitik']),
            'color' => '#06b6d4'
        ]);
        Service::create([
            'name' => 'Aplikasi Mobile',
            'slug' => Str::slug('Aplikasi Mobile'),
            'icon' => 'smartphone',
            'description' => 'Aplikasi Android & iOS native maupun cross-platform untuk kebutuhan bisnis, komunitas, dan e-commerce.',
            'features' => json_encode(['Android & iOS', 'Flutter / React Native', 'UI/UX Premium']),
            'color' => '#ec4899'
        ]);

        // Portfolio
        Portfolio::create([
            'title' => 'Company Profile - PT. Industri Gresik',
            'slug' => 'pt-industri-gresik',
            'description' => 'Website company profile modern dengan fitur multi-bahasa dan CMS.',
            'image' => 'portfolio/pt-industri-gresik.jpg',
            'category' => 'Website',
            'url' => '#',
            'color' => '#10b981'
        ]);
        Portfolio::create([
            'title' => 'SIAKAD Pesantren An-Nibros',
            'slug' => 'siakad-an-nibros',
            'description' => 'Sistem informasi akademik pesantren terintegrasi dengan pembayaran digital.',
            'image' => 'portfolio/siakad.jpg',
            'category' => 'Sistem',
            'url' => '#',
            'color' => '#f59e0b'
        ]);
        Portfolio::create([
            'title' => 'Aplikasi Majmu\'ah Islamiyah',
            'slug' => 'majmuah-islamiyah',
            'description' => 'Aplikasi mobile kumpulan doa, dzikir, dan materi keislaman.',
            'image' => 'portfolio/majmuah.jpg',
            'category' => 'Aplikasi',
            'url' => '#',
            'color' => '#8b5cf6'
        ]);
        Portfolio::create([
            'title' => 'E-Commerce UMKM Gresik',
            'slug' => 'ecommerce-umkm',
            'description' => 'Platform toko online untuk produk UMKM khas Gresik.',
            'image' => 'portfolio/ecommerce.jpg',
            'category' => 'Website',
            'url' => '#',
            'color' => '#ec4899'
        ]);
        Portfolio::create([
            'title' => 'Dashboard Donasi Online',
            'slug' => 'dashboard-donasi',
            'description' => 'Sistem donasi terintegrasi payment gateway dengan dashboard real-time.',
            'image' => 'portfolio/donasi.jpg',
            'category' => 'Sistem',
            'url' => '#',
            'color' => '#06b6d4'
        ]);
        Portfolio::create([
            'title' => 'WeddingPress — Undangan Digital',
            'slug' => 'wedding-press',
            'description' => 'Platform undangan pernikahan digital interaktif dengan RSVP online.',
            'image' => 'portfolio/wedding.jpg',
            'category' => 'Aplikasi',
            'url' => '#',
            'color' => '#f43f5e'
        ]);

        // Products
        Product::create([
            'name' => 'Mebel Custom',
            'slug' => 'mebel-custom',
            'description' => 'Furniture kayu jati berkualitas — meja, kursi, lemari, set ruang tamu, dan mebel custom sesuai keinginan.',
            'price' => '2500000',
            'category' => 'Mebel',
            'image' => 'products/mebel.jpg',
            'badge' => 'Custom Order',
            'color' => '#92400e',
            'whatsapp_message' => 'Halo, saya tertarik dengan produk Mebel Custom'
        ]);
        Product::create([
            'name' => 'Gazebo Kayu',
            'slug' => 'gazebo-kayu',
            'description' => 'Gazebo kayu jati & glugu premium untuk taman, villa, resort, dan area outdoor dengan desain elegan.',
            'price' => '8000000',
            'category' => 'Gazebo',
            'image' => 'products/gazebo.jpg',
            'badge' => 'Best Seller',
            'color' => '#065f46',
            'whatsapp_message' => 'Halo, saya tertarik dengan produk Gazebo Kayu'
        ]);
        Product::create([
            'name' => 'Mimbar Masjid',
            'slug' => 'mimbar-masjid',
            'description' => 'Mimbar masjid ukiran kayu jati premium dengan motif kaligrafi dan ornamen islami yang indah.',
            'price' => '5000000',
            'category' => 'Mimbar',
            'image' => 'products/mimbar.jpg',
            'badge' => 'Handmade',
            'color' => '#7c2d12',
            'whatsapp_message' => 'Halo, saya tertarik dengan produk Mimbar Masjid'
        ]);
        Product::create([
            'name' => 'Jasa CNC & Ukiran',
            'slug' => 'jasa-cnc',
            'description' => 'Layanan CNC cutting & engraving untuk kaligrafi, ornamen, partisi, panel dinding, dan dekorasi custom.',
            'price' => '500000',
            'category' => 'Jasa',
            'image' => 'products/cnc.jpg',
            'badge' => 'Presisi Tinggi',
            'color' => '#4338ca',
            'whatsapp_message' => 'Halo, saya tertarik dengan Jasa CNC'
        ]);
        Product::create([
            'name' => 'Kavlingan Tanah',
            'slug' => 'kavlingan-tanah',
            'description' => 'Kavlingan tanah strategis di kawasan Gresik dan sekitarnya — cocok untuk hunian, investasi, dan usaha.',
            'price' => '0', // Hubungi Kami
            'category' => 'Properti',
            'image' => 'products/kavling.jpg',
            'badge' => 'Investasi',
            'color' => '#166534',
            'whatsapp_message' => 'Halo, saya tertarik dengan Kavlingan Tanah'
        ]);

        // Stats
        Stat::create(['label' => 'Proyek Selesai', 'value' => '50+', 'icon' => 'trophy']);
        Stat::create(['label' => 'Klien Puas', 'value' => '30+', 'icon' => 'users']);
        Stat::create(['label' => 'Tahun Pengalaman', 'value' => '5+', 'icon' => 'clock']);
    }
}
