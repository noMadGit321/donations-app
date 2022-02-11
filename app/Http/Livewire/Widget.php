<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Widget extends Component
{

    public $data;

    public $type;

    public $message;

    public function mount($data, $type)
    {
        $this->type = ($type > 0 && $type < 4) ? $type : 1;
        $this->data = $data;

        switch ($this->type) {
            case 1:
                $this->message = 'Highest donation';
                break;
            case 2:
                $this->message = 'Current day';
                break;
            case 3:
                $this->message = 'Last month';
                break;
        }
    }

    public function render()
    {
        return view('livewire.widget');
    }
}
