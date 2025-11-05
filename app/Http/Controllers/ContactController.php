<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function showForm()
    {
        $socials = [
            [
                'icon'  => 'instagram',
                'label' => 'Instagram',
                'url'   => 'https://www.instagram.com/dekranasda.bojonegoro',
            ],
            [
                'icon'  => 'youtube',
                'label' => 'Youtube Pemkab Bojonegoro',
                'url'   => 'https://youtube.com/@pemkabbojonegoro1589',
            ],
        ];

        return view('pages.kontak', compact('socials'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'body'  => ['required', 'string', 'max:2000'],
        ]);

        Message::create($data);

        return back()->with('success', 'Pesan kamu sudah terkirim. Terima kasih!');
    }
}
