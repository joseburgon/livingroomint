<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\GivingType;
use Livewire\Component;

class GivingTypesForm extends Component
{
    public $name;
    public $active = 1;

    protected $listeners = ['submitGivingTypeForm' => 'submit'];

    protected $rules = [
        'name' => ['required', 'string', 'max:100'],
        'active' => ['required', 'boolean']
    ];

    public function render()
    {
        return view('livewire.dashboard.giving-types-form');
    }

    public function submit()
    {
        $this->validate();

        $type = GivingType::create([
            'name' => $this->name,
            'active' => $this->active,
        ]);

        return redirect()->route('giving-types.index', ['message' => "Nuevo tipo de donación creado: {$type->name}"]);
    }
}
