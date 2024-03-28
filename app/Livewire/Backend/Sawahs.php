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

class Sawahs extends Component
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
    public $bata,$hargabata;
    public $lt,$lg,$ac,$mluas,$mkel;

    public function updatedImg($value){
        if($value){
            $this->filename=$value->getClientOriginalName();
        }else{
            $this->filename="Choose File";
        }
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
        $this->bata= get_Nconvtobata($this->luas);
    }

    public function onCurrentlokasi()
    {
        $this->dispatch('getLokasiSaatini');
    }

    public function mount(){
        $this->resetForm();
    }

     // Batas Awal Fungsi Tabel
    public function getSawahProperty(){
        $searchQuery = trim($this->search);
        $requestData = ['nosawah','namasawah','luas','lokasi'];
        return Sawah::where(function($q) use($requestData, $searchQuery) {
            foreach ($requestData as $field)
               $q->orWhere($field, 'like', "%{$searchQuery}%");
        })->where('user_id',Auth::user()->id)->paginate($this->perPage,['*'], 'sawahPage');

        //return Info::where('title','like','%'.$this->search.'%')->paginate($this->perPage,['*'], 'infoPage');
    }
    public function updatedSelectPage($value){
        if($value){
            $this->checked = $this->Sawah->pluck('id')->toArray();
        }else{
            $this->checked = [];
        }
    }
    public function updatedChecked($value){
        $this->selectPage=false;
    }
    public function is_checked($id){
        return in_array($id,$this->checked);
    }

    // Batas Akhir Fungsi Tabel

    public function onRead(){
        $this->mode='read';
    }

    private function resetForm(){
        $this->kordinat='';
        $this->ids='';
        $this->nosawah='';
        $this->namasawah='';
        $this->luas=0;
        $this->bata=0;
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

    public function onEdit($id){
        //$id=Crypt::encryptString($id);
        //return redirect()->route('sawahs.edit','s='.$id);
        $this->mode='edit';
        $this->dispatch('run_autolocation');
        $this->dispatch('run_inputmask');
        $this->ids=$id;
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
        $this->hargabeli=($sawah->hargabeli);
        $this->tglbeli=Carbon::parse($sawah->tglbeli)->format("d/m/Y");
        $this->namapembeli=$sawah->namapembeli;
        $this->hargajual=($sawah->hargajual);
        $this->tgljual=Carbon::parse($sawah->tgljual)->format("d/m/Y");
        $this->nop=$sawah->nop;
        $this->nilaipajak=($sawah->nilaipajak);
        $this->img=null;
        $this->tmpimg=$sawah->img;
        $data=explode(",", $this->latlang);
        //dd( $data);
        if(!empty($data[0])){
            $this->lt=$data[0];
            $this->lg=$data[1];
            $this->dispatch('getMAPltlg',lt:$this->lt,lg:$this->lg);
        }
    }

    public function editsawah(){
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
            $this->newpath=Sawah::findOrFail($this->ids)->img;
        }
        //dd($this->luas);
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

    public function onAdd(){
        //return redirect()->route('sawahs.add');
        $this->mode='add';
        $this->resetForm();
        $this->dispatch('run_autolocation');
        $this->dispatch('run_inputmask');
    }

    public function updatedluas($value){
        $this->bata= get_Nconvtobata($value);
        $this->hargabeli= get_hargatanah($this->bata,$this->hargabata);
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

    public function onDelete($id){
        $this->ids=$id;
        Sawah::findOrFail($this->ids)->delete();
        $this->alert('success', 'Sawah berhasil dihapus');
        return redirect()->route('sawahs');
    }

    public function getRestoresawahProperty()
    {
        return Sawah::onlyTrashed()->where('user_id',Auth::user()->id)->orderBy('deleted_at', 'DESC')->paginate($this->perPage,['*'], 'sawahtrashPage');
    }

    public function onTrashed(){
        $this->mode='trashed';
    }

    public function onResDel($id){
        Sawah::where('id',$id)->withTrashed()->restore();
        $this->alert('success', 'Sawah berhasil direstore');
    }
    
    public function onDelForce($id){
        $this->ids=$id;
        $sawah = Sawah::whereIn('id',[$id]);
        $this->confirm("Apakah anda yakin ingin hapus permanen ?<p class='text-danger font-weight-bold'>".$sawah->pluck('namasawah')->implode(',<br>')."</p>", 
        [
            'onConfirmed' => 'onDelForceProses'
        ]);
    }

    #[On('onDelForceProses')]
    public function onDelForceProses(){
        Sawah::where('id',$this->ids)->withTrashed()->forceDelete();
        $this->alert('success', 'Sawah berhasil dihapus permanen');
    }

    public function onDelSelect(){
        Sawah::whereIn('id',$this->checked)->delete();
        $this->alert('success', 'Sawah berhasil dihapus');
        return redirect()->route('sawahs');
    }

    public function render()
    {
        $data = [
            'Sawah'=>$this->Sawah,
            'Restoresawah'=>$this->Restoresawah,
        ];
        return view('livewire.backend.sawahs',$data)->layout('layouts.app');
    }
}
