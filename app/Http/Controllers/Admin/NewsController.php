<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => ['required','string','max:255'],
            'content' => ['required','string'],
            'status'  => ['nullable','in:published,draft'],
            'image'   => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('news', 'public');
        }

        $data['status'] = $data['status'] ?? 'draft';

        News::create($data);

        return redirect()->route('admin.news.index')->with('ok', 'Berita berhasil dibuat.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title'   => ['required','string','max:255'],
            'content' => ['required','string'],
            'status'  => ['nullable','in:published,draft'],
            'image'   => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $old = ltrim((string)$news->image_path, '/');
            if (str_starts_with($old, 'public/')) $old = substr($old, 7);
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $data['image_path'] = $request->file('image')->store('news', 'public');
        }

        $data['status'] = $data['status'] ?? 'draft';

        $news->update($data);

        return redirect()->route('admin.news.index')->with('ok', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        $old = ltrim((string)$news->image_path, '/');
        if (str_starts_with($old, 'public/')) $old = substr($old, 7);
        if ($old && Storage::disk('public')->exists($old)) {
            Storage::disk('public')->delete($old);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('ok', 'Berita berhasil dihapus.');
    }
}
