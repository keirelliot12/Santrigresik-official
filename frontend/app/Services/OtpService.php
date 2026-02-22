<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OtpService
{
    public function generateOtp(User $user): string
    {
        $otp = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
        
        $user->update([
            'otp_code' => Hash::make($otp),
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        return $otp;
    }

    public function validateOtp(User $user, string $otp): bool
    {
        if (!$user->otp_expires_at || now()->isAfter($user->otp_expires_at)) {
            return false;
        }

        return Hash::check($otp, $user->otp_code);
    }

    public function markAsVerified(User $user): void
    {
        $user->update([
            'is_otp_verified' => true,
            'email_verified_at' => now(),
        ]);
    }

    public function sendOtp(User $user, string $method = 'email'): bool
    {
        $otp = $this->generateOtp($user);

        switch ($method) {
            case 'email':
                return $this->sendEmailOtp($user, $otp);
            case 'whatsapp':
                return $this->sendWhatsappOtp($user, $otp);
            case 'sms':
                return $this->sendSmsOtp($user, $otp);
            default:
                return false;
        }
    }

    private function sendWhatsappOtp(User $user, string $otp): bool
    {
        if (!$user->phone) {
            return false;
        }

        $message = "*Kode OTP SantriGresik*\n\n" .
                  "Kode verifikasi Anda: *{$otp}*\n" .
                  "Berlaku selama 5 menit\n\n" .
                  "Jangan bagikan kode ini kepada siapapun!";

        // Integrasi dengan WhatsApp API (placeholder)
        // Contoh: WhatsAppBusinessApi::send($user->phone, $message);
        
        // Sementara log saja
        \Log::info("WhatsApp OTP sent to {$user->phone}: {$otp}");
        
        return true;
    }

    private function sendEmailOtp(User $user, string $otp): bool
    {
        if (!$user->email) {
            return false;
        }

        try {
            // Use log mailer for development (no SMTP setup needed)
            config(['mail.default' => 'log']);

            \Mail::raw(
                "Kode OTP Anda: {$otp}\n\n" .
                "Kode ini berlaku selama 5 menit.\n" .
                "Jangan bagikan kode ini kepada siapapun!\n\n" .
                "Jika Anda tidak meminta kode ini, abaikan email ini.",
                function ($message) use ($user) {
                    $message->to($user->email)
                           ->subject('Kode OTP SantriGresik - Login')
                           ->from(config('mail.from.address'), config('mail.from.name'));
                }
            );
            
            \Log::info("Email OTP sent to {$user->email}: {$otp}");
            \Log::info("OTP Email Content: Kode OTP Anda: {$otp}");
            return true;
        } catch (\Exception $e) {
            \Log::error("Failed to send OTP email to {$user->email}: " . $e->getMessage());
            return false;
        }
    }

    private function sendSmsOtp(User $user, string $otp): bool
    {
        if (!$user->phone) {
            return false;
        }

        $message = "Kode OTP SantriGresik: {$otp}. Berlaku 5 menit. Jangan bagikan kepada siapapun.";

        // Integrasi dengan SMS Gateway (placeholder)
        // Contoh: SmsGateway::send($user->phone, $message);
        
        // Sementara log saja
        \Log::info("SMS OTP sent to {$user->phone}: {$otp}");
        
        return true;
    }

    public function canResendOtp(User $user): bool
    {
        // Simple cooldown - check if OTP was sent in last minute
        if (!$user->otp_expires_at) {
            return true;
        }

        // Allow resend if OTP expired or 1 minute passed
        return now()->diffInSeconds($user->otp_expires_at) >= 240; // 4 minutes after expiry
    }

    public function markOtpSent(User $user): void
    {
        // No-op for null cache driver
    }
}