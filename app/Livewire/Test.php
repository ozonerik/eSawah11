<?php

namespace App\Livewire;

use Livewire\Component;
//use Livewire\Attributes\Layout;

class Test extends Component
{
    //#[Layout('components.layouts.app')] 
    public $mode='read';
    public $luas,$bata;
    public function changeMode($mode){  
        $this->mode=$mode;
        $this->dispatch('$refresh');
        $this->dispatch('getID');
    }
    public function render()
    {
        return view('livewire.test')->layout('components.layouts.app');
    }
}
