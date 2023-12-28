<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Sinch
{
    public static function send($message)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer 41414e17678f4d118a5e0a4a783fafb5',
            'Content-Type' => 'application/json',
        ])->post('https://sms.api.sinch.com/xms/v1/d65342a899b441e3ad2bf5f8a5a501a6/batches', [
            'from' => '',
            'to' => ['639612794833'],
            'body' => $message,
        ]);
    }
}