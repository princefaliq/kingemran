<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::query();

        // 🔍 SEARCH (by name & position)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // 🔃 SORTING
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');

        // whitelist biar aman
        $allowedSorts = ['id', 'name', 'position', 'created_at'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $query->orderBy($sort, $direction);

        // 📄 PAGINATION
        $employees = $query->paginate(10)->withQueryString();

        return Inertia::render('Admin/Employees/Index', [
            'employees' => $employees,
            'filters' => $request->only(['search', 'sort', 'direction']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Employees/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ VALIDATION
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'boolean'
        ]);

        // ✅ HANDLE UPLOAD FOTO
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            // nama file unik
            $filename = 'employees/' . Str::uuid() . '.' . $file->getClientOriginalExtension();

            Storage::disk('public')->put($filename, file_get_contents($file));

            $validated['photo'] = $filename;
        }

        // ✅ DEFAULT VALUE (biar aman kalau checkbox tidak terkirim)
        $validated['is_active'] = $request->boolean('is_active');

        // ✅ SIMPAN
        Employee::create($validated);

        // ✅ REDIRECT
        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Data pegawai berhasil ditambahkan');
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
    public function edit(Employee $employee)
    {
        return Inertia::render('Admin/Employees/Edit', [
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        /* =========================
        VALIDATION
        ========================= */
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'required|boolean',
        ]);

        /* =========================
        HANDLE PHOTO
        ========================= */
        if ($request->hasFile('photo')) {

            // hapus foto lama
            if ($employee->photo && Storage::disk('public')->exists($employee->photo)) {
                Storage::disk('public')->delete($employee->photo);
            }

            // simpan foto baru
            $path = $request->file('photo')->store('employees', 'public');
            $validated['photo'] = $path;
        }else {
            // ⭐ ini yang bikin foto tidak hilang
            unset($validated['photo']);
        }

        /* =========================
        UPDATE DATA
        ========================= */
        $employee->update($validated);

        /* =========================
        REDIRECT
        ========================= */
        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // ✅ HAPUS FILE FOTO (kalau ada)
        if ($employee->photo && Storage::disk('public')->exists($employee->photo)) {
            Storage::disk('public')->delete($employee->photo);
        }

        // ✅ HAPUS DATA
        $employee->delete();

        // ✅ REDIRECT
        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Data pegawai berhasil dihapus');
    }
}
