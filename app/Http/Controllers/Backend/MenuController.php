<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menus\StoreMenuRequest;
use App\Http\Requests\Menus\UpdateMenuRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    public function index()
    {
        Gate::authorize('menus.index');

        $menus = Menu::latest('id')->get();
        return  view('backend.menus.index', compact('menus'));
    }

    public function create()
    {
        Gate::authorize('menus.create');

        return view('backend.menus.form');
    }

    public function store(StoreMenuRequest $request)
    {
        Menu::create([
            'name' => Str::slug($request->name),
            'description' => $request->description,
            'deletable' => true
        ]);

        notify()->success('Menu berhasil ditambahkan');
        return redirect()->route('menus.index');
    }

    public function edit(Menu $menu)
    {
        Gate::authorize('menus.edit');

        return view('backend.menus.form', compact('menu'));
    }

    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $menu->update([
            'name' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        notify()->success('Menu berhasil ditambahkan');
        return redirect()->route('menus.index');
    }

    public function destroy(Menu $menu)
    {
        Gate::authorize('menus.destroy');

        if (! $menu->deletable) {
            notify()->error('Menu sistem tidak boleh dihapus');
            return back();
        }

        if (! $menu->delete()) {
            notify()->error('Menu gagal dihapus');
            return back();
        }

        notify()->success('Menu berhasil dihapus');
        return back();
    }

    public function orderItem(Request $request)
    {
        Gate::authorize('menus.index');

        $menuItemOrder = json_decode($request->input('order'));
        $this->orderMenu($menuItemOrder, null);
    }

    private function orderMenu(array $menuItems, $parentId)
    {
        Gate::authorize('menus.index');

        foreach ($menuItems as $index => $menuItem) {
            $item = MenuItem::find($menuItem->id);

            if (! $item) {
                notify()->error(sprintf("Submenu '%s' tidak ditemukan", $menuItem->id));
                return back();
            }

            $item->order = $index + 1;
            $item->parent_id = $parentId;
            $item->save();

            if (isset($menuItem->children)) {
                $this->orderMenu($menuItem->children, $item->id);
            }
        }
    }
}
