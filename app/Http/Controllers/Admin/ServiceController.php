<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $services = Service::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('subtitle', 'like', "%{$search}%");
                });
            })
            ->orderBy(
                $request->get('sort', 'created_at'),
                $request->get('direction', 'desc')
            )
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Services/Index', [
            'services' => $services,
            'filters' => $request->only(['search', 'sort', 'direction']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Services/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|max:2048',
            'icon' => 'nullable|image|mimes:png|max:1024',
            'is_active' => 'boolean',
        ]);

        $imagePath = $request->file('image')->store('services/images', 'public');

        $iconPath = null;
        if ($request->hasFile('icon')) {

            $manager = new ImageManager(new Driver());

            $image = $manager->read($request->file('icon'))
                ->scale(200, 200) // resize
                ->toPng(); // convert ke PNG

            $filename = 'services/icons/' . Str::uuid() . '.png';

            Storage::disk('public')->put($filename, $image);

            $iconPath = $filename;
        }

        Service::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $imagePath,
            'icon' => $iconPath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service created successfully');
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
    public function edit(Service $service)
    {
        return Inertia::render('Admin/Services/Edit', [
            'service' => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'icon' => 'nullable|image|max:1024',
            'is_active' => 'boolean',
        ]);

        // IMAGE
        if ($request->hasFile('image')) {

            // hapus lama
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            $service->image = $request->file('image')
                ->store('services/images', 'public');
        }

        // ICON
        if ($request->hasFile('icon')) {

            if ($service->icon) {
                Storage::disk('public')->delete($service->icon);
            }

            $service->icon = $request->file('icon')
                ->store('services/icons', 'public');
        }

        $service->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service berhasil updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // hapus gambar 1
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        // hapus gambar 2
        if ($service->icon && Storage::disk('public')->exists($service->icon)) {
            Storage::disk('public')->delete($service->icon);
        }

        // hapus data
        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service berhasil dihapus');
    }
}
