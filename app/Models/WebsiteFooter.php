<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteFooter extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone',
        'whatsapp',
        'email',
        'location_url',
        'facebook',
        'instagram',
        'youtube',
        'twitter',
        'open_weekdays',
        'close_weekdays',
        'open_friday',
        'close_friday',
        'weekend_notes'
    ];

    /**
     * Accessor untuk link WhatsApp otomatis.
     * Penggunaan di Blade: {{ $footer->whatsapp_url }}
     */
    public function getWhatsappUrlAttribute()
    {
        if (!$this->whatsapp) return '#';
        
        // Membersihkan karakter selain angka
        $phone = preg_replace('/[^0-9]/', '', $this->whatsapp);
        
        // Jika nomor diawali '0', ubah menjadi '62'
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        
        return "https://wa.me/{$phone}";
    }

    /**
     * Accessor untuk jam operasional yang rapi.
     * Penggunaan di Blade: {{ $footer->weekday_hours }}
     */
    public function getWeekdayHoursAttribute()
    {
        return "{$this->open_weekdays} - {$this->close_weekdays} WIB";
    }

    /**
     * Accessor untuk jam operasional Jumat.
     */
    public function getFridayHoursAttribute()
    {
        return "{$this->open_friday} - {$this->close_friday} WIB";
    }
}