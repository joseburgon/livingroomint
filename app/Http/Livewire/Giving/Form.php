<?php

namespace App\Http\Livewire\Giving;

use Livewire\Component;

class Form extends Component
{
    public function donate()
    {
        return "donating";
    }

    public function render()
    {
        return view('livewire.giving.form');
    }
}
