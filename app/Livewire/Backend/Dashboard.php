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
    public $user,$luas,$tanggal,$result,$lokasi;
    public $user_multi=[];
    public $area=0;
    public $keliling=0;
    public $mode='read';

    public function gantiMode($mode)
    {
        $this->mode = $mode;
        if($mode=='read'){
            //dd('read');
            $this->dispatch('run_select2'); $this->dispatch('run_select2');
        }
        if($mode=='edit'){
            //dd('edit');
            $this->dispatch('run_select2');
        }
        
    }

    public function mount(){
        $this->user = User::get();
        //$this->dispatch('run_select2');  
    }

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
