<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getDeviceType($userAgent)
    {
        $keywords = [
            'mobile' => ['Mobi', 'iPod', 'Android', 'webOS', 'iPhone', 'iPad', 'BlackBerry', 'Windows Phone'],
            'tablet' => ['Tablet', 'iPad'],
        ];

        foreach ($keywords as $type => $device) {
            foreach ($device as $keyword) {
                if (strpos($userAgent, $keyword) !== false) {
                    return $type;
                }
            }
        }

        return 'desktop';
    }
    public function getBrowser($userAgent)
    {
        // Očitavanje korisničkog agenta za pregledač
        $matches = [];
        preg_match('/\b(?:MSIE|Trident\/7.0|Edge)\b/', $userAgent, $matches); // Prepoznavanje Internet Explorera, Edge i starijih verzija
        if ($matches) {
            return 'Internet Explorer';
        }

        preg_match('/\b(?:Firefox|FxiOS)\b/', $userAgent, $matches); // Prepoznavanje Firefoxa
        if ($matches) {
            return 'Firefox';
        }

        preg_match('/\b(?:Chrome|CriOS)\b/', $userAgent, $matches); // Prepoznavanje Google Chrome-a
        if ($matches) {
            return 'Chrome';
        }

        preg_match('/\bSafari\b/', $userAgent, $matches);
        if ($matches) {
            return 'Safari';
        }

        return 'Unknown';
    }
}
