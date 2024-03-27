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
    public $user,$luas,$tgl1,$tgl2,$result,$lokasi,$bata;
    public $user_multi=[];
    public $area=0;
    public $keliling=0;
    public $mode='read';
    public $latlang,$lt,$lg;

    #[On('getDragData')]
    public function getDragData($data){
        $this->lokasi=google_alamat($data['lt'],$data['lg']);
        $this->latlang=$this->lt.','.$this->lg;
    }

    #[On('changePlace')]
    public function changePlace($data){
        //dd($data);
        $this->lokasi=google_alamat($data['lt'],$data['lg']);
        $this->latlang=$this->lt.','.$this->lg;
    }

    #[On('getCurrentLoc')]
    public function getCurrentLoc($data){
        //dd($data);
        $this->lokasi=google_alamat($data['lt'],$data['lg']);
        $this->latlang=$this->lt.','.$this->lg;
    }
    
    #[On('getMeasureData')]
    public function getMeasureData($data){
        //dd($data);
        $this->luas=conv_measure($data['ls']);
/*         $this->luasbata= get_Nconvtobata($this->luas);
        $this->keliling=conv_measure($data['kl']);
        $this->onHitung(); */
    }

    public function onCurrentlokasi()
    {
        $this->dispatch('getLokasiSaatini');
    }

    public function gantiMode($mode)
    {
        $this->mode = $mode;
        if($mode=='read'){
            //dd('read');
            $this->dispatch('run_select2');
            $this->dispatch('run_autolocation');
        }
        if($mode=='add'){
            //dd('edit');
            $this->dispatch('run_select2');
            $this->dispatch('run_autolocation');
            //$this->dispatch('run_inputmask');
            $this->dispatch('run_inputmask2');
        }
        
    }

    public function mount(){
        $this->user = User::get();
        $this->tgl2='26/03/2024';  
    }

    public function updatedLuas($value){
        $this->result=$value;
    }

    public function updatedBata($value){
        $this->result=$value;
    }

    public function updatedTgl1($value){
        $this->result=$value;
    }
    public function updatedTgl2($value){
        //$this->result=$value;
    }

    public function render()
    {
        return view('livewire.backend.dashboard');
    }
}
