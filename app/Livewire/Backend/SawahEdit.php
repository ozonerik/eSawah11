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
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Crypt;

class SawahEdit extends Component
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
    public $modecal="htluas";
    public $autocomplate;
    public $lt,$lg,$ac;
    public $mluas=0;
    public $mkel=0;
    public $bata,$hargabata;
    
    #[Url(as: 's',except: '')]
    public $id = '';

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

    public function editsawah(){
        $id=Crypt::decryptString($this->id);
        $this->validate(
            [ 
                'nosawah' => 'required|string',
                'namasawah' => 'required|string',
                'luas' => 'required',
                'lokasi' => 'required|string',
                'latlang' => 'nullable|string',
                'b_barat' => 'nullable|string',
                'b_utara' => 'nullable|string',
                'b_timur' => 'nullable|string',
                'b_selatan' => 'nullable|string',
                'namapenjual' => 'nullable|string',
                'hargabeli' => 'nullable',
                'tglbeli' => 'nullable',
                'namapembeli' => 'nullable|string',
                'hargajual' => 'nullable',
                'tgljual' => 'nullable',
                'nop' => 'nullable',
                'nilaipajak' => 'nullable',
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
            $this->newpath=Sawah::findOrFail($id)->img;
        }  
        $info=Sawah::updateOrCreate(['id' => $id], [
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
            'tglbeli' => Carbon::createFromFormat('d/m/Y', $this->tglbeli)->format("Y-m-d"),
            'namapembeli' => $this->namapembeli,
            'hargajual' => conv_inputmask($this->hargajual),
            'tgljual' => Carbon::createFromFormat('d/m/Y', $this->tgljual)->format("Y-m-d"),
            'nop' => $this->nop,
            'nilaipajak' => conv_inputmask($this->nilaipajak),
            'img' => $this->newpath,
            'user_id' => Auth::user()->id
        ]);
        $this->alert('success', 'Sawah berhasil diupdate');
        return redirect()->route('sawahs');
    }

    public function mount(){
        $id=Crypt::decryptString($this->id);
        $sawah = Sawah::findOrFail($id);
        $this->nosawah=$sawah->nosawah;
        $this->namasawah=$sawah->namasawah;
        $this->luas=$sawah->luas;
        $this->hargabata=get_hargabata();
        $this->bata= get_Nconvtobata($this->luas);
        $this->lokasi=$sawah->lokasi;
        $this->latlang=$sawah->latlang;
        $this->b_barat=$sawah->b_barat;
        $this->b_utara=$sawah->b_utara;
        $this->b_timur=$sawah->b_timur;
        $this->b_selatan=$sawah->b_selatan;
        $this->namapenjual=$sawah->namapenjual;
        $this->hargabeli=get_floatttorp($sawah->hargabeli);
        $this->tglbeli=Carbon::parse($sawah->tglbeli)->format("d/m/Y");
        $this->namapembeli=$sawah->namapembeli;
        $this->hargajual=get_floatttorp($sawah->hargajual);
        $this->tgljual=Carbon::parse($sawah->tgljual)->format("d/m/Y");
        $this->nop=$sawah->nop;
        $this->nilaipajak=get_floatttorp($sawah->nilaipajak);
        $this->img=null;
        $this->tmpimg=$sawah->img;
    }
    
    public function render()
    {
        $this->lokasi=google_alamat($this->lt,$this->lg);
        $this->latlang=$this->lt.','.$this->lg;
        return view('livewire.backend.sawah-edit')->layout('layouts.app');
    }
}
