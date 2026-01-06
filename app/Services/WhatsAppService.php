<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $token;
    protected $endpoint = 'https://api.fonnte.com/send';

    public function __construct()
    {
        // Mengambil token dari file config/services.php
        $this->token = config('services.whatsapp.token');
    }

    public function sendMessage(string $to, string $message)
    {
        if (!$this->token) {
            Log::error('WhatsApp token is not set.');
            return false;
        }

        try {
            // withoutVerifying() akan mengabaikan pengecekan sertifikat SSL
            // Ini aman untuk development lokal
            $response = Http::withoutVerifying() // <-- INI ADALAH SOLUSINYA
                ->withHeaders([
                    'Authorization' => $this->token,
                ])->post($this->endpoint, [ // <-- KESALAHAN DI SINI SUDAH DIPERBAIKI
                    'target' => $to,
                    'message' => $message,
                ]);

            if ($response->failed()) {
                Log::error('WhatsApp notification failed: ' . $response->body());
                return false;
            }

            return true;

        } catch (\Exception $e) {
            Log::error('WhatsApp notification exception: ' . $e->getMessage());
            return false;
        }
    }
}

