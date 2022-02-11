<?php

namespace Tests\Unit;

use App\Http\Livewire\DonationForm;
use App\Http\Livewire\Table;
use App\Http\Livewire\Widget;
use App\Models\Donation;
use App\Repositories\DonationRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireTest extends TestCase
{
    use RefreshDatabase;

    private $repo;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo = resolve(DonationRepository::class);
    }

    public function test_widget_works_correclty() {
        Livewire::test(Widget::class, ['data' => ['name' => 'name', 'donation' => 200], 'type' => 1])
            ->assertSee('Highest donation');
    }

    public function test_table_works_correctly() {
        $collection = Donation::factory()->count(20)->create();


        Livewire::test(Table::class, ['size' => 15])
            ->assertSee($collection[10]->name);
    }

    public function test_table_pagination_works_correctly() {
        $collection = Donation::factory()->count(20)->create();


        Livewire::test(Table::class, ['size' => 5])
            ->assertDontSee($collection[10]->name);
    }

    public function test_donation_form_works_correctly() {
        Livewire::test(DonationForm::class)
            ->assertViewIs('livewire.donation-form');
    }
}
