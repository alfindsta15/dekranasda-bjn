<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganisasiController extends Controller
{
    public function index()
    {
        $members = Organisasi::orderBy('order')->orderByDesc('id')->get();
        return view('admin.organisasi.index', compact('members'));
    }

    // Dipanggil oleh route admin.organisasi.create
    // Tujuannya hanya redirect ke index dan membuka modal tambah
    public function create()
    {
        return redirect()
            ->route('admin.organisasi.index')
            ->with('showCreateModal', true);
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name'        => ['required','string','max:255'],
            'position'    => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'order'       => ['nullable','integer','min:0'],
            'photo'       => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        if ($r->hasFile('photo')) {
            $data['photo_path'] = $r->file('photo')->store('org', 'public');
        }
        $data['order'] = $data['order'] ?? 0;

        Organisasi::create($data);
        return back()->with('ok','Anggota ditambahkan.');
    }

    public function update(Request $r, Organisasi $organisasi)
    {
        $data = $r->validate([
            'name'        => ['required','string','max:255'],
            'position'    => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'order'       => ['nullable','integer','min:0'],
            'photo'       => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        if ($r->hasFile('photo')) {
            if ($organisasi->photo_path && Storage::disk('public')->exists($organisasi->photo_path)) {
                Storage::disk('public')->delete($organisasi->photo_path);
            }
            $data['photo_path'] = $r->file('photo')->store('org', 'public');
        }
        $data['order'] = $data['order'] ?? $organisasi->order;

        $organisasi->update($data);
        return back()->with('ok','Perubahan disimpan.');
    }

    public function destroy(Organisasi $organisasi)
    {
        if ($organisasi->photo_path && Storage::disk('public')->exists($organisasi->photo_path)) {
            Storage::disk('public')->delete($organisasi->photo_path);
        }
        $organisasi->delete();
        return back()->with('ok','Anggota dihapus.');
    }
}
