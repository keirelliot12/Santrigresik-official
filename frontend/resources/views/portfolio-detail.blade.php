<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->title }} - Portfolio | SantriGresik Official</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .gradient-text {
            background: linear-gradient(135deg, #a855f7, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #a855f7, #ec4899);
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-[#0f0f1a] text-white min-h-screen">
    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="text-2xl font-bold font-serif">SantriGresik</a>
                <div class="hidden md:flex items-center gap-8">
                    <a href="/" class="hover:text-purple-400 transition">Home</a>
                    <a href="#services" class="hover:text-purple-400 transition">Services</a>
                    <a href="#portfolio" class="hover:text-purple-400 transition">Portfolio</a>
                    <a href="#shop" class="hover:text-purple-400 transition">Shop</a>
                    <a href="#contact" class="hover:text-purple-400 transition">Contact</a>
                </div>
                <a href="#contact" class="gradient-bg px-6 py-2 rounded-full font-semibold hover:opacity-90 transition">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center gap-2 mb-4">
                <span class="px-4 py-1 rounded-full text-sm glass">{{ $portfolio->category }}</span>
                <span class="text-gray-400">{{ $portfolio->year }}</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold font-serif mb-6">
                {{ $portfolio->title }}
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mb-8">
                {{ $portfolio->description }}
            </p>
            <a href="{{ $portfolio->url }}" target="_blank" class="gradient-bg px-8 py-4 rounded-full font-semibold inline-flex items-center gap-2 hover:opacity-90 transition">
                <i data-lucide="external-link" class="w-5 h-5"></i>
                Lihat Website
            </a>
        </div>
    </section>

    <!-- Project Info -->
    <section class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass p-6 rounded-2xl">
                    <i data-lucide="building" class="w-8 h-8 text-purple-400 mb-4"></i>
                    <h3 class="font-semibold mb-2">Klien</h3>
                    <p class="text-gray-400">{{ $portfolio->client }}</p>
                </div>
                <div class="glass p-6 rounded-2xl">
                    <i data-lucide="calendar" class="w-8 h-8 text-purple-400 mb-4"></i>
                    <h3 class="font-semibold mb-2">Tahun</h3>
                    <p class="text-gray-400">{{ $portfolio->year }}</p>
                </div>
                <div class="glass p-6 rounded-2xl">
                    <i data-lucide="globe" class="w-8 h-8 text-purple-400 mb-4"></i>
                    <h3 class="font-semibold mb-2">Tipe Project</h3>
                    <p class="text-gray-400">{{ $portfolio->category }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Technologies -->
    <section class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold font-serif mb-8">Teknologi yang Digunakan</h2>
            <div class="grid md:grid-cols-4 gap-4">
                @foreach($portfolio->technologies as $tech)
                    <div class="glass p-4 rounded-xl text-center">
                        <p class="font-semibold">{{ $tech }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold font-serif mb-6">Tertarik dengan Project Serupa?</h2>
            <p class="text-xl text-gray-300 mb-8">
                Kami siap membantu mewujudkan ide Anda menjadi kenyataan.
            </p>
            <a href="#contact" class="gradient-bg px-8 py-4 rounded-full font-semibold inline-flex items-center gap-2 hover:opacity-90 transition">
                <i data-lucide="message-circle" class="w-5 h-5"></i>
                Konsultasi Gratis
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 px-6 border-t border-gray-800">
        <div class="max-w-7xl mx-auto text-center text-gray-400">
            <p>&copy; 2026 SantriGresik Official. All rights reserved.</p>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>