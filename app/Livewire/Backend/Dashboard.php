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
    public $user,$luas,$tanggal,$result,$address,$lt,$lg;
    public $user_multi=[];
    public $area=0;
    public $keliling=0;

    #[On('KirimData')]
    public function KirimData($data1,$data2)
    {
        $data=[$data1,$data2];
        dd($data);
    }

    #[On('AmbilData')]
    public function AmbilData()
    {
        //dd('ambil data');
        $this->dispatch('getDataFromComponent',data1:'data1 dari component',data2:'data2 dari component');
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
        $this->luas=$this->area;
        $this->dispatch('run_select2');
        return view('livewire.backend.dashboard');
    }
}
