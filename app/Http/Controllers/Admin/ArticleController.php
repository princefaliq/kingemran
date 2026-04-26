<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleStoreRequest;
use App\Http\Requests\Admin\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Article::query()
            ->with([
                'category:id,name',
                'user:id,name'
            ])
            ->orderBy(
                $request->input('sort','id'),
                $request->input('direction','desc')
            );
        // SEARCH
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search){
                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )
                    ->orWhere(
                        'slug',
                        'like',
                        "%{$search}%"
                    );

            });
        }
        // PAGINATION
        $articles = $query
            ->paginate(10)
            ->withQueryString();
        return Inertia::render(
            'Admin/Articles/Index',
            [
                'articles'=>$articles,
                'filters'=>$request->only(
                    'search',
                    'sort',
                    'direction'
                )
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id','name')
            ->orderBy('name')
            ->get();

        $tags = Tag::select('id','name')
            ->orderBy('name')
            ->get();

        return Inertia::render(
            'Admin/Articles/Create',
            [
                'categories' => $categories,
                'tags' => $tags
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);

        // 🔥 HANDLE UPLOAD
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('articles', 'public');
        }

        $article = Article::create($data);

        $article->tags()->sync($request->tag_ids ?? []);

        return redirect()
            ->route('admin.articles.index')
            ->with('success','Article Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return Inertia::render(
            'Admin/Articles/Edit',[
            'article'=>$article->load('tags'),
            'categories'=>Category::select('id','name')->get(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleStoreRequest $request, Article $article)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['title']);

        // 🔥 HANDLE UPLOAD
        if ($request->hasFile('thumbnail')) {

            // hapus lama
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            // upload baru
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('articles', 'public');
        } else {
            // ❗ penting: jangan ubah thumbnail
            unset($data['thumbnail']);
        }

        $article->update($data);

        $article->tags()->sync($request->tag_ids ?? []);

        return redirect()
            ->route('admin.articles.index')
            ->with('success','Article Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus');
    }
}
