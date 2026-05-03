<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Baner;
use App\Models\Employee;
use App\Models\Gallerie;
use App\Models\Partner;
use App\Models\Service;
use App\Models\SpaProgram;
use App\Models\Testimonial;
use App\Models\TourPackage;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $ip = request()->ip();
        $userAgent = request()->userAgent();

        $hourKey = 'visitor_recorded_' . now()->format('Y-m-d-H');

        if (
            !session()->has($hourKey)
            && !str_contains(strtolower($userAgent), 'bot')
        ) {
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
            ]);

            session([$hourKey => true]);
        }

        $totalVisitors = Visitor::count();

        $todayVisitors = Visitor::whereDate('created_at', today())->count();

        $monthVisitors = Visitor::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $yearVisitors = Visitor::whereYear('created_at', now()->year)->count();


        $banners = Baner::active()
            ->select('id', 'name', 'image','text')
            ->latest()
            ->get();

        $beritas = Article::latest()
            ->select('id', 'title', 'slug', 'thumbnail', 'created_at','category_id')
            ->with('category')
            ->take(3)
            ->get();

        $gallerie = Gallerie::active()->latest()
            ->select('id', 'title', 'type','image','youtube_url')
            ->take(8)
            ->get();


        $testimonials = Testimonial::with('spaProgram')
            ->where('is_active', true)
            ->latest()
            ->get();
        $partners = Partner::where('is_active', true)
            ->latest()
            ->get();
        $packages = TourPackage::withCount([
                'testimonials as reviews_count' => function ($q) {
                    $q->where('is_active', true);
                }
            ])
            ->withAvg([
                'testimonials as avg_rating' => function ($q) {
                    $q->where('is_active', true);
                }
            ], 'rating')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->get();
        return view('frontend.pages.home', compact(
            'banners',
            'beritas',
            'gallerie',
            'monthVisitors',
            'totalVisitors',
            'todayVisitors',
            'yearVisitors',
            'testimonials',
            'partners',
            'packages'
        ));
    }
}
