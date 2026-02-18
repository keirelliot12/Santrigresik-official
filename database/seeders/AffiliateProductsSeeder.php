<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AffiliateProductsSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Mebel Jati Premium',
                'slug' => 'mebel-jati-premium',
                'category_id' => 1,
                'short_description' => 'Mebel jati berkualitas tinggi untuk rumah dan kantor',
                'full_description' => 'Mebel jati premium dengan desain klasik modern. Tersedia berbagai model untuk ruang tamu, kamar tidur, dan ruang kerja.',
                'specifications' => json_encode([
                    'material' => 'Kayu Jati Tua',
                    'finish' => 'Natural Wood',
                    'origin' => 'Jepara',
                    'warranty' => '2 Tahun'
                ]),
                'price_min' => '2500000',
                'price_max' => '15000000',
                'images' => json_encode(['products/mebel-1.jpg', 'products/mebel-2.jpg']),
                'whatsapp_number' => '+6281332875057',
                'whatsapp_message_template' => 'Halo, saya tertarik dengan Mebel Jati Premium. Bisa info detail dan harga terbaru?',
                'is_available' => true,
                'sort_order' => 1,
                'views_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gazebo Kayu Kelapa',
                'slug' => 'gazebo-kayu-kelapa',
                'category_id' => 2,
                'short_description' => 'Gazebo taman elegan untuk area outdoor',
                'full_description' => 'Gazebo kayu kelapa dengan desain tropis. Cocok untuk taman, area santai, dan tempat pertemuan outdoor.',
                'specifications' => json_encode([
                    'material' => 'Kayu Kelapa',
                    'size' => '3x3m, 4x4m, Custom',
                    'roof' => 'Sirap/Seng',
                    'installation' => 'Include'
                ]),
                'price_min' => '3500000',
                'price_max' => '8000000',
                'images' => json_encode(['products/gazebo-1.jpg', 'products/gazebo-2.jpg']),
                'whatsapp_number' => '+6281332875057',
                'whatsapp_message_template' => 'Saya ingin pesan Gazebo Kayu Kelapa. Apakah bisa custom size?',
                'is_available' => true,
                'sort_order' => 2,
                'views_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mimbar Masjid Ukir Jepara',
                'slug' => 'mimbar-masjid-ukiran',
                'category_id' => 3,
                'short_description' => 'Mimbar masjid berukir khas Jepara',
                'full_description' => 'Mimbar masjid dengan ukiran khas Jepara. Terbuat dari kayu jati berkualitas dengan desain elegan.',
                'specifications' => json_encode([
                    'material' => 'Kayu Jati',
                    'height' => '150cm',
                    'width' => '80cm',
                    'carving' => 'Manual Jepara'
                ]),
                'price_min' => '2500000',
                'price_max' => '6000000',
                'images' => json_encode(['products/mimbar-1.jpg', 'products/mimbar-2.jpg']),
                'whatsapp_number' => '+6281332875057',
                'whatsapp_message_template' => 'Saya butuh Mimbar Masjid untuk musholla. Bisa lihat contoh ukirannya?',
                'is_available' => true,
                'sort_order' => 3,
                'views_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('affiliate_products')->insert($products);
    }
}