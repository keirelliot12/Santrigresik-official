<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatbotFaq;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    /**
     * Default fallback replies when no FAQ matches.
     */
    private array $fallbackReplies = [
        'Terima kasih atas pertanyaan Anda! Untuk informasi lebih lanjut, silakan hubungi tim kami melalui WhatsApp.',
        'Pertanyaan Anda sangat bagus! Kami siap membantu. Hubungi kami di WhatsApp untuk konsultasi gratis.',
        'Kami tidak menemukan jawaban spesifik untuk pertanyaan Anda. Tim kami di WhatsApp siap membantu Anda!',
    ];

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userMessage = trim($request->input('message'));
        $lowerMessage = mb_strtolower($userMessage);

        // Try to find a matching FAQ
        $answer = $this->findAnswer($lowerMessage);

        if ($answer) {
            return response()->json([
                'reply' => $answer['reply'],
                'category' => $answer['category'],
                'show_whatsapp' => false,
            ]);
        }

        // No match — return fallback with WhatsApp CTA
        $fallback = $this->fallbackReplies[array_rand($this->fallbackReplies)];
        $waNumber = config('app.whatsapp_number', '6281234567890');
        $waText = rawurlencode("Halo SantriGresik.id, saya ingin bertanya: {$userMessage}");

        return response()->json([
            'reply' => $fallback,
            'category' => 'fallback',
            'show_whatsapp' => true,
            'whatsapp_url' => "https://wa.me/{$waNumber}?text={$waText}",
        ]);
    }

    private function findAnswer(string $message): ?array
    {
        // Load active FAQs ordered by sort_order
        $faqs = ChatbotFaq::active()->orderBy('sort_order')->get();

        foreach ($faqs as $faq) {
            $keywords = $faq->keywords ?? [];

            // Also split the question itself into keywords as fallback
            if (empty($keywords)) {
                $keywords = array_filter(explode(' ', mb_strtolower($faq->question)));
            }

            foreach ($keywords as $keyword) {
                $keyword = mb_strtolower(trim((string) $keyword));
                if ($keyword !== '' && str_contains($message, $keyword)) {
                    return [
                        'reply' => $faq->answer,
                        'category' => $faq->category,
                    ];
                }
            }
        }

        return null;
    }
}
