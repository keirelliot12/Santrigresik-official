<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Produk | SantriGresik Official</title>
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
                <span class="px-4 py-1 rounded-full text-sm glass">{{ $product->category }}</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold font-serif mb-6">
                {{ $product->name }}
            </h1>
            <p class="text-3xl font-bold gradient-text mb-8">
                {{ $product->price }}
            </p>
            <p class="text-xl text-gray-300 max-w-3xl mb-8">
                {{ $product->description }}
            </p>
            <a href="https://wa.me/6281332875057?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($product->name) }}" target="_blank" class="gradient-bg px-8 py-4 rounded-full font-semibold inline-flex items-center gap-2 hover:opacity-90 transition">
                <i data-lucide="message-circle" class="w-5 h-5"></i>
                Pesan Sekarang
            </a>
        </div>
    </section>

    <!-- Features -->
    <section class="py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold font-serif mb-8">Fitur yang Anda Dapatkan</h2>
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($product->features as $feature)
                    <div class="glass p-6 rounded-2xl flex items-center gap-4">
                        <i data-lucide="check-circle" class="w-6 h-6 text-green-400 flex-shrink-0"></i>
                        <p class="font-semibold">{{ $feature }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-6">
        <div class="max-w-4xl mx-auto glass p-12 rounded-3xl text-center">
            <h2 class="text-4xl font-bold font-serif mb-6">Siap Memulai Project Anda?</h2>
            <p class="text-xl text-gray-300 mb-8">
                Konsultasikan kebutuhan Anda dengan kami. Gratis tanpa biaya!
            </p>
            <a href="https://wa.me/6281332875057?text=Halo%2C%20saya%20ingin%20konsultasi%20tentang%20{{ urlencode($product->name) }}" target="_blank" class="gradient-bg px-8 py-4 rounded-full font-semibold inline-flex items-center gap-2 hover:opacity-90 transition">
                <i data-lucide="message-circle" class="w-5 h-5"></i>
                Chat WhatsApp
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