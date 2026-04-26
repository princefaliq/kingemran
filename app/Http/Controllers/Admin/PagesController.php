<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Page::query();

        // 🔎 Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('slug', 'like', '%' . $request->search . '%');
            });
        }

        // 🔀 Sorting
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');

        $allowedSorts = ['id', 'title', 'slug', 'created_at'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $direction = $direction === 'asc' ? 'asc' : 'desc';

        $query->orderBy($sort, $direction);

        return Inertia::render('Admin/Pages/Index', [
            'pages' => $query->paginate(10)->withQueryString(),
            'filters' => [
                'search' => $request->search,
                'sort' => $sort,
                'direction' => $direction,
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Pages/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:pages,slug',
            'content_type' => 'required|in:editor,pdf,editor_pdf',
            'content' => 'nullable',
            'pdf' => 'nullable|file|mimes:pdf|max:2048'
        ]);

        if ($request->hasFile('pdf')) {
            $validated['pdf_path'] = $request->file('pdf')
                ->store('pages/pdf', 'public');
        }

        Page::create($validated);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page created successfully');
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
    public function edit(Page $page)
    {
        return inertia('Admin/Pages/Edit', [
            'page' => $page
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        //dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
            'content_type' => 'required|in:editor,pdf,editor_pdf',
        ]);

        // Kalau upload file baru
        if ($request->hasFile('pdf')) {

            // Hapus file lama
            if ($page->pdf_path && Storage::disk('public')->exists($page->pdf_path)) {
                Storage::disk('public')->delete($page->pdf_path);
            }

            $validated['pdf_path'] = $request->file('pdf')
                ->store('pages', 'public');
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        // Hapus file PDF jika ada
        if ($page->pdf_path && Storage::disk('public')->exists($page->pdf_path)) {
            Storage::disk('public')->delete($page->pdf_path);
        }

        $page->delete(); // soft delete

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}
