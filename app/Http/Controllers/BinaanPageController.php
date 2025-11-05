<?php

namespace App\Http\Controllers;

use App\Models\Binaan;
use Illuminate\Http\Request;

class BinaanPageController extends Controller
{
    /**
     * /binaan/daftar
     * Ditampilkan di menu sebagai "Daftar Brand" (isi sebenarnya: daftar binaan).
     * View: resources/views/pages/binaan/daftar.blade.php
     */
    public function daftar(Request $request)
    {
        $perPage = (int) $request->get('per_page', 12);
        $perPage = max(6, min($perPage, 60));

        $binaan = Binaan::query()
            ->active()
            ->search($request->get('q'))
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.binaan.daftar', compact('binaan'));
    }

    /**
     * /binaan/brand
     * Ditampilkan di menu sebagai "Tata Cara Menjadi Binaan" (berdasarkan permintaan label).
     * Di sini saya menampilkan entri yang memiliki brand (bisa kamu ganti isinya sesuai kebutuhan).
     * View: resources/views/pages/binaan/brand.blade.php
     */
    public function brand(Request $request)
    {
        $perPage = (int) $request->get('per_page', 12);
        $perPage = max(6, min($perPage, 60));

        $brands = Binaan::query()
            ->active()
            ->whereNotNull('brand')->where('brand', '!=', '')
            ->search($request->get('q'))
            ->orderBy('brand')
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.binaan.tata_cara', compact('brands'));
    }
}
