<?php

use App\Http\Controllers\FrontEnd\AboutController;
use App\Http\Controllers\FrontEnd\BeritaController;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\PagesController;
use App\Http\Controllers\FrontEnd\PaketController;
use App\Http\Controllers\FrontEnd\TestimonialController;
use App\Http\Controllers\FrontEnd\TourPackageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('beranda');
Route::get('/tentang-kami', [AboutController::class, 'index']);

Route::get('/testimoni', [TestimonialController::class, 'create'])->name('testimonials.create');
Route::post('/testimoni', [TestimonialController::class, 'store'])->name('testimonials.store');
// filter dulu (lebih spesifik)
Route::get('/berita/kategori/{slug}', [BeritaController::class, 'category'])->name('news.category');
Route::get('/berita/tag/{slug}', [BeritaController::class, 'tag'])->name('news.tag');

//tour
Route::get('/paket', [TourPackageController::class, 'index'])->name('tour.index');
Route::get('/paket/{slug}',[TourPackageController::class,'packageDetail'])->name('tour.show');

// list semua berita
Route::get('/berita', [BeritaController::class, 'index'])->name('news.index');

// detail (taruh PALING BAWAH)
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('news.show');

//route pages
Route::get('{slug}',[PagesController::class,'show'])->where('slug', '^(?!admin).*');
require __DIR__.'/auth.php';
