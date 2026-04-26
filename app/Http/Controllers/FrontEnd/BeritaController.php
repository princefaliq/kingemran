<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Article::with(['category', 'tags', 'user'])
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        $title = 'Semua Berita';
        $subtitle = 'Kumpulan berita terbaru, informasi terkini, dan artikel menarik yang dapat menambah wawasan Anda.';
        return view('frontend.pages.news.index', compact('beritas', 'title','subtitle'));
    }
    public function show($slug)
    {
        $berita = Article::with(['category', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        // berita terkait (opsional)
        $related = Article::where('category_id', $berita->category_id)
            ->where('id', '!=', $berita->id)
            ->latest()
            ->take(4)
            ->get();
        $categories = Category::whereNull('parent_id') // hanya parent
        ->with('children') // kalau mau child juga
        ->get();
        $tags = Tag::withCount('articles') // optional: hitung jumlah berita
        ->latest()
        ->get();

        return view('frontend.pages.news.show', compact('berita', 'related','categories','tags'));
    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $beritas = Article::with(['category', 'tags', 'user'])
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        $title = 'Kategori: ' . $category->name;
        $subtitle = 'Berita dalam kategori ' . $category->name . ' yang telah kami kurasi untuk Anda.';

        return view('frontend.pages.news.index', compact('beritas', 'title','subtitle'));
    }
    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $beritas = Article::with(['category', 'tags', 'user'])
            ->whereHas('tags', function ($q) use ($tag) {
                $q->where('tags.id', $tag->id);
            })
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        $title = 'Tag: ' . $tag->name;
        $subtitle = 'Kumpulan artikel dengan topik ' . $tag->name . ' yang sedang dibahas.';

        return view('frontend.pages.news.index', compact('beritas', 'title','subtitle'));
    }
}
