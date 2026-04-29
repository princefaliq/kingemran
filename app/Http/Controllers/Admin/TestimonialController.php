<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestimonialController extends Controller
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

        $testimonials = Testimonial::with('spaProgram')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('spaProgram', function ($q) use ($search) {
                        $q->where('nama_paket', 'like', "%{$search}%");
                    });
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'content' => $item->content,
                'is_active' => $item->is_active,
                'created_at' => $item->created_at,
                'created_at_formatted' => $item->created_at?->format('d M Y H:i'),
                'spa_program' => $item->spaProgram ? [
                    'id' => $item->spaProgram->id,
                    'nama_paket' => $item->spaProgram->nama_paket,
                ] : null,
            ]);

        return Inertia::render('Admin/Testimonial/Index', [
            'testimonials' => $testimonials,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function updateStatus(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'is_active' => 'required|boolean',
        ]);

        $testimonial->update([
            'is_active' => $request->is_active,
        ]);

        return back()->with('success', 'Status testimoni berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return back()->with('success', 'Testimoni berhasil dihapus.');
    }
}
