<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('product.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        // Produk lain (mis. 8 item) — bisa dari kategori yang sama
        $otherProducts = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->when($product->category_id, fn($q) => $q->where('category_id', $product->category_id))
            ->latest()
            ->take(8)
            ->get();

        return view('product.show', compact('product', 'otherProducts'));
    }
}

