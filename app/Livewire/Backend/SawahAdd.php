<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Sawah;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\Attributes\On; 

class SawahAdd extends Component
{
    use WithPagination;
    use LivewireAlert;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $perPage=5;
    public $selectPage = false;
    public $checked = [];
    public $search='';
    public $mode='read';
    public $luasbata,$keliling;
    public $ids,$nosawah,$namasawah,$luas,$lokasi,$latlang,$b_barat,$b_utara,$b_timur,$b_selatan,$namapenjual,$hargabeli,$tglbeli,$namapembeli,$hargajual,$tgljual,$nop,$nilaipajak,$img,$user_id;
    public $oldpath,$newpath,$tmpimg;
    public $filename="Choose File";
    public $p1,$l1,$p2,$l2,$la,$m,$ls1,$ls2,$ls3,$ls4,$lanjakw,$lanjarp;
    public $cluas,$cbata,$clanjakw,$clanjarp;
    public $hgpadi="750000";
    public $lanja="5";
    public $conhgpadi="750000";
    public $conlanja="5";
    public $modecal="htluas";
    public $autocomplate;
    public $lt,$lg,$ac;
    public $mluas=0;
    public $mkel=0;
    public $bata,$hargabata;

    public function mount(){
        $this->resetForm();
    }

    public function onRead(){
        return redirect()->route('sawahs');
    }

    #[On('getDragData')]
    public function getDragData($data){
        $this->lokasi=google_alamat($data['lt'],$data['lg']);
    }

    #[On('getMeasureData')]
    public function getMeasureData($data){
        //dd($data);
        $this->luas=conv_measure($data['ls']);
        $this->bata= get_Nconvtobata($this->luas);
        $this->hargabeli= ($this->bata * conv_inputmask($this->hargabata));

    }

    public function onCurrentlokasi()
    {
        $this->dispatch('getLokasiSaatini');
    }
    
    public function updatedImg($value){
        if($value){
            $this->filename=$value->getClientOriginalName();
        }else{
            $this->filename="Choose File";
        }
    }

    public function updatedluas($value){
        $this->bata= get_Nconvtobata(conv_inputmask($value));
        $this->hargabeli= ($this->bata * conv_inputmask($this->hargabata));
    }

    public function updatedHargabata($value){
        if($value == 0 || empty($value)){
            $this->hargabata=get_hargabata();
        }
        $this->bata= get_Nconvtobata(conv_inputmask($this->luas));
        $this->hargabeli= ($this->bata * conv_inputmask($this->hargabata));
    }

    public function addsawah(){
        $this->validate(
            [ 
                'nosawah' => 'required|string',
                'namasawah' => 'required|string',
                'lokasi' => 'required|string',
                'latlang' => 'nullable|string',
                'b_barat' => 'nullable|string',
                'b_utara' => 'nullable|string',
                'b_timur' => 'nullable|string',
                'b_selatan' => 'nullable|string',
                'namapenjual' => 'nullable|string',
                'namapembeli' => 'nullable|string',
                'nop' => 'nullable|string',
                'img' => 'nullable|image|max:1024',
            ]);
        if(empty($this->hargabeli)){
            $this->hargabeli='0';
        }
        if(empty($this->hargajual)){
            $this->hargajual='0';
        }

        if(!empty($this->img)){
           $this->newpath="data:image/png;base64,".base64_encode(file_get_contents($this->img->path()));
        }else{
            $this->newpath='';
        }  
        $info=Sawah::updateOrCreate(['id' => $this->ids], [
            'nosawah' => $this->nosawah,
            'namasawah' => $this->namasawah,
            'luas' => conv_inputmask($this->luas),
            'lokasi' => $this->lokasi,
            'latlang' => $this->latlang,
            'b_barat' => $this->b_barat,
            'b_utara' => $this->b_utara,
            'b_timur' => $this->b_timur,
            'b_selatan' => $this->b_selatan,
            'namapenjual' => $this->namapenjual,
            'hargabeli' => conv_inputmask($this->hargabeli),
            'tglbeli' => Carbon::parse($this->tglbeli)->format("Y-m-d"),
            'namapembeli' => $this->namapembeli,
            'hargajual' => conv_inputmask($this->hargajual),
            'tgljual' => Carbon::parse($this->tgljual)->format("Y-m-d"),
            'nop' => $this->nop,
            'nilaipajak' => conv_inputmask($this->nilaipajak),
            'img' => $this->newpath,
            'user_id' => Auth::user()->id
        ]);
        $this->alert('success', 'Sawah berhasil ditambahkan');
        return redirect()->route('sawahs');
    }

    private function resetForm(){
        $this->kordinat='';
        $this->ids='';
        $this->nosawah='';
        $this->namasawah='';
        $this->luas='0';
        $this->hargabata=get_hargabata();
        $this->lokasi='';
        $this->latlang='';
        $this->b_barat='';
        $this->b_utara='';
        $this->b_timur='';
        $this->b_selatan='';
        $this->namapenjual='';
        $this->hargabeli=0;
        $this->tglbeli='';
        $this->namapembeli='';
        $this->hargajual=0;
        $this->tgljual='';
        $this->nop='';
        $this->nilaipajak=0;
        $this->img=null;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        $this->lokasi=google_alamat($this->lt,$this->lg);
        $this->latlang=$this->lt.','.$this->lg;
        return view('livewire.backend.sawah-add')->layout('layouts.app');
    }
}
