<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialsTableSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Ustadz Abdullah',
                'role' => 'Pengasuh Pesantren',
                'company' => 'Pondok Pesantren Al-Hidayah',
                'content' => 'SantriGresik berhasil membantu kami digitalisasi sistem pesantren. Sekarang administrasi santri, pembayaran SPP, dan rapor semua online. Sangat memudahkan!',
                'rating' => 5.0,
                'image' => 'testimonials/ustadz-abdullah.jpg',
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Owner',
                'company' => 'Toko Bangunan Jaya Abadi',
                'content' => 'Website company profile yang dibuat sangat profesional. Sudah membantu kami dapat banyak klien baru. Recommended!',
                'rating' => 5.0,
                'image' => 'testimonials/budi-santoso.jpg',
                'is_active' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Aminah',
                'role' => 'Marketing Manager',
                'company' => 'Catering Sehat Sejahtera',
                'content' => 'Sistem pemesanan online yang dibuat sangat user-friendly. Orderan sekarang lebih teratur dan tidak ada yang tertinggal.',
                'rating' => 4.5,
                'image' => 'testimonials/siti-aminah.jpg',
                'is_active' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('testimonials')->insert($testimonials);
    }
}