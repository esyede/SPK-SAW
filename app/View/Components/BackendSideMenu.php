<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class BackendSideMenu extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        $items = Cache::rememberForever('backend.sidebar.menu', function() {
            return menu('backend-sidebar');
        });

        return view('components.backend-side-menu', compact('items'));
    }
}
