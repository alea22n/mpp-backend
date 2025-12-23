<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WebsiteProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'vision',
        'mission',
        'image_path_1',
        'image_path_2',
        'image_path_3',
        'video_path'
    ];

    /**
     * Mempermudah akses URL media di Blade.
     * Contoh penggunaan: $profile->image_1_url
     */
    public function getImage1UrlAttribute()
    {
        return $this->image_path_1 ? asset('storage/' . $this->image_path_1) : null;
    }

    public function getImage2UrlAttribute()
    {
        return $this->image_path_2 ? asset('storage/' . $this->image_path_2) : null;
    }

    public function getImage3UrlAttribute()
    {
        return $this->image_path_3 ? asset('storage/' . $this->image_path_3) : null;
    }

    public function getVideoUrlAttribute()
    {
        return $this->video_path ? asset('storage/' . $this->video_path) : null;
    }
}