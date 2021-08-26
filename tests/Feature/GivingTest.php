<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\DocumentType;
use App\Models\Giver;
use App\Models\Giving;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class GivingTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /** @test */
    public function can_store_a_giving()
    {
        Livewire::test('giving.form')
            ->set('first_name', 'John')
            ->set('first_name', 'John')
            ->set('last_name', 'Doe')
            ->set('document', '1140555632')
            ->set('email', 'john@doe.com')
            ->set('phone', '3104407896')
            ->set('amount', '200000')
            ->set('currency', 'COP')
            ->set('giving_type_id', 1)
            ->call('give');

        $giver = Giver::where('document', '1140555632');

        $this->assertTrue($giver->exists());

        $this->assertTrue(Giving::where('giver_id', $giver->first()->id)->exists());
    }

    /** @test */
    public function can_store_a_giver()
    {
        Livewire::test('giving.form')
            ->set('first_name', 'John')
            ->set('first_name', 'John')
            ->set('last_name', 'Doe')
            ->set('document', '1140555632')
            ->set('email', 'john@doe.com')
            ->set('phone', '3104407896')
            ->call('give');

        $this->assertTrue(Giver::where('document', '1140555632')->exists());
    }
}
