<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Baner;
use App\Models\Employee;
use App\Models\Gallerie;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $ip = request()->ip();
        $userAgent = request()->userAgent();

        if (
            !Visitor::where('ip_address', $ip)
                ->whereDate('created_at', today())
                ->exists()
            && !str_contains(strtolower($userAgent), 'bot')
        ) {
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
            ]);
        }

        $totalVisitors = Cache::remember('total_visitors', 300, fn() => Visitor::count());

        $todayVisitors = Cache::remember('today_visitors', 300, fn() =>
        Visitor::whereDate('created_at', today())->count()
        );

        $activeVisitors = Visitor::where('created_at', '>=', now()->subMinutes(5))->count();

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

        $employee = Employee::active()->latest()->get();

        return view('frontend.pages.home', compact(
            'banners',
            'beritas',
            'gallerie',
            'employee',
            'activeVisitors',
            'totalVisitors',
            'todayVisitors'
        ));
    }
}
