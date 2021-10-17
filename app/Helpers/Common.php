<?php

if (! function_exists('menu')) {
    function menu($name)
    {
        $menu = \App\Models\Menu::where('name', $name)->first();
        return $menu->menuItems()->with('childs')->get();
    }
}

if (! function_exists('setting')) {
    function setting($key, $default = null)
    {
        return \App\Models\Setting::get($key, $default);
    }
}
