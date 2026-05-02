<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Itinerary;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Itinerary::with('tourPackage');

        // 🔍 Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('day', 'like', '%' . $request->search . '%')
                    ->orWhereHas('tourPackage', function ($q2) use ($request) {
                        $q2->where('title', 'like', '%' . $request->search . '%'); // 🔥 pakai title
                    });
            });
        }

        // 🔥 FILTER PACKAGE (INI YANG KURANG)
        if ($request->package) {
            $query->where('tour_package_id', $request->package);
        }

        // 🔃 Sorting
        $sort = $request->get('sort', 'day');
        $direction = $request->get('direction', 'asc');

        $query->orderBy($sort, $direction);

        $itineraries = $query->paginate(10)->withQueryString();

        $packages = TourPackage::select('id', 'title')->get();

        return inertia('Admin/Itineraries/Index', [
            'itineraries' => $itineraries,
            'filters' => $request->only(['search', 'sort', 'direction', 'package']),
            'packages' => $packages,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tourPackages = TourPackage::select('id', 'title')->get();

        return inertia('Admin/Itineraries/Create', [
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
            'day' => ['required', 'integer', 'min:1'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        Itinerary::create($validated);

        return redirect()
            ->route('admin.itineraries.index')
            ->with('success', 'Itinerary berhasil ditambahkan');
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
    public function edit(Itinerary $itinerary)
    {
        $tourPackages = \App\Models\TourPackage::select('id', 'title')->get();

        return inertia('Admin/Itineraries/Edit', [
            'itinerary' => $itinerary,
            'tourPackages' => $tourPackages
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Itinerary $itinerary)
    {
        $validated = $request->validate([
            'tour_package_id' => ['required', 'exists:tour_packages,id'],
            'day' => ['required', 'integer', 'min:1'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $itinerary->update($validated);

        return redirect()
            ->route('admin.itineraries.index')
            ->with('success', 'Itinerary berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Itinerary $itinerary)
    {
        $itinerary->delete();

        return back()->with('success', 'Itinerary berhasil dihapus');
    }
}
