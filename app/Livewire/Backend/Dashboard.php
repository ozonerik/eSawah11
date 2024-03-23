<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use Geocoder;
use Livewire\Attributes\On; 

class Dashboard extends Component
{
    
    #[Layout('layouts.app')] 
    public $user,$luas,$tanggal,$result;
    public $user_multi=[];
    public $area=0;
    public $keliling=0;

    public function gantiMode($mode)
    {
        $this->mode = $mode;
        $this->dispatch('getLokasiSaatIni');
    }

    public function mount(){
        $this->user = User::get();  
    }

    public function updatedLuas($value){
        $this->result=$value;
    }

    public function updatedTanggal($value){
        $this->result=$value;
    }

    public function render()
    {
        $this->dispatch('run_select2');
        return view('livewire.backend.dashboard');
    }
}
