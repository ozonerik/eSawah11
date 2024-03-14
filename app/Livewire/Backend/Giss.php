<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\On; 
use Spatie\Geocoder\Geocoder;

class Giss extends Component
{
    public $latlang,$luas,$luasbata,$keliling,$lokasi;
    public $mode='read';
    public $map_id = 0;
    public $hgpadi;
    public $lanja;
    public $lanjakw;
    public $lanjarp;

    //autocomplete address
    #[On('onGetAdress')]
    public function onGetAdress(){
        $this->dispatch('getaddress',map_id : $this->map_id);    
    }
    //end autocomplete address
    
    public function mount(){
        $this->resetForm();
    }

    #[On('getLatlangInput')]
    public function getLatlangInput($data)
    {
        //dd($data);
        if($data['lat']==0 || $data['long']==0){
            $this->latlang='';
            $this->lt=0;
            $this->lg=0;
        }else{
            $this->latlang=$data['lat'].','.$data['long'];
            $this->lt=$data['lat'];
            $this->lg=$data['long'];
        }
   
        if(empty($data['lokasi'])){
            $geocoder=$this->onGetGeocoder($data['lat'],$data['long']);
            if($geocoder !== 'result_not_found'){
                $this->lokasi=  $geocoder ;
            }else{
                $this->lokasi=  '' ;
                $this->dispatch('getaddress',
                    map_id:$this->map_id,
                    lt:0,
                    lg:0,
                    kordinat:'',
                );   
            }    
        }else{
            $this->lokasi=$data['lokasi'];
            $this->map_id++;
            $nilai=['map_id' => $this->map_id,
            'lt' => $data['lat'],
            'lg' => $data['long'],
            'kordinat' => $this->latlang];
            //dd($nilai);
            $this->dispatch('getaddress',
                map_id:$this->map_id,
                lt:$data['lat'],
                lg:$data['long'],
                kordinat:$this->latlang
            ); //ini yag trouble
        }
    }

    public function onGetlokasi(){
        $this->map_id++;
        $this->dispatch('getLocation',map_id:$this->map_id);
    }

    public function getResetlocation($data)
    {
        $this->latlang='';
    }


    public function onRead(){
        $this->mode='read';
        $this->resetForm();
    }

    private function resetForm(){
        $this->dispatch('resetLocation',map_id:$this->map_id);
        $this->latlang='';
        $this->lokasi='';
        $this->map_id=0;
        $this->luas=0;
        $this->luasbata=0;
        $this->keliling=0;
        $this->hgpadi=get_floatttorp(get_hargapadi());
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
                 'luas' => 'numeric|nullable',
                 'luasbata' => 'numeric|nullable',
                 'hgpadi' => 'required',
                 'lanja' => 'required|numeric',
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
        $g=collect($geocoder->getAddressForCoordinates($lat,$lng));
        $lokasi= $g->get('formatted_address');
        return $lokasi;
    }

    public function render()
    {
        return view('livewire.backend.giss')->layout('layouts.app');
    }
}
