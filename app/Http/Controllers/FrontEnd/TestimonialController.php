<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\SpaProgram;
use App\Models\Testimonial;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Storage;

class TestimonialController extends Controller
{
    public function create()
    {
        $packages = TourPackage::where('is_active', true)
            ->orderBy('title')
            ->get();

        return view('frontend.pages.testimoni.create', compact('packages'));
    }


    public function store(Request $request)
    {
        // ✅ Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tour_package_id' => 'nullable|exists:tour_packages,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|string', // base64
        ]);

        // ✅ Default data
        $data = [
            'name' => $validated['name'],
            'tour_package_id' => $validated['tour_package_id'] ?? null,
            'content' => $validated['content'],
            'rating' => $validated['rating'],
            'is_active' => false, // wajib review admin dulu
        ];

        // ✅ Handle image base64 dari cropper
        if (!empty($validated['image'])) {
            $image = $validated['image'];

            // Bersihkan prefix base64
            if (str_contains($image, 'base64,')) {
                $image = explode('base64,', $image)[1];
            }

            $image = str_replace(' ', '+', $image);

            $imageName = 'testimonials/' . uniqid() . '.jpg';

            Storage::disk('public')->put($imageName, base64_decode($image));

            $data['image'] = $imageName;
        }

        // ✅ Simpan ke database
        Testimonial::create($data);

        // ✅ Redirect
        return redirect()
            ->route('testimonials.create')
            ->with('success', 'Testimoni berhasil dikirim dan sedang menunggu persetujuan.');
    }
}
