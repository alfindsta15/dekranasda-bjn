<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Binaan extends Model
{
    // tabelnya tunggal (singular)
    protected $table = 'binaan';

    protected $fillable = [
        'image',        // path di storage/app/public/...
        'name',
        'address',
        'phone',
        'email',
        'instagram',    // opsional
        'facebook',     // opsional
        'status',       // 'aktif' / 'nonaktif'
        'brand',        // kalau masih mau dipakai, biarkan saja
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // URL siap pakai untuk gambar (hindari linter error)
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;

        // Kalau sudah URL penuh, langsung kembalikan
        if (Str::startsWith($this->image, ['http://','https://'])) {
            return $this->image;
        }

        // Akses via symlink public/storage
        return asset('storage/' . ltrim($this->image, '/'));
    }

    // Scope: hanya status aktif
    public function scopeActive($q)
    {
        return $q->where('status', 'aktif');
    }

    // Scope: pencarian fleksibel
    public function scopeSearch($q, ?string $term)
    {
        if (!$term) return $q;
        $term = "%{$term}%";
        return $q->where(function ($qq) use ($term) {
            $qq->where('name', 'like', $term)
               ->orWhere('brand', 'like', $term)
               ->orWhere('address', 'like', $term)
               ->orWhere('phone', 'like', $term)
               ->orWhere('email', 'like', $term)
               ->orWhere('instagram', 'like', $term)
               ->orWhere('facebook', 'like', $term);
        });
    }
}
