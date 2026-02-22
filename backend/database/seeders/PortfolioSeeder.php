<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $portfolios = [
            [
                'title' => 'Company Profile - PT. Industri Gresik',
                'slug' => 'pt-industri-gresik',
                'category' => 'Website',
                'description' => 'Website company profile modern dengan fitur multi-bahasa dan CMS untuk kemudahan update konten.',
                'image_url' => 'https://via.placeholder.com/600x400.png?text=PT+Industri+Gresik',
                'technologies' => json_encode(['Laravel 11', 'FilamentPHP', 'Tailwind CSS', 'MySQL']),
                'client' => 'PT. Industri Gresik',
                'year' => '2025',
                'url' => '#',
                'color' => '#10b981',
                'icon' => 'globe',
            ],
            [
                'title' => 'SIAKAD Pesantren An-Nibros',
                'slug' => 'siakad-an-nibros',
                'category' => 'Sistem',
                'description' => 'Sistem informasi akademik pesantren terintegrasi dengan pembayaran digital, absensi, dan nilai siswa.',
                'image_url' => 'https://via.placeholder.com/600x400.png?text=SIAKAD+An-Nibros',
                'technologies' => json_encode(['Laravel 11', 'FilamentPHP', 'MySQL', 'Midtrans API']),
                'client' => 'Pesantren An-Nibros',
                'year' => '2025',
                'url' => '#',
                'color' => '#f59e0b',
                'icon' => 'school',
            ],
            [
                'title' => 'Aplikasi Majmu\'ah Islamiyah',
                'slug' => 'majmuah-islamiyah',
                'category' => 'Aplikasi',
                'description' => 'Aplikasi mobile untuk kumpulan doa, wirid, dan ratib harian dengan fitur reminder dan offline mode.',
                'image_url' => 'https://via.placeholder.com/600x400.png?text=Majmuah+Islamiyah',
                'technologies' => json_encode(['Flutter', 'Dart', 'Firebase', 'SQLite']),
                'client' => 'Majmu\'ah Islamiyah',
                'year' => '2025',
                'url' => '#',
                'color' => '#8b5cf6',
                'icon' => 'smartphone',
            ],
            [
                'title' => 'E-Commerce UMKM Gresik',
                'slug' => 'ecommerce-umkm',
                'category' => 'Website',
                'description' => 'Platform e-commerce untuk UMKM dengan fitur keranjang, checkout, dan integrasi payment gateway.',
                'image_url' => 'https://via.placeholder.com/600x400.png?text=E-Commerce+UMKM',
                'technologies' => json_encode(['Laravel 11', 'Livewire', 'Alpine.js', 'Midtrans']),
                'client' => 'UMKM Gresik',
                'year' => '2025',
                'url' => '#',
                'color' => '#ec4899',
                'icon' => 'shopping-bag',
            ],
            [
                'title' => 'Dashboard Donasi Online',
                'slug' => 'dashboard-donasi',
                'category' => 'Sistem',
                'description' => 'Dashboard real-time untuk monitoring donasi dengan fitur export laporan dan integrasi payment gateway.',
                'image_url' => 'https://via.placeholder.com/600x400.png?text=Dashboard+Donasi',
                'technologies' => json_encode(['Laravel 11', 'FilamentPHP', 'MySQL', 'Chart.js']),
                'client' => 'Yayasan Amal',
                'year' => '2025',
                'url' => '#',
                'color' => '#06b6d4',
                'icon' => 'bar-chart-3',
            ],
            [
                'title' => 'WeddingPress — Undangan Digital',
                'slug' => 'wedding-press',
                'category' => 'Aplikasi',
                'description' => 'Platform undangan digital dengan fitur RSVP, galeri foto, dan custom theme untuk pernikahan.',
                'image_url' => 'https://via.placeholder.com/600x400.png?text=WeddingPress',
                'technologies' => json_encode(['Laravel 11', 'Vue.js', 'Firebase', 'Cloudinary']),
                'client' => 'WeddingPress',
                'year' => '2025',
                'url' => '#',
                'color' => '#f43f5e',
                'icon' => 'heart',
            ],
        ];

        DB::table('portfolios')->insert($portfolios);
    }
}
