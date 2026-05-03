<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class TourPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->sort ?? 'id';
        $direction = $request->direction ?? 'desc';

        $allowedSorts = ['id', 'title', 'price', 'created_at'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $packages = TourPackage::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('departure_city', 'like', "%{$search}%");
                });
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'duration' => $item->duration,
                'duration_type' => $item->duration_type,
                'price' => $item->price,
                'price_discount' => $item->price_discount,
                'currency' => $item->currency,
                'location' => $item->location,
                'is_featured' => $item->is_featured,
                'is_active' => $item->is_active,

                'thumbnail_url' => $item->thumbnail
                    ? asset('storage/' . $item->thumbnail)
                    : null,

                'created_at' => $item->created_at,
                'created_at_formatted' => $item->created_at?->format('d M Y H:i'),
            ]);

        return Inertia::render('Admin/TourPackages/Index', [
            'packages' => $packages,
            'filters' => [
                'search' => $search,
                'sort' => $sort,
                'direction' => $direction,
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/TourPackages/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            // ✅ VALIDASI
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

                'duration' => 'required|integer|min:1',
                'duration_type' => 'required|in:days,nights',

                'price' => 'required|numeric|min:0',
                'price_discount' => 'nullable|numeric|min:0',
                'currency' => 'required|in:IDR,USD,SAR',
                'location' => 'nullable|string|max:255',
                'departure_city' => 'nullable|string|max:255',

                'departure_date' => 'nullable|date',

                'airline' => 'nullable|string|max:255',
                'hotel' => 'nullable|string|max:255',

                'quota' => 'nullable|integer|min:1',

                'short_description' => 'nullable|string|max:500',
                'description' => 'nullable|string',

                'is_featured' => 'boolean',
                'is_active' => 'boolean',

                // 🔥 TAMBAHKAN INI
                'items' => 'nullable|array',
                'items.*.type' => 'nullable|string',
                'items.*.name' => 'nullable|string',

                'itineraries' => 'nullable|array',
                'itineraries.*.day' => 'nullable|integer|min:1',
                'itineraries.*.title' => 'nullable|string',
                'itineraries.*.description' => 'nullable|string',
            ]);
            // ✅ SLUG AUTO (UNIQUE)
            $slug = Str::slug($validated['title']);
            $originalSlug = $slug;
            $count = 1;

            while (TourPackage::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $validated['slug'] = $slug;

            // ✅ HANDLE CHECKBOX (biar tidak null)
            $validated['is_featured'] = $request->boolean('is_featured');
            $validated['is_active'] = $request->boolean('is_active', true);

            // ✅ UPLOAD THUMBNAIL
            if ($request->hasFile('thumbnail')) {
                $validated['thumbnail'] = $request->file('thumbnail')
                    ->store('tour-packages', 'public');
            }

            // ✅ SIMPAN
            $package =TourPackage::create($validated);

            // 🔥 ITEMS (FILTER)
            collect($validated['items'] ?? [])
                ->filter(fn ($item) => !empty($item['name']))
                ->each(function ($item) use ($package) {
                    $package->items()->create([
                        'type' => $item['type'] ?? 'include',
                        'name' => $item['name'],
                    ]);
                });


            /// 🔥 ITINERARIES (FILTER + AUTO DAY)
            collect($validated['itineraries'] ?? [])
                ->filter(fn ($i) => !empty($i['title']))
                ->values()
                ->each(function ($itinerary, $index) use ($package) {
                    $package->itineraries()->create([
                        'day' => $itinerary['day'] ?? ($index + 1),
                        'title' => $itinerary['title'],
                        'description' => $itinerary['description'] ?? null,
                    ]);
                });
        });
        return redirect()
            ->route('admin.tour-packages.index')
            ->with('success', 'Package berhasil ditambahkan.');
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
    public function edit(TourPackage $tourPackage)
    {
        $tourPackage->load(['items', 'itineraries']);

        return Inertia::render('Admin/TourPackages/Edit', [
            'package' => [
                'id' => $tourPackage->id,
                'title' => $tourPackage->title,
                'duration' => $tourPackage->duration,
                'duration_type' => $tourPackage->duration_type,
                'price' => $tourPackage->price,
                'price_discount' => $tourPackage->price_discount,
                'currency' => $tourPackage->currency,
                'location' => $tourPackage->location,
                'departure_city' => $tourPackage->departure_city,
                'departure_date' => $tourPackage->departure_date,
                'airline' => $tourPackage->airline,
                'hotel' => $tourPackage->hotel,
                'quota' => $tourPackage->quota,
                'short_description' => $tourPackage->short_description,
                'description' => $tourPackage->description,
                'is_featured' => $tourPackage->is_featured,
                'is_active' => $tourPackage->is_active,
                'thumbnail_url' => $tourPackage->thumbnail
                    ? asset('storage/' . $tourPackage->thumbnail)
                    : null,

                // 🔥 WAJIB TAMBAHKAN INI
                'items' => $tourPackage->items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'type' => $item->type,
                        'name' => $item->name,
                    ];
                }),

                'itineraries' => $tourPackage->itineraries->map(function ($itinerary) {
                    return [
                        'id' => $itinerary->id,
                        'day' => $itinerary->day,
                        'title' => $itinerary->title,
                        'description' => $itinerary->description,
                    ];
                }),
            ]
        ]);
    }

    public function update(Request $request, TourPackage $tourPackage)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|integer',
            'duration_type' => 'required|string',
            'price' => 'required|numeric',
            'price_discount' => 'nullable|numeric',
            'currency' => 'required|in:IDR,USD,SAR',
            'location' => 'nullable|string',
            'departure_city' => 'nullable|string',
            'departure_date' => 'nullable|date',
            'airline' => 'nullable|string',
            'hotel' => 'nullable|string',
            'quota' => 'nullable|integer',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'thumbnail' => 'nullable|image|max:2048',

            // 🔥 RELASI
            'items' => 'nullable|array',
            'items.*.type' => 'nullable|string',
            'items.*.name' => 'nullable|string',

            'itineraries' => 'nullable|array',
            'itineraries.*.day' => 'nullable|integer|min:1',
            'itineraries.*.title' => 'nullable|string',
            'itineraries.*.description' => 'nullable|string',
        ]);

        /* =========================
           THUMBNAIL
        ========================= */
        unset($data['thumbnail']);

        if ($request->hasFile('thumbnail')) {

            if ($tourPackage->thumbnail && Storage::disk('public')->exists($tourPackage->thumbnail)) {
                Storage::disk('public')->delete($tourPackage->thumbnail);
            }

            $data['thumbnail'] = $request->file('thumbnail')->store('packages', 'public');
        }

        /* =========================
       UPDATE PACKAGE
    ========================= */
        $tourPackage->update($data);

        /* =========================
           RESET ITEMS
        ========================= */
        $tourPackage->items()->delete();

        collect($data['items'] ?? [])
            ->filter(fn ($item) => !empty($item['name']))
            ->each(function ($item) use ($tourPackage) {
                $tourPackage->items()->create([
                    'type' => $item['type'] ?? 'include',
                    'name' => $item['name'],
                ]);
            });

        /* =========================
      RESET ITINERARIES
   ========================= */
        $tourPackage->itineraries()->delete();

        collect($data['itineraries'] ?? [])
            ->filter(fn ($i) => !empty($i['title']))
            ->values()
            ->each(function ($itinerary, $index) use ($tourPackage) {
                $tourPackage->itineraries()->create([
                    // 🔥 auto rapikan day
                    'day' => $itinerary['day'] ?? ($index + 1),
                    'title' => $itinerary['title'],
                    'description' => $itinerary['description'] ?? null,
                ]);
            });

        return redirect()->route('admin.tour-packages.index')
            ->with('success', 'Package berhasil diupdate');
    }
    public function updateStatus(Request $request, TourPackage $tourPackage)
    {
        $request->validate([
            'is_active' => 'required|boolean',
        ]);

        $tourPackage->update([
            'is_active' => $request->is_active,
        ]);

        return back()->with('success', 'Status package berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourPackage $tourPackage)
    {
        DB::transaction(function () use ($tourPackage) {

            // 🔥 hapus relasi dulu (biar aman walau tanpa cascade)
            $tourPackage->items()->delete();
            $tourPackage->itineraries()->delete();

            // 🔥 hapus package
            $tourPackage->delete();
        });

        return back()->with('success', 'Tour Package berhasil dihapus');
    }
}
