<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = [
        'name','category_id','price','unit','description',
        'image_path','is_featured','is_active','owner_id', // opsional
        // ⬇️ baru
        'owner_name','owner_phone','owner_address','instagram',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
        // sebelumnya integer — ganti agar cocok dengan decimal(10,2)
        'price'       => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image_path
            ? asset('storage/'.$this->image_path)
            : asset('images/placeholder.png');
    }
}
