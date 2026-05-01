<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all()
            ->map(fn($s) => [
                'key' => $s->key,
                'value' => $s->value
            ]);

        return inertia('Admin/Settings/Index', [
            'settings' => $settings
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
    public function edit()
    {
        return inertia('Admin/Settings/Edit', [
            'settings' => [
                'motto' => Setting::get('motto'),
                'about' => Setting::get('about'),

                'about_image_1' => Setting::get('about_image_1'),
                'about_image_2' => Setting::get('about_image_2'),

                'kontak_telepon' => Setting::get('kontak_telepon'),
                'kontak_email' => Setting::get('kontak_email'),
                'kontak_alamat' => Setting::get('kontak_alamat'),

                'sosmed_facebook' => Setting::get('sosmed_facebook'),
                'sosmed_instagram' => Setting::get('sosmed_instagram'),
                'sosmed_youtube' => Setting::get('sosmed_youtube'),
                'sosmed_tiktok' => Setting::get('sosmed_tiktok'),

                'jam_kerja' => Setting::get('jam_kerja'),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'motto' => 'required|string|max:255',
            'about' => 'nullable|string',
            'jam_kerja' => 'nullable|string|max:255',

            'about_image_1' => 'nullable|image|max:2048',
            'about_image_2' => 'nullable|image|max:2048',

            'remove_about_image_1' => 'nullable|boolean',
            'remove_about_image_2' => 'nullable|boolean',
        ]);

        /* =========================
        HANDLE FOTO SPA 1
        ========================= */
        $oldFoto1 = Setting::get('about_image_1');

        if ($request->remove_about_image_1) {
            if ($oldFoto1 && Storage::disk('public')->exists($oldFoto1)) {
                Storage::disk('public')->delete($oldFoto1);
            }

            Setting::set('about_image_1', null);
        }

        if ($request->hasFile('about_image_1')) {

            if ($oldFoto1 && Storage::disk('public')->exists($oldFoto1)) {
                Storage::disk('public')->delete($oldFoto1);
            }

            $path1 = $request->file('about_image_1')->store('spa', 'public');

            Setting::set('about_image_1', $path1);
        }

        /* =========================
        HANDLE FOTO SPA 2
        ========================= */
        $oldFoto2 = Setting::get('about_image_2');

        if ($request->remove_about_image_2) {
            if ($oldFoto2 && Storage::disk('public')->exists($oldFoto2)) {
                Storage::disk('public')->delete($oldFoto2);
            }

            Setting::set('about_image_2', null);
        }

        if ($request->hasFile('about_image_2')) {

            if ($oldFoto2 && Storage::disk('public')->exists($oldFoto2)) {
                Storage::disk('public')->delete($oldFoto2);
            }

            $path2 = $request->file('about_image_2')->store('spa', 'public');

            Setting::set('about_image_2', $path2);
        }

        /* =========================
        SAVE TEXT SETTING
        ========================= */
        Setting::set('motto', $request->motto);
        Setting::set('about', $request->about);

        Setting::set('kontak_telepon', $request->kontak_telepon);
        Setting::set('kontak_email', $request->kontak_email);
        Setting::set('kontak_alamat', $request->kontak_alamat);

        Setting::set('sosmed_facebook', $request->sosmed_facebook);
        Setting::set('sosmed_instagram', $request->sosmed_instagram);
        Setting::set('sosmed_youtube', $request->sosmed_youtube);
        Setting::set('sosmed_tiktok', $request->sosmed_tiktok);

        Setting::set('jam_kerja', $request->jam_kerja);

        return redirect()->back()->with('success', 'Settings berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
