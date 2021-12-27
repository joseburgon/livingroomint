<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\GivingType;
use Livewire\Component;
use Livewire\WithPagination;

class GivingTypeTable extends Component
{
    use WithPagination;

    public $search;
    public $sortField;
    public $sortAsc = true;
    protected $queryString = ['search', 'sortAsc', 'sortField'];

    public function render()
    {
        return view('livewire.dashboard.giving-types-table', [
            'types' => GivingType::where('name', 'like', '%' . $this->search . '%')
                ->when($this->sortField, function ($query) {
                    $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
                })
                ->paginate(5)
        ]);
    }

    public function paginationView(): string
    {
        return 'livewire.dashboard.pagination';
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleActive($id)
    {
        $givingType = GivingType::find($id);

        $givingType->update(['active' => !$givingType->active]);
    }
}
