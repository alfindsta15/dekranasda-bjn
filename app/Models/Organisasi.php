<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    // Karena nama tabelnya 'organisasi' (bukan 'organisasis')
    protected $table = 'organisasi';

    protected $fillable = [
        'name',         // Nama lengkap
        'position',     // Jabatan
        'description',  // Deskripsi (opsional)
        'photo_path',   // Path foto (storage)
        'order',        // Urutan tampil
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    // Accessor: $organisasi->photo_url
    public function getPhotoUrlAttribute(): string
    {
        return $this->photo_path
            ? asset('storage/'.$this->photo_path)
            : asset('images/placeholder.png');
    }
}
