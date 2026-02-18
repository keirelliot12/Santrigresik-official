<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Digital Agency',
                'slug' => 'digital-agency',
                'description' => 'Tips dan insight tentang digital agency',
                'color' => '#3B82F6',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pesantren Digital',
                'slug' => 'pesantren-digital',
                'description' => 'Digitalisasi pesantren dan teknologi',
                'color' => '#10B981',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'UMKM Digital',
                'slug' => 'umkm-digital',
                'description' => 'Transformasi digital untuk UMKM',
                'color' => '#F59E0B',
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tutorial',
                'slug' => 'tutorial',
                'description' => 'Tutorial teknis dan panduan praktis',
                'color' => '#8B5CF6',
                'sort_order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('blog_categories')->insert($categories);
    }
}