<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\GivingType;
use Livewire\Component;
use Livewire\WithPagination;

class DataTables extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.dashboard.data-tables', [
            'types' => GivingType::paginate(5)
        ]);
    }

    public function paginationView(): string
    {
        return 'livewire.dashboard.pagination';
    }
}
