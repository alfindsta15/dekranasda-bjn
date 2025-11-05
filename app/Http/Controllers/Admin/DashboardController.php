<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\News;
use App\Models\Binaan;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();
        $totalBerita = News::count();
        $totalBinaan = Binaan::count();
        $totalPesan  = Message::count();

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalBerita',
            'totalBinaan',
            'totalPesan'
        ));
    }
}
