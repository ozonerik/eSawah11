<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Appconfig;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Appconfigs extends Component
{
    use LivewireAlert;
    public $mapapikey,$hargapadi,$nilailanja,$hargaemas,$hargabata;

    public function mount()
    {
        $config=Appconfig::find(1);
        $this->mapapikey= $config->mapapikey;
        $this->hargapadi= $config->hargapadi;
        $this->nilailanja= $config->nilailanja;
        $this->hargaemas=get_hargaemas();
        $this->hargabata=$config->hargabata;
    }

    public function onReset(){
        $config=Appconfig::find(1);
        $this->mapapikey= $config->mapapikey;
        $this->hargapadi= $config->hargapadi;
        $this->nilailanja= $config->nilailanja;
        $this->hargaemas=get_hargaemas();
        $this->hargabata=$config->hargabata;
    }

    public function editreferensi(){
        $this->validate(
            [ 
                'mapapikey' => 'required',
                'hargapadi' => 'required',
                'nilailanja' => 'required',
                'hargabata' => 'required',
            ]);
        
        $config=Appconfig::updateOrCreate(['id' => '1'], [
            'mapapikey' => $this->mapapikey,
            'hargapadi' => conv_inputmask($this->hargapadi),
            'nilailanja' => conv_inputmask($this->nilailanja),
            'hargabata' => conv_inputmask($this->hargabata),
        ]);

        //flash message
        $this->alert('success', 'Referensi berhasil diupdate');
    }

    public function render()
    {
        return view('livewire.backend.appconfigs')->layout('layouts.app');
    }
}
