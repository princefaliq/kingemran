<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
            ->firstOrFail();

        // Tentukan tipe konten
        $viewType = $this->resolveContentType($page);

        return view('frontend.pages.page', [
            'page' => $page,
            'title' => $page->title,
            'viewType' => $viewType
        ]);
    }
    private function resolveContentType($page)
    {
        if ($page->content_type === 'editor') {
            return 'editor';
        }

        if ($page->content_type === 'pdf') {
            return 'pdf';
        }

        if ($page->content_type === 'editor_pdf') {
            return 'editor_pdf';
        }

        return 'editor'; // default fallback
    }
}
