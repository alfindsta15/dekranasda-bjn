<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Binaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BinaanController extends Controller
{
    public function index()
    {
        $binaan = Binaan::latest('id')->paginate(12);
        return view('admin.binaan.index', compact('binaan'));
    }

    public function create()
    {
        return view('admin.binaan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image'     => ['nullable','image','max:2048'],
            'name'      => ['required','string','max:255'],
            'address'   => ['required','string','max:255'],
            'phone'     => ['required','string','max:50'],
            'email'     => ['nullable','email','max:255'],
            'instagram' => ['nullable','string','max:255'],
            'facebook'  => ['nullable','string','max:255'],
            'status'    => ['required','in:aktif,nonaktif'],
            'brand'     => ['nullable','string','max:255'],
        ]);

        // simpan gambar jika diupload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('binaan', 'public');
        }

        Binaan::create($data);

        return redirect()->route('admin.binaan.index')->with('ok','Data binaan berhasil ditambahkan.');
    }

    public function edit(Binaan $binaan)
    {
        return view('admin.binaan.edit', compact('binaan'));
    }

    public function update(Request $request, Binaan $binaan)
    {
        $data = $request->validate([
            'image'        => ['nullable','image','max:2048'],
            'name'         => ['required','string','max:255'],
            'address'      => ['required','string','max:255'],
            'phone'        => ['required','string','max:50'],
            'email'        => ['nullable','email','max:255'],
            'instagram'    => ['nullable','string','max:255'],
            'facebook'     => ['nullable','string','max:255'],
            'status'       => ['required','in:aktif,nonaktif'],
            'brand'        => ['nullable','string','max:255'],
            'remove_image' => ['nullable','boolean'],
        ]);

        // hapus gambar lama jika dicentang
        if ($request->boolean('remove_image') && $binaan->image) {
            Storage::disk('public')->delete($binaan->image);
            $data['image'] = null;
        }

        // ganti gambar jika upload baru
        if ($request->hasFile('image')) {
            if ($binaan->image) {
                Storage::disk('public')->delete($binaan->image);
            }
            $data['image'] = $request->file('image')->store("binaan/{$binaan->id}", 'public');
        }

        $binaan->update($data);

        return redirect()->route('admin.binaan.index')->with('ok','Data binaan diperbarui.');
    }

    public function destroy(Binaan $binaan)
    {
        if ($binaan->image) {
            Storage::disk('public')->delete($binaan->image);
        }
        $binaan->delete();

        return back()->with('ok','Data binaan dihapus.');
    }
}
