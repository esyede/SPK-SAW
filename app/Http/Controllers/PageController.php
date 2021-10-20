<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageResource;
use App\Models\Page;

class PageController extends Controller
{
    public function __invoke($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('backend.page.index', compact('page'));
    }
}
