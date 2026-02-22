<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\Category;
use App\Models\ServiceCategory;
use App\Models\PortfolioCategory;
use App\Models\ProductCategory;
use App\Models\Stat;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FrontendSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User (match new schema: bigint unsigned id, name, email)
        if (!User::where('email', 'admin@santrigresik.id')->exists()) {
            User::create([
                'name' => 'Admin SantriGresik',
                'email' => 'admin@santrigresik.id',
                'password' => Hash::make('password'),
                'login_method' => 'password',
            ]);
        }

        // Categories (using specific category models) - skip if exists
        $webCat = Category::firstOrCreate(['slug' => 'website'], ['name' => 'Website']);
        $appCat = Category::firstOrCreate(['slug' => 'aplikasi'], ['name' => 'Aplikasi']);
        $sysCat = Category::firstOrCreate(['slug' => 'sistem'], ['name' => 'Sistem']);

        $serviceWebCat = ServiceCategory::firstOrCreate(['slug' => 'website'], ['name' => 'Website', 'sort_order' => 1]);
        $serviceSysCat = ServiceCategory::firstOrCreate(['slug' => 'sistem'], ['name' => 'Sistem', 'sort_order' => 2]);
        $serviceAppCat = ServiceCategory::firstOrCreate(['slug' => 'aplikasi'], ['name' => 'Aplikasi', 'sort_order' => 3]);

        $portfolioWebCat = PortfolioCategory::firstOrCreate(['slug' => 'website'], ['name' => 'Website']);
        $portfolioAppCat = PortfolioCategory::firstOrCreate(['slug' => 'aplikasi'], ['name' => 'Aplikasi']);
        $portfolioSysCat = PortfolioCategory::firstOrCreate(['slug' => 'sistem'], ['name' => 'Sistem']);

        // Services (match schema: name, NOT title)
        Service::firstOrCreate(['slug' => Str::slug($data['name'])], $([
            'name' => 'Pembuatan Website',
            'slug' => Str::slug('Pembuatan Website'),
            'icon' => 'globe',
            'description' => 'Website profesional, responsif, dan SEO-friendly untuk bisnis, toko online, company profile, dan landing page.',
            'features' => json_encode(['Desain Custom & Modern', 'SEO Optimized', 'Mobile Responsive']),
            'color' => '#10b981',
            'category_id' => $serviceWebCat->id,
        ]);
        Service::firstOrCreate(['slug' => Str::slug($data['name'])], $([
            'name' => 'Digitalisasi Pesantren',
            'slug' => Str::slug('Digitalisasi Pesantren'),
            'icon' => 'school',
            'description' => 'Sistem informasi akademik, manajemen santri, pembayaran SPP digital, absensi online, dan e-learning pesantren.',
            'features' => json_encode(['Manajemen Santri & Guru', 'Pembayaran Digital', 'Rapor & Absensi Online']),
            'color' => '#f59e0b',
            'is_featured' => true,
            'category_id' => $serviceSysCat->id,
        ]);
        Service::firstOrCreate(['slug' => Str::slug($data['name'])], $([
            'name' => 'Aplikasi Mobile',
            'slug' => Str::slug('Aplikasi Mobile'),
            'icon' => 'smartphone',
            'description' => 'Pengembangan aplikasi mobile Android & iOS dengan Flutter, React Native, atau Native untuk bisnis dan startup.',
            'features' => json_encode(['Cross-Platform', 'Modern UI/UX', 'Performance Optimized']),
            'color' => '#3b82f6',
            'category_id' => $serviceAppCat->id,
        ]);
        Service::firstOrCreate(['slug' => Str::slug($data['name'])], $([
            'name' => 'Automasi Sistem',
            'slug' => Str::slug('Automasi Sistem'),
            'icon' => 'cog',
            'description' => 'Otomasi proses bisnis dengan integrasi API, workflow automation, dan custom software untuk efisiensi operasional.',
            'features' => json_encode(['Workflow Automation', 'API Integration', 'Time Saving']),
            'color' => '#8b5cf6',
            'category_id' => $serviceSysCat->id,
        ]);
        Service::firstOrCreate(['slug' => Str::slug($data['name'])], $([
            'name' => 'Sistem Informasi',
            'slug' => Str::slug('Sistem Informasi'),
            'icon' => 'database',
            'description' => 'Sistem informasi custom untuk manajemen inventory, HR, keuangan, dan kebutuhan bisnis lainnya.',
            'features' => json_encode(['Custom Development', 'Data Management', 'Real-time Reporting']),
            'color' => '#ef4444',
            'category_id' => $serviceSysCat->id,
        ]);

        // Portfolios (match schema: title, category enum)
        Portfolio::firstOrCreate(['slug' => Str::slug($data['title'])], $([
            'title' => 'SantriGresik.me',
            'slug' => 'santrigresik-me',
            'category' => 'web',
            'description' => 'Website portfolio agency digital SantriGresik dengan desain modern dan animasi interaktif.',
            'image' => 'images/portfolio/santrigresik.jpg',
            'url' => 'https://santrigresik.me',
            'client_name' => 'SantriGresik',
            'year' => 2024,
            'technologies' => json_encode(['Laravel', 'Tailwind CSS', 'JavaScript']),
            'color' => '#10b981',
            'is_featured' => true,
            'category_id' => $portfolioWebCat->id,
        ]);
        Portfolio::firstOrCreate(['slug' => Str::slug($data['title'])], $([
            'title' => 'Anti Diet Club',
            'slug' => 'anti-diet-club',
            'category' => 'web',
            'description' => 'Website toko online cookies dengan sistem cart dan integrasi WhatsApp.',
            'image' => 'images/portfolio/antidietclub.jpg',
            'url' => 'https://santrigresik.me/antidietclub',
            'client_name' => 'Anti Diet Club',
            'year' => 2024,
            'technologies' => json_encode(['Laravel', 'Filament', 'Tailwind CSS']),
            'color' => '#f59e0b',
            'is_featured' => true,
            'category_id' => $portfolioWebCat->id,
        ]);
        Portfolio::firstOrCreate(['slug' => Str::slug($data['title'])], $([
            'title' => 'An-Nibros',
            'slug' => 'an-nibros',
            'category' => 'app',
            'description' => 'Aplikasi digital ibadah dengan fitur al-Quran, wirid, ratib, dan doa pilihan.',
            'image' => 'images/portfolio/annibros.jpg',
            'url' => '#',
            'client_name' => 'PP Nurul Huda',
            'year' => 2024,
            'technologies' => json_encode(['Flutter', 'Laravel', 'Firebase']),
            'color' => '#3b82f6',
            'is_featured' => true,
            'category_id' => $portfolioAppCat->id,
        ]);
        Portfolio::firstOrCreate(['slug' => Str::slug($data['title'])], $([
            'title' => 'Sistem Absensi PP Al Ibrohimi',
            'slug' => 'sistem-absensi-al-ibrohimi',
            'category' => 'system',
            'description' => 'Sistem absensi guru dengan GPS tracking dan verifikasi wajah.',
            'image' => 'images/portfolio/absensi.jpg',
            'url' => 'https://presensi.alibrohimi.my.id',
            'client_name' => 'PP Al Ibrohimi',
            'year' => 2023,
            'technologies' => json_encode(['Laravel', 'Filament', 'GPS API']),
            'color' => '#8b5cf6',
            'category_id' => $portfolioSysCat->id,
        ]);
        Portfolio::firstOrCreate(['slug' => Str::slug($data['title'])], $([
            'title' => 'Sidogiri Penerbit',
            'slug' => 'sidogiri-penerbit',
            'category' => 'web',
            'description' => 'Website penerbit buku dengan sistem katalog dan toko online.',
            'image' => 'images/portfolio/sidogiri-penerbit.jpg',
            'url' => 'https://sidogiripenerbit.com',
            'client_name' => 'Sidogiri Penerbit',
            'year' => 2023,
            'technologies' => json_encode(['Laravel', 'WooCommerce', 'WordPress']),
            'color' => '#ef4444',
            'category_id' => $portfolioWebCat->id,
        ]);
        Portfolio::firstOrCreate(['slug' => Str::slug($data['title'])], $([
            'title' => 'Dialog Masa',
            'slug' => 'dialog-masa',
            'category' => 'web',
            'description' => 'Redesign website dengan modern UI dan improved UX.',
            'image' => 'images/portfolio/dialogmasa.jpg',
            'url' => 'https://dialogmasa.com',
            'client_name' => 'Dialog Masa',
            'year' => 2023,
            'technologies' => json_encode(['Laravel', 'Tailwind CSS']),
            'color' => '#06b6d4',
            'category_id' => $portfolioWebCat->id,
        ]);

        // Products (match schema: name, category)
        Product::firstOrCreate(['slug' => Str::slug($data['name'])], $([
            'name' => 'Mebel Custom',
            'slug' => 'mebel-custom',
            'category' => 'Mebel',
            'description' => 'Pembuatan mebel custom dengan desain modern dan bahan berkualitas.',
            'image' => 'images/products/mebel.jpg',
            'price' => 'Hubungi Kami',
            'price_note' => 'Harga tergantung desain dan ukuran',
            'color' => '#10b981',
            'is_available' => true,
            'is_featured' => true,
            'whatsapp_message' => 'Halo, saya tertarik dengan Mebel Custom. Mohon infonya.',
        ]);
        Product::firstOrCreate(['slug' => Str::slug($data['name'])], $([
            'name' => 'Gazebo Minimalis',
            'slug' => 'gazebo-minimalis',
            'category' => 'Gazebo',
            'description' => 'Gazebo minimalis untuk taman atau halaman rumah dengan berbagai pilihan ukuran.',
            'image' => 'images/products/gazebo.jpg',
            'price' => 'Mulai Rp 5.000.000',
            'price_note' => 'Tergantung ukuran dan bahan',
            'color' => '#f59e0b',
            'is_available' => true,
            'is_featured' => true,
            'whatsapp_message' => 'Halo, saya tertarik dengan Gazebo Minimalis. Mohon infonya.',
        ]);
        Product::firstOrCreate(['slug' => Str::slug($data['name'])], $([
            'name' => 'Mimbar Masjid',
            'slug' => 'mimbar-masjid',
            'category' => 'Mimbar',
            'description' => 'Mimbar masjid ukir jepara dengan kualitas terbaik dan desain elegan.',
            'image' => 'images/products/mimbar.jpg',
            'price' => 'Mulai Rp 8.000.000',
            'price_note' => 'Tergantung ukuran dan ukiran',
            'color' => '#3b82f6',
            'is_available' => true,
            'is_featured' => true,
            'whatsapp_message' => 'Halo, saya tertarik dengan Mimbar Masjid. Mohon infonya.',
        ]);
        Product::firstOrCreate(['slug' => Str::slug($data['name'])], $([
            'name' => 'CNC Custom',
            'slug' => 'cnc-custom',
            'category' => 'CNC',
            'description' => 'Jasa cutting dan engraving CNC untuk berbagai bahan (kayu, akrilik, dll).',
            'image' => 'images/products/cnc.jpg',
            'price' => 'Mulai Rp 50.000',
            'price_note' => 'Tergantung ukuran dan kerumitan',
            'color' => '#8b5cf6',
            'is_available' => true,
            'is_featured' => true,
            'whatsapp_message' => 'Halo, saya tertarik dengan jasa CNC Custom. Mohon infonya.',
        ]);
        Product::firstOrCreate(['slug' => Str::slug($data['name'])], $([
            'name' => 'Kavlingan Asnawi',
            'slug' => 'kavlingan-asnawi',
            'category' => 'Kavlingan',
            'description' => 'Kavling siap bangun dengan lokasi strategis dan fasilitas lengkap.',
            'image' => 'images/products/kavlingan.jpg',
            'price' => 'Hubungi Kami',
            'price_note' => 'Tergantung lokasi dan luas',
            'color' => '#ef4444',
            'is_available' => true,
            'is_featured' => true,
            'whatsapp_message' => 'Halo, saya tertarik dengan Kavlingan Asnawi. Mohon infonya.',
        ]);

        // Stats
        Stat::create(['label' => 'Proyek Selesai', 'value' => 50, 'icon' => 'check-circle']);
        Stat::create(['label' => 'Klien Puas', 'value' => 30, 'icon' => 'smile']);
        Stat::create(['label' => 'Tahun Pengalaman', 'value' => 5, 'icon' => 'award']);
    }
}