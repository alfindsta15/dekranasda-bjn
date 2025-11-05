<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Organisasi; // <-- penting
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    // Halaman Visi & Misi (tanpa struktur)
    public function visiMisi()
    {
        return view('profil.visi-misi');
    }

    // Halaman Struktur Organisasi (dinamis)
    public function strukturOrganisasi()
    {
        $members = Organisasi::orderBy('order')->orderByDesc('id')->get();
        return view('profil.struktur', compact('members'));
    }

    public function berita()
    {
        $beritas = News::latest()->paginate(9);
        $message = $beritas->isEmpty() ? 'Belum ada berita yang tersedia.' : null;
        return view('berita.index', compact('beritas', 'message'));
    }

    public function detail($id)
    {
        $news = News::findOrFail($id);
        return view('berita.detail', compact('news'));
    }
}
