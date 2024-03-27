<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\On; 
use Spatie\Geocoder\Geocoder;

class Giss extends Component
{
    public $latlang,$luas,$luasbata,$lokasi,$keliling;
    public $mode='read';
    public $hgpadi,$lanja,$lanjakw,$lanjarp;
    public $lt,$lg,$ac;
    public $mluas=0;
    public $mkel=0;
    public $hargabata,$hargatanah;
    
    public function mount(){
        $this->resetForm();
    }

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
        $this->luasbata= get_Nconvtobata($this->luas);
        $this->keliling=conv_measure($data['kl']);
        $this->onHitung();
    }

    public function onCurrentlokasi()
    {
        $this->dispatch('getLokasiSaatini');
    }

    public function onRead(){
        $this->mode='read';
        $this->resetForm();
    }

    private function resetForm(){
        $this->latlang='';
        $this->lokasi='';
        $this->luas=0;
        $this->luasbata=0;
        $this->keliling=0;
        $this->hgpadi=get_hargapadi();
        $this->lanja=get_nilailanja();
        $this->hargabata=get_hargabata();
        $this->lanjakw=0;
        $this->lanjarp=0;
        $this->hargatanah=0;
    }

    public function updatedLuas($value){
        $this->luasbata= get_Nconvtobata($value);
        $this->onHitung();
    }
    public function updatedLuasbata($value){
        $this->luas= get_NBatatoluas($value);
        $this->onHitung();
    }
    public function updatedHgpadi($value){
        //dd($value);
        $this->onHitung();
    }
    public function updatedLanja($value){
        //dd($value);
        $this->onHitung();
    }
    public function updatedHargabata($value){
        //dd($value);
        $this->onHitung();
    }

    public function onHitung(){
            $hgpadi=$this->hgpadi;
            $lanja=$this->lanja;
            $this->lanjakw= get_lanja($this->luas,$lanja);
            $this->lanjarp= get_nlanja($this->luas,$lanja,$hgpadi);
            //dd( conv_inputmask($this->luasbata));
            $this->hargatanah= get_hargatanah($this->luasbat,$this->hargabata);
    }

    public function onReset(){
        $this->resetForm();
    }

    public function render()
    {
            return view('livewire.backend.giss')->layout('layouts.app');
    }
}
