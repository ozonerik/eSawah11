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
    public $map_id;
    public $lt,$lg;
    public $mluas=0;
    public $mkel=0;
    
    public function mount(){
        $this->resetForm();
    }

    #[On('getDragData')]
    public function getDragData($data){
        $this->lokasi=google_alamat($data['lt'],$data['lg']);
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
        $this->map_id=0;
        $this->luas=0;
        $this->luasbata=0;
        $this->keliling=0;
        $this->hgpadi=get_hargapadi();
        $this->lanja=get_nilailanja();
        $this->lanjakw=get_lanja($this->luas,$this->lanja);
        $this->lanjarp=get_nlanja($this->luas,$this->lanja,$this->hgpadi);
    }

    public function updatedLuas($value){
        $this->luasbata= get_Nconvtobata($this->luas);
        $this->onHitung();
    }
    public function updatedLuasbata($value){
        $this->luas= get_NBatatoluas($this->luasbata);
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

    public function onHitung(){
         $this->validate(
             [ 
                 'luas' => 'nullable',
                 'luasbata' => 'nullable',
                 'hgpadi' => 'required',
                 'lanja' => 'required',
             ]);
            $luas=$this->luas;
            $luasbata=$this->luasbata;
            $hgpadi=$this->hgpadi;
            $lanja=$this->lanja;
            $this->lanjakw= get_lanja($luas,$lanja);
            $this->lanjarp= get_nlanja($luas,$lanja,$hgpadi);
    }

    public function onReset(){
        $this->resetForm();
    }

    public function onGetGeocoder($lat,$lng){
        $client = new \GuzzleHttp\Client();
        $geocoder = new Geocoder($client);
        $geocoder->setApiKey(config('geocoder.key'));
        $g=collect($geocoder->getAddressForCoordinates(floatval($lat),floatval($lng)));
        $location= $g->get('formatted_address');
        return $location;
    }

    public function render()
    {
            //$this->lokasi=$this->onGetGeocoder($this->lt,$this->lg);
            $this->lokasi=google_alamat($this->lt,$this->lg);
            $this->latlang=$this->lt.','.$this->lg;
            return view('livewire.backend.giss')->layout('layouts.app');
    }
}
