<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menus\StoreMenuItemRequest;
use App\Http\Requests\Menus\UpdateMenuItemRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class MenuBuilderController extends Controller
{
    public function index($id)
    {
        Gate::authorize('menus.index');

        $menu = Menu::findOrFail($id);
        return view('backend.menus.builder', compact('menu'));
    }

    public function itemCreate($id)
    {
        Gate::authorize('menus.create');

        $menu = Menu::findOrFail($id);
        return view('backend.menus.item.form', compact('menu'));
    }

    public function itemStore(StoreMenuItemRequest $request, $id)
    {
        $menu = Menu::findOrFail($id);

        MenuItem::create([
            'menu_id' => $menu->id,
            'type' => $request->type,
            'title' => $request->title,
            'divider_title' => $request->divider_title,
            'url' => $request->url,
            'target' => $request->target,
            'icon_class' => $request->icon_class
        ]);

        notify()->success('Menu berhasil ditambahkan');
        return redirect()->route('menus.builder', $menu->id);
    }

    public function itemEdit($menuId, $itemId)
    {
        Gate::authorize('menus.edit');

        $menu = Menu::findOrFail($menuId);
        $menuItem = $menu->menuItems()->findOrFail($itemId);

        return view('backend.menus.item.form', compact('menu', 'menuItem'));
    }

    public function itemUpdate(UpdateMenuItemRequest $request, $menuId, $itemId)
    {
        $menu = Menu::findOrFail($menuId);
        $menu->menuItems()->findOrFail($itemId)->update([
            'type' => $request->type,
            'title' => $request->title,
            'divider_title' => $request->divider_title,
            'url' => $request->url,
            'target' => $request->target,
            'icon_class' => $request->icon_class
        ]);

        notify()->success('Menu berhasil disimpan');
        return redirect()->route('menus.builder', $menu->id);
    }

    public function itemDestroy($menuId, $itemId)
    {
        Gate::authorize('menus.destroy');

        if (! $menu) {
            notify()->error('Menu tidak ditemukan');
            return back();
        }

        $submenu = $menu->menuItems()->find($itemId);

        if (! $submenu) {
            notify()->error('Submenu tidak ditemukan');
            return back();
        }

        if (! $submenu->delete()) {
            notify()->error('Gagal menghapus submenu');
            return back();
        }

        notify()->success('Menu berhasil dihapus');
        return back();
    }
}
