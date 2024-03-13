<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;

class Dashboard extends Component
{
    #[Layout('layouts.app')] 
    public $user,$luas,$tanggal,$result;
    public $user_multi=[];
    public function updatedLuas($value){
        $this->result=$value;
    }
    public function updatedTanggal($value){
        $this->result=$value;
    }
    public function mount()
    {
        $this->user = User::get();          
    }

    public function render()
    {
        $this->dispatch('run_select2');
        return view('livewire.backend.dashboard');
    }
}
