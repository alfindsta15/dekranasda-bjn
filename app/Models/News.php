<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $fillable = ['title', 'content', 'status', 'image_path'];
    protected $appends  = ['image_url'];

    protected $casts = [
        'status' => 'string',
    ];

    public function scopePublished($q)
    {
        return $q->where('status', 'published');
    }

    public function getImageUrlAttribute()
    {
        $p = $this->image_path ?: '';
        if ($p === '') {
            return asset('images/placeholder.png');
        }

        // normalisasi path (hilangkan leading slash & prefix "public/")
        $p = ltrim($p, '/');
        if (str_starts_with($p, 'public/')) {
            $p = substr($p, 7);
        }

        // cek file ada di disk public
        if (Storage::disk('public')->exists($p)) {
            // gunakan asset() agar aman di localhost/subfolder
            return asset('storage/'.$p);
        }

        return asset('images/placeholder.png');
    }
}
