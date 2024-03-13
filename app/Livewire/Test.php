<?php

namespace App\Livewire;

use Livewire\Component;
//use Livewire\Attributes\Layout;

class Test extends Component
{
    //#[Layout('components.layouts.app')] 
    public $luas,$tanggal,$result;
    public function updatedLuas($value){
        $this->result=$value;
    }
    public function updatedTanggal($value){
        $this->result=$value;
    }
    public function render()
    {
        return view('livewire.test')->layout('components.layouts.app');
    }
}
