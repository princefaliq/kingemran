<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallerie;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GallerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Gallerie::with('tourPackage');

        // 🔍 SEARCH (by title)
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('package')) {
            if ($request->package === 'global') {
                $query->whereNull('tour_package_id');
            } elseif ($request->package === 'package') {
                $query->whereNotNull('tour_package_id');
            }
        }
        // 🔃 SORTING
        $allowedSorts = ['id', 'title', 'type', 'created_at'];

        $sort = in_array($request->sort, $allowedSorts)
            ? $request->sort
            : 'id';

        $direction = $request->direction === 'asc' ? 'asc' : 'desc';

        $query->orderBy($sort, $direction);

        // 📄 PAGINATION
        $galleries = $query->paginate(10)->withQueryString();

        // 🧾 FORMAT tambahan (optional tapi bagus)
        $galleries->getCollection()->transform(function ($item) {
            $item->created_at_formatted = $item->created_at
                ? $item->created_at->format('d M Y H:i')
                : null;

            return $item;
        });

        return inertia('Admin/Galleries/Index', [
            'galleries' => $galleries,
            'filters' => $request->only(['search', 'sort', 'direction', 'package'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Galleries/Create', [
            'packages' => TourPackage::select('id', 'title')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'nullable|string|max:255',
            'type' => 'required|in:image,youtube',
            'image' => 'required_if:type,image|nullable|image|max:2048',
            'youtube_url' => 'required_if:type,youtube|nullable|url',
            'is_active' => 'boolean',
            'tour_package_id' => ['nullable', 'exists:tour_packages,id'],
        ]);

        $data = $request->only(['title', 'type', 'youtube_url', 'is_active','tour_package_id']);

        // upload image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        Gallerie::create($data);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery created successfully');
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
    public function edit(Gallerie $gallery)
    {
        return inertia('Admin/Galleries/Edit', [
            'gallery' => $gallery,
            'packages' => TourPackage::select('id', 'title')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallerie $gallery)
    {
// ✅ VALIDASI
        $request->validate([
            'title' => 'nullable|string|max:255',
            'type' => 'required|in:image,youtube',

            'image' => 'nullable|image|max:2048',
            'youtube_url' => 'nullable|url',
            'tour_package_id' => ['nullable', 'exists:tour_packages,id'],
            'is_active' => 'boolean'
        ]);

        // ======================================
        // HANDLE IMAGE
        // ======================================

        if ($request->type === 'image') {

            // kalau upload image baru
            if ($request->hasFile('image')) {

                // hapus image lama
                if ($gallery->image) {
                    Storage::disk('public')->delete($gallery->image);
                }

                // simpan baru
                $path = $request->file('image')->store('galleries', 'public');

                $gallery->image = $path;
            }

            // kosongkan youtube
            $gallery->youtube_url = null;

        } else {
            // ======================================
            // HANDLE YOUTUBE
            // ======================================

            // kalau sebelumnya image → hapus file
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }

            $gallery->image = null;
            $gallery->youtube_url = $request->youtube_url;
        }

        // ======================================
        // UPDATE FIELD LAIN
        // ======================================

        $gallery->title = $request->title;
        $gallery->tour_package_id = $request->tour_package_id;
        $gallery->type = $request->type;
        $gallery->is_active = $request->is_active ?? false;

        $gallery->save();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallerie $gallery)
    {
        // hapus file jika type image
        if ($gallery->type === 'image' && $gallery->image) {

            if (Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
        }

        // hapus data
        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery berhasil dihapus');
    }
}
