<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;
use function view;

class Header extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.dashboard.header');
    }
}
