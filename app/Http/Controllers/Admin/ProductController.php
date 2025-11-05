<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.produk.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.produk.create', compact('categories'));
    }

    public function store(Request $r)
    {
        $data = $r->validate($this->rules());

        // Checkbox featured
        $data['is_featured'] = $r->boolean('is_featured');
        // default aktif saat dibuat
        $data['is_active']   = true;

        // Normalisasi instagram: simpan tanpa '@'
        if (!empty($data['instagram'])) {
            $data['instagram'] = ltrim($data['instagram'], '@');
        }

        // Upload gambar (opsional)
        if ($r->hasFile('image')) {
            $data['image_path'] = $r->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.produk.index')->with('ok', 'Produk dibuat.');
    }

    public function edit(Product $produk)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.produk.edit', [
            'product'    => $produk,
            'categories' => $categories,
        ]);
    }

    public function update(Request $r, Product $produk)
    {
        $data = $r->validate($this->rules());

        // Checkbox featured
        $data['is_featured'] = $r->boolean('is_featured');

        // Normalisasi instagram: simpan tanpa '@'
        if (!empty($data['instagram'])) {
            $data['instagram'] = ltrim($data['instagram'], '@');
        }

        // Upload gambar baru (hapus lama jika ada)
        if ($r->hasFile('image')) {
            if ($produk->image_path && Storage::disk('public')->exists($produk->image_path)) {
                Storage::disk('public')->delete($produk->image_path);
            }
            $data['image_path'] = $r->file('image')->store('products', 'public');
        }

        $produk->update($data);

        return redirect()->route('admin.produk.index')->with('ok', 'Produk diperbarui.');
    }

    public function destroy(Product $produk)
    {
        if ($produk->image_path && Storage::disk('public')->exists($produk->image_path)) {
            Storage::disk('public')->delete($produk->image_path);
        }

        $produk->delete();

        return back()->with('ok', 'Produk dihapus.');
    }

    /** -----------------------------
     *  Rules validasi terpusat
     *  ----------------------------*/
    private function rules(): array
    {
        return [
            'name'        => ['required','string','max:120'],
            'category_id' => ['required','exists:categories,id'],
            // DB kamu price decimal(10,2) → gunakan numeric di validasi/form
            'price'       => ['required','numeric','min:0'],
            'unit'        => ['required','string','max:30'],
            'description' => ['nullable','string'],
            'is_featured' => ['nullable','boolean'],
            'image'       => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],

            // ===== Field baru: informasi penjual =====
            'owner_name'    => ['nullable','string','max:255'],
            'owner_phone'   => ['nullable','string','max:30'],
            'owner_address' => ['nullable','string','max:2000'],
            'instagram'     => ['nullable','string','max:100'],
        ];
    }
}
