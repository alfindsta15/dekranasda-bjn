<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Menampilkan daftar semua pesan masuk (dari halaman kontak)
     */
    public function index()
    {
        $messages = Message::latest()->paginate(10); // urut dari terbaru
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Menampilkan detail 1 pesan berdasarkan ID
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Menghapus pesan dari database
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
