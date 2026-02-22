<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Mebel Custom',
                'slug' => 'mebel-custom',
                'category' => 'Produk Fisik',
                'price' => 'Mulai Rp 2.5 Juta',
                'description' => 'Furniture kayu jati berkualitas — meja, kursi, lemari, set ruang tamu, dan mebel custom sesuai keinginan. Dikerjakan oleh pengrajin berpengalaman dengan material premium.',
                'image_url' => 'https://via.placeholder.com/600x400.png?text=Mebel+Custom',
                'color' => '#92400e',
                'badge' => 'Custom Order',
                'features' => json_encode(['Kayu Jati / Glugu Premium', 'Desain Custom Sesuai Permintaan', 'Finishing Halus & Tahan Lama', 'Gratis Pengiriman Area Gresik', 'Garansi 1 Tahun', 'Tersedia Berbagai Ukuran']),
            ],
            [
                'name' => 'Gazebo Kayu',
                'slug' => 'gazebo-kayu',
                'category' => 'Produk Fisik',
                'price' => 'Mulai Rp 8 Juta',
                'description' => 'Gazebo kayu jati & glugu premium untuk taman, villa, resort, dan area outdoor dengan desain elegan. Cocok untuk bersantai dan menikmati suasana alam.',
                'image_url' => 'https://via.placeholder.com/600x400.png?text=Gazebo+Kayu',
                'color' => '#065f46',
                'badge' => 'Best Seller',
                'features' => json_encode(['Kayu Jati / Glugu Pilihan', 'Tahan Cuaca & Anti Rayap', 'Desain Modern & Elegan', 'Tersedia Berbagai Ukuran', 'Gratis Pemasangan Area Gresik', 'Garansi 2 Tahun']),
            ],
            [
                'name' => 'Mimbar Masjid',
                'slug' => 'mimbar-masjid',
                'category' => 'Produk Fisik',
                'price' => 'Mulai Rp 5 Juta',
                'description' => 'Mimbar masjid dengan ukiran kaligrafi yang indah dan kokoh. Dibuat dengan penuh ketelitian untuk kenyamanan khatib.',
                'image_url' => 'https://via.placeholder.com/600x400.png?text=Mimbar+Masjid',
                'color' => '#7c2d12',
                'badge' => 'Handmade',
                'features' => json_encode(['Kayu Jati TPK', 'Ukiran Kaligrafi Halus', 'Cat Pilihan (Melamine/Natural)', 'Tinggi Sesuai Standar', 'Gratis Pengiriman Area Gresik', 'Garansi 1 Tahun']),
            ],
            [
                'name' => 'Jasa CNC',
                'slug' => 'jasa-cnc',
                'category' => 'Jasa',
                'price' => 'Mulai Rp 50.000/cm',
                'description' => 'Jasa pemotongan CNC presisi untuk berbagai kebutuhan: aksesoris, hiasan dinding, ornamen, dan custom design sesuai keinginan.',
                'image_url' => 'https://via.placeholder.com/600x400.png?text=Jasa+CNC',
                'color' => '#4338ca',
                'badge' => 'Presisi Tinggi',
                'features' => json_encode(['Mesin CNC Presisi Tinggi', 'Bahan: Kayu, Akrilik, MDF', 'Custom Design Sesuai Permintaan', 'Pengerjaan Cepat', 'Hasil Rapi & Detail', 'Mendukung File: DXF, AI, CDR']),
            ],
            [
                'name' => 'Kavlingan Tanah',
                'slug' => 'kavlingan-tanah',
                'category' => 'Properti',
                'price' => 'Mulai Rp 500 Juta',
                'description' => 'Tanah kavling siap bangun di lokasi strategis. Cocok untuk hunian, ruko, atau investasi jangka panjang.',
                'image_url' => 'https://via.placeholder.com/600x400.png?text=Kavlingan+Tanah',
                'color' => '#166534',
                'badge' => 'Investasi',
                'features' => json_encode(['Lokasi Strategis', 'Surat Lengkap (SHM)', 'Bebas Banjir', 'Akses Jalan Lebar', 'Dekat Fasilitas Umum', 'Potensi Kenaikan Harga Tinggi']),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
