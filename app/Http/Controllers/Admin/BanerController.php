<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Baner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use function Termwind\render;

class BanerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Baner::query()
            ->orderBy(
                $request->input('sort', 'id'),
                $request->input('direction', 'desc')
            );

        // Search
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('text', 'like', "%{$search}%");
            });
        }
        // ✅ Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        // Pagination
        $banners = $query->paginate(10)->withQueryString();

        return Inertia::render('Admin/Baner/Index', [
            'banners' => $banners,
            'filters' => $request->only('search', 'sort', 'direction', 'status'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Baner/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'text' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        // ✅ Upload Image
        $path = null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
        }

        // ✅ Simpan ke database
        Baner::create([
            'name' => $validated['name'],
            'image' => $path,
            'text' => $validated['text'] ?? null,
            'status' => $validated['status'],
        ]);

        // ✅ Redirect
        return redirect()
            ->route('admin.baner.index')
            ->with('success', 'Banner berhasil ditambahkan');
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
    public function edit(string $id)
    {
        $banner = Baner::findOrFail($id);

        return inertia('Admin/Baner/Edit', [
            'banner' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Baner::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
            'remove_image' => 'nullable|boolean',
        ]);

        /* =========================
        HANDLE REMOVE IMAGE
        ========================= */
        if ($request->remove_image) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $banner->image = null;
        }

        /* =========================
        HANDLE UPLOAD IMAGE BARU
        ========================= */
        if ($request->hasFile('image')) {

            // hapus lama
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $banner->image = $request->file('image')->store('banners', 'public');
        }

        /* =========================
        UPDATE DATA
        ========================= */
        $banner->update([
            'name' => $validated['name'],
            'text' => $validated['text'],
            'status' => $validated['status'],
            'image' => $banner->image
        ]);

        return redirect()
            ->route('admin.baner.index')
            ->with('success', 'Banner berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Baner::findOrFail($id);

        // ✅ Hapus file gambar jika ada
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        // ✅ Hapus data
        $banner->delete();

        return redirect()
            ->route('admin.baner.index')
            ->with('success', 'Banner berhasil dihapus');
    }
}
