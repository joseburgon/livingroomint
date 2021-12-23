<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class SidebarLink extends Component
{
    public $active = false;
    public $link = '#';
    public $icon;

    public function __construct($active, $link, $icon = 'home')
    {
        $this->active = (bool) $active;
        $this->link = $link;
        $this->icon = $icon;
    }

    public function render()
    {
        return view('components.dashboard.sidebar-link');
    }
}
