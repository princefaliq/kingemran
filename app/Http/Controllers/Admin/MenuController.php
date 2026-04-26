<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MenuItem::query()
            ->whereNull('parent_id')
            ->with(['children', 'page'])
            ->orderBy('order', 'asc');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('link', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $menus = $query->paginate(10)->withQueryString();

        return Inertia::render('Admin/Menu/Index', [
            'menus' => $menus,
            'filters' => request()->only(['search', 'type'])
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Menu/Create', [
            'pages' => Page::select('id', 'title')->orderBy('title')->get(),
            'parents' => MenuItem::select('id', 'name')->orderBy('order')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:page,url,route,group',
            'page_id' => 'nullable|exists:pages,id',
            'link' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menu_items,id',
        ]);
        $lastOrder = MenuItem::where('parent_id', $validated['parent_id'])
            ->max('order');

        $validated['order'] = $lastOrder ? $lastOrder + 1 : 1;
        MenuItem::create($validated);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu created successfully');
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
    public function edit(MenuItem $menu)
    {
        return Inertia::render('Admin/Menu/Edit', [
            'menu' => $menu->load('parent'),
            'pages' => Page::select('id', 'title')->orderBy('title')->get(),
            'parents' => MenuItem::where('id', '!=', $menu->id)
                ->orderBy('order')
                ->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuItem $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:page,url,route,group',
            'page_id' => 'nullable|exists:pages,id',
            'link' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menu_items,id',
        ]);

        $menu->update($validated);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu updated successfully');
    }
    public function reorder()
    {
        $menus = MenuItem::whereNull('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();

        return Inertia::render('Admin/Menu/Reorder', [
            'menus' => $menus
        ]);
    }

    public function saveOrder(Request $request)
    {
        foreach ($request->menus as $index => $menu) {

            MenuItem::where('id', $menu['id'])
                ->update([
                    'order' => $index + 1,
                    'parent_id' => null
                ]);

            if (!empty($menu['children'])) {
                foreach ($menu['children'] as $childIndex => $child) {

                    MenuItem::where('id', $child['id'])
                        ->update([
                            'order' => $childIndex + 1,
                            'parent_id' => $menu['id']
                        ]);
                }
            }
        }

        return redirect()
            ->route('admin.menu.index')->with('success', 'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menu)
    {
        if ($menu->children()->exists()) {
            return back()->with('error', 'Menu has sub-items. Delete them first.');
        }
        $menu->delete();

        return redirect()
            ->route('admin.menu.index')
            ->with('success', 'Menu deleted successfully');
    }
}
