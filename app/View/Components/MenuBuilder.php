<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuBuilder extends Component
{
    public $menuItems;

    public function __construct($menuItems)
    {
        $this->menuItems = $menuItems;
    }

    public function render()
    {
        return view('components.menu-builder');
    }
}
