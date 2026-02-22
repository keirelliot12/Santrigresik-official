<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Pembuatan Website',
                'slug' => 'pembuatan-website',
                'description' => 'Website profesional, responsif, dan SEO-friendly untuk bisnis, toko online, company profile, dan landing page.',
                'icon' => 'globe',
                'color' => '#10b981',
                'is_featured' => false,
                'features' => json_encode(['Desain Custom & Modern', 'SEO Optimized', 'Mobile Responsive']),
            ],
            [
                'title' => 'Digitalisasi Pesantren',
                'slug' => 'digitalisasi-pesantren',
                'description' => 'Sistem informasi akademik, manajemen santri, pembayaran SPP digital, absensi online, dan e-learning pesantren.',
                'icon' => 'school',
                'color' => '#f59e0b',
                'is_featured' => true,
                'features' => json_encode(['Manajemen Santri & Guru', 'Pembayaran Digital', 'Rapor & Absensi Online']),
            ],
            [
                'title' => 'Automasi Sistem',
                'slug' => 'automasi-sistem',
                'description' => 'Otomasi workflow bisnis, chatbot WhatsApp, integrasi API, dan sistem notifikasi otomatis untuk efisiensi operasional.',
                'icon' => 'bot',
                'color' => '#8b5cf6',
                'is_featured' => false,
                'features' => json_encode(['WhatsApp Bot & CRM', 'Integrasi API', 'Workflow Automation']),
            ],
            [
                'title' => 'Digitalisasi Sistem',
                'slug' => 'digitalisasi-sistem',
                'description' => 'Transformasi proses manual menjadi sistem digital terintegrasi — inventory, akuntansi, HRD, dan manajemen operasional.',
                'icon' => 'database',
                'color' => '#06b6d4',
                'is_featured' => false,
                'features' => json_encode(['ERP & Inventory', 'Akuntansi Digital', 'Dashboard Analitik']),
            ],
            [
                'title' => 'Aplikasi Mobile',
                'slug' => 'aplikasi-mobile',
                'description' => 'Aplikasi Android & iOS native maupun cross-platform untuk kebutuhan bisnis, komunitas, dan e-commerce.',
                'icon' => 'smartphone',
                'color' => '#ec4899',
                'is_featured' => false,
                'features' => json_encode(['Android & iOS', 'Flutter / React Native', 'UI/UX Premium']),
            ],
        ];

        DB::table('services')->insert($services);
    }
}
