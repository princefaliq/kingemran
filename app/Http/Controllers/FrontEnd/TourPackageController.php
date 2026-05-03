<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    public function packageDetail($slug)
    {
        $package = TourPackage::with([
            'items',
            'itineraries',
            'galleries',
            'testimonials' => function ($q) {
                $q->where('is_active', true);
            }
        ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('frontend.pages.package-detail', compact('package'));
    }
}
