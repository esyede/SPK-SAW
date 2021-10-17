<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\StorePageRequest;
use App\Http\Requests\Pages\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        Gate::authorize('pages.index');

        $pages = Page::latest('id')->get();
        return view('backend.pages.index', compact('pages'));
    }

    public function create()
    {
        Gate::authorize('pages.create');

        return view('backend.pages.form');
    }

    public function store(StorePageRequest $request)
    {
        $page = Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->filled('status'),
        ]);

        if ($request->hasFile('image')) {
            $page->addMedia($request->image)->toMediaCollection('image');
        }

        notify()->success('Halaman berhasil ditambahkan');
        return redirect()->route('pages.index');
    }

    public function show(Page $page)
    {
        //
    }

    public function edit(Page $page)
    {
        Gate::authorize('pages.edit');

        return view('backend.pages.form', compact('page'));
    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->filled('status'),
        ]);

        if ($request->hasFile('image')) {
            $page->addMedia($request->image)->toMediaCollection('image');
        }

        notify()->success('Halaman berhasil disimpan');
        return redirect()->route('pages.index');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        notify()->success('Halaman berhasil dihapus');
        return back();
    }
}
