<?php

namespace App\Http\Livewire\Giving;

use App\Models\Country;
use App\Models\DocumentType;
use App\Models\GivingType;
use Livewire\Component;

class Form extends Component
{
    public $givingTypes;

    public $documentTypes;

    public $countries;

    public function mount()
    {
        $this->givingTypes = GivingType::active()->pluck('name', 'id');

        $this->documentTypes = DocumentType::active()->pluck('name', 'id');

        $this->countries = Country::active()
            ->orderBy('order')
            ->get()
            ->pluck('name', 'code');
    }

    public function render()
    {
        return view('livewire.giving.form');
    }

    public function donate()
    {
        return "donating";
    }
}
