<?php

namespace Database\Seeders;

use App\Models\ChatbotFaq;
use Illuminate\Database\Seeder;

class ChatbotFaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            // Layanan
            [
                'question' => 'Apa saja layanan yang tersedia?',
                'answer' => 'SantriGresik.id menyediakan layanan berikut:' . "\n\n" .
                    '🌐 **Web Development** — Pembuatan website profesional & toko online\n' .
                    '📱 **Aplikasi Mobile** — Android & iOS untuk bisnis Anda\n' .
                    '🏫 **Digitalisasi Pesantren** — Sistem manajemen santri & keuangan\n' .
                    '⚙️ **Automasi Sistem** — Custom software & integrasi API\n' .
                    '🪑 **Produk Fisik** — Mebel, gazebo, mimbar masjid, ukiran CNC\n\n' .
                    'Silakan hubungi kami untuk konsultasi gratis!',
                'category' => 'layanan',
                'keywords' => ['layanan', 'service', 'jasa', 'apa yang', 'tersedia', 'ditawarkan', 'bisa apa'],
                'sort_order' => 1,
            ],
            [
                'question' => 'Apakah kalian bisa membuat website?',
                'answer' => 'Ya! Kami spesialis dalam pembuatan website profesional, meliputi:' . "\n\n" .
                    '✅ Website company profile\n' .
                    '✅ Toko online / e-commerce\n' .
                    '✅ Landing page marketing\n' .
                    '✅ Sistem informasi pesantren\n' .
                    '✅ Website blog & portofolio\n\n' .
                    'Semua website kami responsive (mobile-friendly), SEO-optimized, dan dengan panel admin yang mudah digunakan.',
                'category' => 'layanan',
                'keywords' => ['website', 'web', 'situs', 'landing page', 'toko online', 'e-commerce', 'ecommerce'],
                'sort_order' => 2,
            ],
            [
                'question' => 'Apa itu Digitalisasi Pesantren?',
                'answer' => 'Digitalisasi Pesantren adalah layanan kami untuk membantu pondok pesantren go digital, meliputi:' . "\n\n" .
                    '📚 Sistem manajemen data santri\n' .
                    '💰 Sistem keuangan & pembayaran SPP\n' .
                    '📅 Jadwal pelajaran & absensi digital\n' .
                    '📣 Portal informasi pesantren\n' .
                    '📱 Aplikasi orang tua santri\n\n' .
                    'Harga khusus untuk pesantren & lembaga pendidikan!',
                'category' => 'layanan',
                'keywords' => ['pesantren', 'santri', 'pondok', 'digitalisasi', 'madrasah'],
                'sort_order' => 3,
            ],
            [
                'question' => 'Apakah kalian bisa membuat aplikasi mobile?',
                'answer' => 'Tentu! Kami membuat aplikasi mobile untuk Android dan iOS, termasuk:' . "\n\n" .
                    '📱 Aplikasi bisnis & marketplace\n' .
                    '🏫 Aplikasi manajemen pesantren\n' .
                    '🛒 Aplikasi toko online mobile\n' .
                    '📊 Aplikasi laporan & dashboard\n\n' .
                    'Teknologi yang kami gunakan: React Native, Flutter, dan native Android/iOS.',
                'category' => 'layanan',
                'keywords' => ['aplikasi', 'mobile', 'android', 'ios', 'app', 'smartphone'],
                'sort_order' => 4,
            ],

            // Harga
            [
                'question' => 'Berapa harga pembuatan website?',
                'answer' => 'Harga website kami bervariasi tergantung kebutuhan:' . "\n\n" .
                    '💼 Landing Page: mulai Rp 1.500.000\n' .
                    '🌐 Website Company Profile: mulai Rp 3.000.000\n' .
                    '🛒 Toko Online (E-commerce): mulai Rp 5.000.000\n' .
                    '🏫 Sistem Pesantren: mulai Rp 7.000.000\n\n' .
                    'Harga dapat berubah sesuai fitur & kompleksitas. Hubungi kami untuk penawaran terbaik!',
                'category' => 'harga',
                'keywords' => ['harga', 'biaya', 'tarif', 'cost', 'price', 'berapa', 'budget', 'murah'],
                'sort_order' => 5,
            ],

            // Proses
            [
                'question' => 'Bagaimana proses kerja kalian?',
                'answer' => 'Proses kerja kami terdiri dari 5 tahap:' . "\n\n" .
                    '1️⃣ **Konsultasi** — Diskusi kebutuhan & brief proyek\n' .
                    '2️⃣ **Penawaran** — Quotation & timeline pengerjaan\n' .
                    '3️⃣ **Desain** — UI/UX mockup untuk persetujuan\n' .
                    '4️⃣ **Development** — Pengembangan dengan update berkala\n' .
                    '5️⃣ **Serah Terima** — Testing, training, dan deployment\n\n' .
                    'Setiap proyek disertai garansi & support pasca-launch.',
                'category' => 'proses',
                'keywords' => ['proses', 'alur', 'tahap', 'langkah', 'cara kerja', 'workflow', 'bagaimana', 'prosedur'],
                'sort_order' => 6,
            ],
            [
                'question' => 'Berapa lama pengerjaan website?',
                'answer' => 'Estimasi waktu pengerjaan:' . "\n\n" .
                    '⚡ Landing Page: 3–5 hari kerja\n' .
                    '🌐 Website Company Profile: 7–14 hari kerja\n' .
                    '🛒 Toko Online: 14–21 hari kerja\n' .
                    '🏫 Sistem Custom: 21–45 hari kerja\n\n' .
                    'Timeline dapat disesuaikan dengan kebutuhan & urgensi proyek Anda.',
                'category' => 'proses',
                'keywords' => ['lama', 'waktu', 'durasi', 'kapan', 'selesai', 'deadline', 'berapa hari', 'estimasi'],
                'sort_order' => 7,
            ],

            // Portfolio
            [
                'question' => 'Lihat portfolio kalian',
                'answer' => 'Kami telah mengerjakan berbagai proyek digital, mulai dari website, aplikasi mobile, hingga sistem manajemen.' . "\n\n" .
                    'Silakan gulir ke bagian Portfolio di halaman ini untuk melihat karya terbaik kami, atau klik tombol di bawah untuk konsultasi langsung!',
                'category' => 'portfolio',
                'keywords' => ['portfolio', 'portofolio', 'karya', 'project', 'proyek', 'hasil kerja', 'contoh'],
                'sort_order' => 8,
            ],

            // Kontak
            [
                'question' => 'Bagaimana cara menghubungi kalian?',
                'answer' => 'Anda dapat menghubungi kami melalui:' . "\n\n" .
                    '📱 **WhatsApp**: +62 812-3456-7890\n' .
                    '📧 **Email**: hello@santrigresik.id\n' .
                    '📍 **Lokasi**: Gresik, Jawa Timur\n' .
                    '🕐 **Jam Operasional**: Senin–Sabtu, 08:00–17:00 WIB\n\n' .
                    'Atau gunakan tombol Chat WhatsApp di bawah ini!',
                'category' => 'kontak',
                'keywords' => ['kontak', 'hubungi', 'contact', 'telepon', 'email', 'whatsapp', 'wa', 'nomor', 'alamat', 'lokasi'],
                'sort_order' => 9,
            ],
            [
                'question' => 'Apakah ada konsultasi gratis?',
                'answer' => 'Ya! Kami menyediakan konsultasi gratis tanpa komitmen. 🎉\n\n' .
                    'Anda dapat berkonsultasi tentang kebutuhan digital bisnis atau pesantren Anda langsung dengan tim kami.\n\n' .
                    'Hubungi kami via WhatsApp sekarang untuk jadwalkan sesi konsultasi!',
                'category' => 'kontak',
                'keywords' => ['konsultasi', 'gratis', 'free', 'tanya', 'diskusi'],
                'sort_order' => 10,
            ],
        ];

        foreach ($faqs as $faq) {
            ChatbotFaq::firstOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }
    }
}
