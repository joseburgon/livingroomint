<?php

namespace Tests\Feature\Dashboard;

use App\Http\Livewire\Dashboard\GivingTypesTable;
use App\Models\GivingType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class GivingTypesTableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function main_page_contains_datatables_livewire_component()
    {
        $this->actingAs(User::factory()->create());

        $this->get('/giving-types')
            ->assertSeeLivewire(GivingTypesTable::class);
    }

    /** @test */
    public function datatables_searches_name_correctly()
    {
        $givingTypeA = GivingType::create([
            'name' => 'Fake Type A',
            'active' => true,
        ]);

        Livewire::test(GivingTypesTable::class)
            ->set('search', 'Type A')
            ->assertSee($givingTypeA->name)
            ->assertDontSee('non existent type name');
    }

    /** @test */
    public function datatables_sorts_name_asc_correctly()
    {
        $givingTypeC = GivingType::create([
            'name' => 'Type C',
            'active' => true,
        ]);

        $givingTypeA = GivingType::create([
            'name' => 'Type A',
            'active' => true,
        ]);

        $givingTypeB = GivingType::create([
            'name' => 'Type B',
            'active' => true,
        ]);

        Livewire::test(GivingTypesTable::class)
            ->call('sortBy', 'name')
            ->assertSeeInOrder(['Type A', 'Type B', 'Type C']);
    }

    /** @test */
    public function datatables_sorts_name_desc_correctly()
    {
        $givingTypeC = GivingType::create([
            'name' => 'Type C',
            'active' => true,
        ]);

        $givingTypeA = GivingType::create([
            'name' => 'Type A',
            'active' => true,
        ]);

        $givingTypeB = GivingType::create([
            'name' => 'Type B',
            'active' => true,
        ]);

        Livewire::test(GivingTypesTable::class)
            ->call('sortBy', 'name')
            ->call('sortBy', 'name')
            ->assertSeeInOrder(['Type C', 'Type B', 'Type A']);
    }
}
