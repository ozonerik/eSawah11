<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use Geocoder;

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
        dd(Geocoder::getCoordinatesForAddress('Jakarta'));
        $this->dispatch('run_select2');
        return view('livewire.backend.dashboard');
    }
}
