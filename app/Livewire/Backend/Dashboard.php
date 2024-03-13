<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Layout('layouts.app')] 
    public $luas,$tanggal,$result;
    public function updatedLuas($value){
        $this->result=$value;
    }
    public function updatedTanggal($value){
        $this->result=$value;
    }

    public function render()
    {
        return view('livewire.backend.dashboard');
    }
}
