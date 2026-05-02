<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageItem;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class PackageItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PackageItem::with('tourPackage');

        // 🔍 Search
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🔃 Sorting
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
    // 🔥 FILTER PACKAGE
        if ($request->package) {
            $query->where('tour_package_id', $request->package);
        }
        $query->orderBy($sort, $direction);

        $packageItems = $query->paginate(10)->withQueryString();
        $packages = TourPackage::select('id', 'title')->get();
        return inertia('Admin/PackageItems/Index', [
            'packageItems' => $packageItems,
            'filters' => $request->only(['search', 'sort', 'direction']),
            'packages' => $packages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tourPackages = TourPackage::select('id', 'title')->get();

        return inertia('Admin/PackageItems/Create', [
            'tourPackages' => $tourPackages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_package_id' => ['required', 'exists:tour_packages,id'],
            'type' => ['required', 'in:include,exclude'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        PackageItem::create($validated);

        return redirect()
            ->route('admin.package-items.index')
            ->with('success', 'Item berhasil ditambahkan');
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
    public function edit(PackageItem $packageItem)
    {
        $tourPackages = TourPackage::select('id', 'name')->get();

        return inertia('Admin/PackageItems/Edit', [
            'packageItem' => $packageItem,
            'tourPackages' => $tourPackages,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PackageItem $packageItem)
    {
        $validated = $request->validate([
            'tour_package_id' => ['required', 'exists:tour_packages,id'],
            'type' => ['required', 'in:include,exclude'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $packageItem->update($validated);

        return redirect()
            ->route('admin.package-items.index')
            ->with('success', 'Item berhasil diupdate');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageItem $packageItem)
    {
        $packageItem->delete();

        return redirect()
            ->route('admin.package-items.index')
            ->with('success', 'Item berhasil dihapus');
    }
}
