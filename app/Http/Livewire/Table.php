<?php

namespace App\Http\Livewire;

use App\Models\Donation;
use App\Services\DonationService;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    public $size;

    public function mount($size)
    {
        $this->size = $size;
    }

    public function render()
    {
        return view('livewire.table', [
            'data' => Donation::paginate($this->size)
        ]);
    }
}
