<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeamMembersTableSeeder extends Seeder
{
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'Binkhozin',
                'slug' => 'binkhozin',
                'role' => 'Founder & Lead Developer',
                'bio' => 'Full-stack developer dengan spesialisasi Laravel & Flutter. Fokus pada digitalisasi pesantren dan solusi UMKM.',
                'image' => 'team/binkhozin.jpg',
                'social_links' => json_encode([
                    'linkedin' => 'https://linkedin.com/in/binkhozin',
                    'github' => 'https://github.com/binkhozin',
                    'twitter' => 'https://twitter.com/binkhozin'
                ]),
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ahmad Santoso',
                'slug' => 'ahmad-santoso',
                'role' => 'UI/UX Designer',
                'bio' => 'Designer dengan passion menciptakan pengalaman user yang intuitif dan modern untuk aplikasi web & mobile.',
                'image' => 'team/ahmad.jpg',
                'social_links' => json_encode([
                    'linkedin' => 'https://linkedin.com/in/ahmadsantoso',
                    'dribbble' => 'https://dribbble.com/ahmadsantoso'
                ]),
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Nurhaliza',
                'slug' => 'siti-nurhaliza',
                'role' => 'Project Manager',
                'bio' => 'Pengelola proyek berpengalaman dalam mengkoordinasi tim development dan memastikan delivery tepat waktu.',
                'image' => 'team/siti.jpg',
                'social_links' => json_encode([
                    'linkedin' => 'https://linkedin.com/in/sitinurhaliza'
                ]),
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('team_members')->insert($teamMembers);
    }
}