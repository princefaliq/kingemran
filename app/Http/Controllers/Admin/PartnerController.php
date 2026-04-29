<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->sort ?? 'id';
        $direction = $request->direction ?? 'desc';

        $allowedSorts = ['id', 'name', 'created_at', 'is_active'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $partners = Partner::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('url', 'like', "%{$search}%");
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'logo' => $item->logo,
                'logo_url' => $item->logo ? asset('storage/' . $item->logo) : null,
                'url' => $item->url,
                'is_active' => $item->is_active,
                'created_at' => $item->created_at,
                'created_at_formatted' => $item->created_at?->format('d M Y H:i'),
            ]);

        return Inertia::render('Admin/Partners/Index', [
            'partners' => $partners,
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

        return Inertia::render('Admin/Partners/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'logo' => 'required|image|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('partners', 'public');
        }

        Partner::create([
            'name' => $validated['name'],
            'url' => $validated['url'] ?? null,
            'logo' => $logoPath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil ditambahkan.');
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
    public function edit(Partner $partner)
    {
        return Inertia::render('Admin/Partners/Edit', [
            'partner' => [
                'id' => $partner->id,
                'name' => $partner->name,
                'url' => $partner->url,
                'logo' => $partner->logo,
                'logo_url' => $partner->logo ? asset('storage/' . $partner->logo) : null,
                'is_active' => $partner->is_active,
            ]
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
            'remove_logo' => 'nullable|boolean',
        ]);

        $logoPath = $partner->logo;

        if ($request->boolean('remove_logo')) {
            if ($partner->logo && \Storage::disk('public')->exists($partner->logo)) {
                \Storage::disk('public')->delete($partner->logo);
            }

            $logoPath = null;
        }

        if ($request->hasFile('logo')) {
            if ($partner->logo && \Storage::disk('public')->exists($partner->logo)) {
                \Storage::disk('public')->delete($partner->logo);
            }

            $logoPath = $request->file('logo')->store('partners', 'public');
        }

        $partner->update([
            'name' => $validated['name'],
            'url' => $validated['url'] ?? null,
            'logo' => $logoPath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil diperbarui.');
    }
    public function updateStatus(Request $request, Partner $partner)
    {
        $request->validate([
            'is_active' => 'required|boolean',
        ]);

        $partner->update([
            'is_active' => $request->is_active,
        ]);

        return back()->with('success', 'Status partner berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return back()->with('success', 'Partner berhasil dihapus.');
    }
}
