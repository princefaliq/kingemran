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
        $subtitle = 'Informasi perjalanan Anda.';
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
            ->where('status', 'published')
            ->where('is_featured', true)
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
        $subtitle = 'Dalam kategori ' . $category->name ;

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
        $subtitle = 'Dengan topik ' . $tag->name;

        return view('frontend.pages.news.index', compact('beritas', 'title','subtitle'));
    }
}
