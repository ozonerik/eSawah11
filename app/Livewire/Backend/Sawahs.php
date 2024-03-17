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


    public function mount(){
        $this->resetKonversi();
        $this->resetForm();
        $this->resetKalkulator();
    }

    //jangan gunakan variabel dengan nama rules dan messages 
    
    #[On('getDragData')]
    public function getDragData($data){
        $this->lokasi=google_alamat($data['lt'],$data['lg']);
        $this->latlang=$this->lt.','.$this->lg;
    }

    #[On('getMeasureData')]
    public function getMeasureData($data){
        //dd($data);
        $this->luas=conv_measure($data['ls']);
    }

    public function onCurrentlokasi()
    {
        $this->dispatch('getLokasiSaatini');
        $this->lokasi=google_alamat($this->lt,$this->lg);
        $this->latlang=$this->lt.','.$this->lg;
    }

    public function updatedLokasi()
    {
        $this->dispatch('getAutocomplete');
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

    // Batas Awal Fungsi Kalkulator Sawah
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
    public function resetKalkulator(){
        $this->p1=0;
        $this->l1=0;
        $this->p2=0;
        $this->l2=0;
        $this->la=0;
        $this->m=0;
        $this->hgpadi=get_hargapadi();
        $this->lanja=get_nilailanja();
        $this->ls1=0;
        $this->ls2=0;
        $this->ls3=0;
        $this->ls4=0;
        $this->lanjakw= get_lanja(0,$this->lanja);
        $this->lanjarp= get_nlanja(0,$this->lanja,$this->hgpadi);
    }
    public function kalkulatorsawah(){
        $this->validate(
        [ 
            'p1' => 'nullable',
            'l1' => 'nullable',
            'p2' => 'nullable',
            'l2' => 'nullable',
            'la' => 'nullable',
            'm' => 'nullable',
            'hgpadi' => 'required',
            'lanja' => 'required',
        ]);
        $p1=$this->p1;
        $l1=$this->l1;
        $p2=$this->p2;
        $l2=$this->l2;
        $la=$this->la;
        $m=$this->m;
        $hgpadi=$this->hgpadi;
        $lanja=$this->lanja;
        if(empty($p2)||empty($l2)){
            $p1=floatval($p1);
            $l1=floatval($l1);
            $ls1=get_Nconluas($p1*$l1);
            $this->ls1=get_conluas($p1*$l1);
            $this->ls2=get_conluas($p1*$l1);
            $this->ls3=get_convtobata($p1*$l1);
            $this->ls4=get_convtobata($p1*$l1);
            $this->lanjakw= get_lanja($ls1,$lanja);
            $this->lanjarp= get_nlanja($ls1,$lanja,$hgpadi);
        }elseif(!empty($m)){
            $ls1=get_luassegi4($p1,$l1,$p2,$l2,$m);
            $ls2=get_luassegi4($p1,$l1,$p2,$l2,$m);
            $this->ls1=get_conluas($ls1);
            $this->ls2=get_conluas($ls2);
            $this->ls3= get_convtobata($ls1);
            $this->ls4= get_convtobata($ls2);
            $this->lanjakw= get_lanja($ls1,$lanja);
            $this->lanjarp= get_nlanja($ls1,$lanja,$hgpadi);
        }else{
            $ls1=get_luaspersegi($p1,$l1,$p2,$l2);
            $this->ls1=get_conluas($ls1);
            $this->ls2="";
            $this->ls3= get_convtobata($ls1);
            $this->ls4="";
            $this->lanjakw= get_lanja($ls1,$lanja);
            $this->lanjarp= get_nlanja($ls1,$lanja,$hgpadi);
        }

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
        //dd($value);
        $this->konversisawah();
    }
    public function updatedConlanja($value){
        //dd($value);
        $this->konversisawah();
    }
    public function resetKonversi(){
        $this->cluas=0;
        $this->cbata=0;
        $this->conhgpadi=get_hargapadi();
        $this->conlanja=get_nilailanja();
        $this->clanjakw=get_lanja($this->cluas,$this->conlanja);
        $this->clanjarp=get_nlanja($this->cluas,$this->conlanja,$this->conhgpadi);
    } 
    public function konversisawah(){
        $this->validate(
            [ 
                'cluas' => 'nullable',
                'cbata' => 'nullable',
                'conhgpadi' => 'required',
                'conlanja' => 'required',
            ]);
        
        $cluas=$this->cluas;
        $cbata=$this->cbata;
        $conhgpadi=$this->conhgpadi;
        $conlanja=$this->conlanja;
        $this->clanjakw= get_lanja($cluas,$conlanja);
        $this->clanjarp= get_nlanja($cluas,$conlanja,$conhgpadi);
    }

    public function onRead(){
        $this->mode='read';
        $this->resetForm();
    }

    public function onEdit($id){
        $this->dispatch('run_maskcurrency');
        //$this->onGetAdress('edit');
        $this->mode='edit';
        $this->ids=$id;
        $sawah = Sawah::findOrFail($id);
        $this->nosawah=$sawah->nosawah;
        $this->namasawah=$sawah->namasawah;
        $this->luas=$sawah->luas;
        $this->lokasi=$sawah->lokasi;
        $this->latlang=$sawah->latlang;
        $this->b_barat=$sawah->b_barat;
        $this->b_utara=$sawah->b_utara;
        $this->b_timur=$sawah->b_timur;
        $this->b_selatan=$sawah->b_selatan;
        $this->namapenjual=$sawah->namapenjual;
        $this->hargabeli=get_floatttorp($sawah->hargabeli);
        $this->tglbeli=Carbon::parse($sawah->tglbeli)->format("d-m-Y");
        $this->namapembeli=$sawah->namapembeli;
        $this->hargajual=get_floatttorp($sawah->hargajual);
        $this->tgljual=Carbon::parse($sawah->tgljual)->format("d-m-Y");
        $this->nop=$sawah->nop;
        $this->nilaipajak=get_floatttorp($sawah->nilaipajak);
        $this->img=$sawah->img;
        $this->tmpimg=$sawah->img;
        $this->show_location($this->latlang);
        
    }



    private function resetForm(){
        $this->kordinat='';
        $this->ids='';
        $this->nosawah='';
        $this->namasawah='';
        $this->luas='0';
        $this->lokasi='';
        $this->latlang='';
        $this->b_barat='';
        $this->b_utara='';
        $this->b_timur='';
        $this->b_selatan='';
        $this->namapenjual='';
        $this->hargabeli=get_floatttorp(0);
        $this->tglbeli='';
        $this->namapembeli='';
        $this->hargajual=get_floatttorp(0);
        $this->tgljual='';
        $this->nop='';
        $this->nilaipajak=get_floatttorp(0);
        $this->img=null;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedImg($value){
        if($value){
            $this->filename=$value->getClientOriginalName();
        }else{
            $this->filename="Choose File";
        }
    }

    public function editsawah(){
        $this->validate(
            [ 
                'nosawah' => 'required|string',
                'namasawah' => 'required|string',
                'luas' => 'required|numeric',
                'lokasi' => 'required|string',
                'latlang' => 'nullable|string',
                'b_barat' => 'nullable|string',
                'b_utara' => 'nullable|string',
                'b_timur' => 'nullable|string',
                'b_selatan' => 'nullable|string',
                'namapenjual' => 'nullable|string',
                'hargabeli' => 'nullable',
                'tglbeli' => 'nullable|date',
                'namapembeli' => 'nullable|string',
                'hargajual' => 'nullable',
                'tgljual' => 'nullable|date',
                'nop' => 'nullable|string',
                'nilaipajak' => 'nullable',
                'img' => 'nullable|image|max:1024',
            ]);
        if(empty($this->hargabeli)){
            $this->hargabeli='0';
        }
        if(empty($this->hargajual)){
            $this->hargajual='0';
        }
        $dir='photosawah'; 
        if(!empty($this->img)){
            //$this->hapusfile($this->ids);
            //$this->newpath=$this->img->store($dir,'public');
            $this->newpath="data:image/png;base64,".base64_encode(file_get_contents($this->img->path()));

        }else{
            $this->newpath=Sawah::findOrFail($this->ids)->img;
        }  
        $info=Sawah::updateOrCreate(['id' => $this->ids], [
            'nosawah' => $this->nosawah,
            'namasawah' => $this->namasawah,
            'luas' => $this->luas,
            'lokasi' => $this->lokasi,
            'latlang' => $this->latlang,
            'b_barat' => $this->b_barat,
            'b_utara' => $this->b_utara,
            'b_timur' => $this->b_timur,
            'b_selatan' => $this->b_selatan,
            'namapenjual' => $this->namapenjual,
            'hargabeli' => $this->hargabeli,
            'tglbeli' => Carbon::parse($this->tglbeli)->format("Y-m-d"),
            'namapembeli' => $this->namapembeli,
            'hargajual' => $this->hargajual,
            'tgljual' => Carbon::parse($this->tgljual)->format("Y-m-d"),
            'nop' => $this->nop,
            'nilaipajak' => $this->nilaipajak,
            'img' => $this->newpath,
            'user_id' => Auth::user()->id
        ]);
        //flash message
        $this->alert('success', 'Sawah berhasil diupdate');
        //session()->flash('success', 'Sawah berhasil diupdate');
        //redirect
        return redirect()->route('sawahs');
    }

    public function onAdd(){
        $this->mode='add';
        $this->dispatch('getLokasiSaatini');
        $this->resetForm();
    }

    public function addsawah(){
        $this->validate(
            [ 
                'nosawah' => 'required|string',
                'namasawah' => 'required|string',
                'luas' => 'required|numeric',
                'lokasi' => 'required|string',
                'latlang' => 'nullable|string',
                'b_barat' => 'nullable|string',
                'b_utara' => 'nullable|string',
                'b_timur' => 'nullable|string',
                'b_selatan' => 'nullable|string',
                'namapenjual' => 'nullable|string',
                'hargabeli' => 'nullable',
                'tglbeli' => 'nullable|date',
                'namapembeli' => 'nullable|string',
                'hargajual' => 'nullable',
                'tgljual' => 'nullable|date',
                'nop' => 'nullable|string',
                'nilaipajak' => 'nullable',
                'img' => 'nullable|image|max:1024',
            ]);
        if(empty($this->hargabeli)){
            $this->hargabeli='0';
        }
        if(empty($this->hargajual)){
            $this->hargajual='0';
        }
        $dir='photosawah'; 
        if(!empty($this->img)){
           // $this->newpath=$this->img->store($dir,'public');
           $this->newpath="data:image/png;base64,".base64_encode(file_get_contents($this->img->path()));
        }else{
            $this->newpath='';
        }  
        $info=Sawah::updateOrCreate(['id' => $this->ids], [
            'nosawah' => $this->nosawah,
            'namasawah' => $this->namasawah,
            'luas' => $this->luas,
            'lokasi' => $this->lokasi,
            'latlang' => $this->latlang,
            'b_barat' => $this->b_barat,
            'b_utara' => $this->b_utara,
            'b_timur' => $this->b_timur,
            'b_selatan' => $this->b_selatan,
            'namapenjual' => $this->namapenjual,
            'hargabeli' => $this->hargabeli,
            'tglbeli' => Carbon::parse($this->tglbeli)->format("Y-m-d"),
            'namapembeli' => $this->namapembeli,
            'hargajual' => $this->hargajual,
            'tgljual' => Carbon::parse($this->tgljual)->format("Y-m-d"),
            'nop' => $this->nop,
            'nilaipajak' => $this->nilaipajak,
            'img' => $this->newpath,
            'user_id' => Auth::user()->id
        ]);
        //flash message
        $this->alert('success', 'Sawah berhasil ditambahkan');
        //session()->flash('success', 'Sawah berhasil ditambahkan');
        //redirect
        return redirect()->route('sawahs');
    }

    public function onDelete($id){
        $this->ids=$id;
        Sawah::findOrFail($this->ids)->delete();
        //reset form
        $this->resetForm();
        //flash message
        $this->alert('success', 'Sawah berhasil dihapus');
        //session()->flash('success', 'Sawah berhasil dihapus');
        //redirect
        return redirect()->route('sawahs');
    }

/*     private function deletefile($pathfile){
        if(Storage::disk('public')->exists($pathfile)){
            Storage::disk('public')->delete($pathfile);
        }
    } */

    private function hapusfile($id){
        //dd($id);
        $this->oldpath = Sawah::findOrFail($id)->img;
        $dir='photosawah'; 
        if(!empty($this->oldpath)){
            $this->deletefile($this->oldpath);
        }
    }

    private function hapusfileDel($id){
        //dd($id);
        $this->oldpath = Sawah::onlyTrashed()->findOrFail($id)->img;
        $dir='photosawah'; 
        if(!empty($this->oldpath)){
            $this->deletefile($this->oldpath);
        }
    }

    public function getRestoresawahProperty()
    {
        return Sawah::onlyTrashed()->where('user_id',Auth::user()->id)->orderBy('deleted_at', 'DESC')->paginate($this->perPage,['*'], 'sawahtrashPage');
    }
    public function onTrashed(){
        $this->mode='trashed';
    }

    public function onResDel($id){
        //dd('restore= '.$id);
        Sawah::where('id',$id)->withTrashed()->restore();
        //reset form
        $this->resetForm();
        //flash message
        //session()->now('success', 'Sawah berhasil direstore');
        $this->alert('success', 'Sawah berhasil direstore');
        //return redirect()->route('sawahs');
    }
    
    
    public function onDelForce($id){
        $this->ids=$id;
        $sawah = Sawah::whereIn('id',[$id]);
        $this->confirm("Apakah anda yakin ingin hapus permanen ?<p class='text-danger font-weight-bold'>".$sawah->pluck('namasawah')->implode(',<br>')."</p>", 
        [
            'onConfirmed' => 'onDelForceProses'
        ]);
    }

    public function onDelForceProses(){
        //dd('delforce= '.$id);
        //dd($this->ids);
        $this->hapusfileDel($this->ids);
        Sawah::where('id',$this->ids)->withTrashed()->forceDelete();
        //reset form
        $this->resetForm();
        //flash message
        //session()->flash('success', 'Sawah berhasil dihapus permanen');
        $this->alert('success', 'Sawah berhasil dihapus permanen');
        //return redirect()->route('sawahs');
    }

    public function onDelSelect(){
        Sawah::whereIn('id',$this->checked)->delete();
        $this->resetForm();
        $this->alert('success', 'Sawah berhasil dihapus');
        //session()->flash('success', 'Sawah berhasil dihapus');
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
