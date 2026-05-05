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

        return view('frontend.pages.package.show', compact('package'));
    }
    public function index(Request $request)
    {
        $query = TourPackage::withCount([
            'testimonials as reviews_count' => function ($q) {
                $q->where('is_active', true);
            }
        ])
            ->withAvg([
                'testimonials as rating_avg' => function ($q) {
                    $q->where('is_active', true);
                }
            ], 'rating')
            ->where('is_active', true);

        // CATEGORY
        if ($request->category) {
            $query->where('category', $request->category);
        }

        // MONTH
        if ($request->month) {
            $query->whereMonth('departure_date', $request->month);
        }

        // YEAR
        if ($request->year) {
            $query->whereYear('departure_date', $request->year);
        }

        $packages = $query->latest()->paginate(6)->withQueryString();
        return view('frontend.pages.package.index', compact('packages'));
    }
}
