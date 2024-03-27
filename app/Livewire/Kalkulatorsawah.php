<?php

namespace App\Livewire;

use Livewire\Component;

class Kalkulatorsawah extends Component
{
    public $modecal="htluas";
    public $p1,$l1,$p2,$l2,$la,$m,$ls1,$ls2,$ls3,$ls4,$lanjakw,$lanjarp,$shargabata,$shargatanah;
    public $hgpadi,$lanja,$conhgpadi,$conlanja,$chargabata,$chargatanah;
    public $cluas,$cbata,$clanjakw,$clanjarp;

    // Batas Awal Fungsi Kalkulator Sawah
    public function mount(){
        $this->resetKonversi();
        $this->resetKalkulator();
    }

    public function onHtluas(){
        $this->modecal="htluas";
    }
    public function updatedP1($value){
        $this->kalkulatorsawah();
    }
    public function updatedL1($value){
        $this->kalkulatorsawah();
    }
    public function updatedP2($value){
        $this->kalkulatorsawah();
    }
    public function updatedL2($value){
        $this->kalkulatorsawah();
    }
    public function updatedLa($value){
            $this->m=get_sisiMsegi3($this->p1,$this->l2,$this->la); 
            $this->kalkulatorsawah();
    }
    public function updatedM($value){
        $this->kalkulatorsawah();
    }
    public function updatedHgpadi($value){
        $this->kalkulatorsawah();
    }
    public function updatedLanja($value){
        $this->kalkulatorsawah();
    }
    public function updatedHargabata($value){
        $this->kalkulatorsawah();
    }
    public function resetKalkulator(){
        $this->p1=0;
        $this->l1=0;
        $this->p2=0;
        $this->l2=0;
        $this->la=0;
        $this->m=0;
        $this->hgpadi=get_hargapadi();
        $this->lanja=get_nilailanja();
        $this->shargabata=get_hargabata();
        $this->ls1=0;
        $this->ls2=0;
        $this->ls3=0;
        $this->ls4=0;
        $this->lanjakw= 0;
        $this->lanjarp= 0;
        $this->shargatanah= 0;
    }
    public function kalkulatorsawah(){
        $p1=$this->p1;
        $l1=$this->l1;
        $p2=$this->p2;
        $l2=$this->l2;
        $la=$this->la;
        $m=$this->m;
        $hgpadi=$this->hgpadi;
        $lanja=$this->lanja;
        $shargabata=$this->shargabata;
        if(empty($p2)||empty($l2)){
            //$ls1=get_Nconluas($p1*$l1);
            $this->ls1=get_Nconluas(conv_inputmask($p1)*conv_inputmask($l1));
            $this->ls2=get_Nconluas(conv_inputmask($p1)*conv_inputmask($l1));
            $this->ls3=get_Nconvtobata(conv_inputmask($p1)*conv_inputmask($l1));
            $this->ls4=get_Nconvtobata(conv_inputmask($p1)*conv_inputmask($l1));
            $this->lanjakw= get_lanja($this->ls1,$lanja);
            $this->lanjarp= get_nlanja($this->ls1,$lanja,$hgpadi);
        }elseif(!empty($m)){
            $ls1=get_luassegi4($p1,$l1,$p2,$l2,$m);
            $ls2=get_luassegi4($p1,$l1,$p2,$l2,$m);
            $this->ls1=get_Nconluas($ls1);
            $this->ls2=get_Nconluas($ls2);
            $this->ls3= get_Nconvtobata($ls1);
            $this->ls4= get_Nconvtobata($ls2);
            $this->lanjakw= get_lanja($this->ls1,$lanja);
            $this->lanjarp= get_nlanja($this->ls1,$lanja,$hgpadi);
        }else{
            $ls1=get_luaspersegi($p1,$l1,$p2,$l2);
            $this->ls1=get_Nconluas($ls1);
            $this->ls2=0;
            $this->ls3= get_Nconvtobata($ls1);
            $this->ls4=0;
            $this->lanjakw= get_lanja($this->ls1,$lanja);
            $this->lanjarp= get_nlanja($this->ls1,$lanja,$hgpadi);
        }
        $this->shargatanah= get_hargatanah($this->ls3,$shargabata) ;

    }
    // Batas Akhir Fungsi Kalkulator Sawah

    // Batas Awal Fungsi Konversi Sawah
    public function onCbata(){
        $this->modecal="htconv";
    }
    public function updatedCluas($value){
        $this->cbata= get_Nconvtobata($this->cluas);
        $this->konversisawah();
    }
    public function updatedCbata($value){
        $this->cluas= get_NBatatoluas($this->cbata);
        $this->konversisawah();
    }
    public function updatedConhgpadi($value){
        $this->konversisawah();
    }
    public function updatedConlanja($value){
        $this->konversisawah();
    }
    public function updatedChargabata($value){
        $this->konversisawah();
    }

    public function resetKonversi(){
        $this->cluas=0;
        $this->cbata=0;
        $this->conhgpadi=get_hargapadi();
        $this->conlanja=get_nilailanja();
        $this->chargabata=get_hargabata();
        $this->clanjakw=0;
        $this->clanjarp=0;
        $this->chargatanah=0;
    } 
    public function konversisawah(){
        $conhgpadi=$this->conhgpadi;
        $conlanja=$this->conlanja;
        $chargabata=$this->chargabata;
        $this->clanjakw= get_lanja($this->cluas,$conlanja);
        $this->clanjarp= get_nlanja($this->cluas,$conlanja,$conhgpadi);
        $this->chargatanah= get_hargatanah($this->cbata,$chargabata);
    }
    //batas akhir konversi sawah
    public function render()
    {
        return view('livewire.kalkulatorsawah');
    }
}
