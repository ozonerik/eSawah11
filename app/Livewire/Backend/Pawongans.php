<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Pawongan;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Pawongans extends Component
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
    public $ids,$nik,$nama,$alamat,$latlang,$telp,$photo;
    public $oldpath,$newpath,$tmpphoto;
    public $editphoto;
    public $filename="Choose File";

    //jangan gunakan variabel dengan nama rules dan messages 

    //lokasi
    #[On('getDragData')]
    public function getDragData($data){
        $this->alamat=google_alamat($data['lt'],$data['lg']);
        $this->latlang=$this->lt.','.$this->lg;
    }

    #[On('changePlace')]
    public function changePlace($data){
        //dd($data);
        $this->alamat=google_alamat($data['lt'],$data['lg']);
        $this->latlang=$this->lt.','.$this->lg;
    }

    #[On('getCurrentLoc')]
    public function getCurrentLoc($data){
        //dd($data);
        $this->alamat=google_alamat($data['lt'],$data['lg']);
        $this->latlang=$this->lt.','.$this->lg;
    }

    public function onCurrentlokasi()
    {
        $this->dispatch('getLokasiSaatini');
    }

    // Batas Awal Fungsi Tabel
    public function getPawonganProperty(){
        $searchQuery = trim($this->search);
        $requestData = ['nama', 'alamat','telp'];
        return Pawongan::where(function($q) use($requestData, $searchQuery) {
            foreach ($requestData as $field)
            $q->orWhere($field, 'like', "%{$searchQuery}%");
        })->orderBy('updated_at', 'DESC')->where('user_id',Auth::user()->id)->paginate($this->perPage,['*'], 'pawonganPage');

        //return Info::where('title','like','%'.$this->search.'%')->paginate($this->perPage,['*'], 'infoPage');
    }

    public function getRestorepawonganProperty()
    {
        return Pawongan::onlyTrashed()->where('user_id',Auth::user()->id)->orderBy('deleted_at', 'DESC')->paginate($this->perPage,['*'], 'pawongantrashPage');
    }

    public function onTrashed(){
        $this->mode='trashed';
    }

    public function onResDel($id){
        Pawongan::where('id',$id)->withTrashed()->restore();
        $this->resetForm();
        $this->alert('success', 'Pawongan berhasil direstore');
    }

    public function onDelForce($id){
        $this->ids=$id;
        $pawongan = Pawongan::whereIn('id',[$id]);
        $this->confirm("Apakah anda yakin ingin hapus permanen ?<p class='text-danger font-weight-bold'>".$pawongan->pluck('nama')->implode(',<br>')."</p>", 
        [
            'onConfirmed' => 'onDelForceProses'
        ]);
    }

    #[On('onDelForceProses')]
    public function onDelForceProses(){
        Pawongan::where('id',$this->ids)->withTrashed()->forceDelete();
        $this->resetForm();
        $this->alert('success', 'Pawongan berhasil dihapus permanen');
    }

    public function updatedSelectPage($value){
        if($value){
            $this->checked = $this->Pawongan->pluck('id')->toArray();
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

    private function resetForm()
    {
        $this->ids='';
        $this->nik='';
        $this->nama='';
        $this->alamat='';
        $this->telp='';
        $this->photo=null;
        $this->filename="Choose File";
        $this->resetErrorBag();
        $this->resetValidation();

    }

    public function onRead(){
        $this->mode='read';
        $this->resetForm();
    }

    public function onAdd(){
        $this->mode='add';
        $this->dispatch('run_autolocation');
        $this->dispatch('run_inputmask');
        $this->resetForm();
    }

    public function updatedPhoto($value){
        if($value){
            $this->filename=$value->getClientOriginalName();
        }else{
            $this->filename="Choose File";
        }
    }

    public function addpawongan(){
        if(!empty($this->photo)){
            $this->validate(
            [ 
                'nik' => 'required|digits:16',
                'nama' => 'required',
                'photo' => 'nullable|image|max:1024'
            ]);
            $this->newpath="data:image/png;base64,".base64_encode(file_get_contents($this->photo->path()));
            $pawongan=Pawongan::updateOrCreate(['id' => $this->ids], [
                'nik' => $this->nik,
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'latlang' => $this->latlang,
                'telp' => $this->telp,
                'photo' => $this->newpath,
                'user_id' => Auth::user()->id,
            ]);
        }else{
            $this->validate(
                [ 
                    'nik' => 'required|digits:16',
                    'nama' => 'required',
                ]);
                $pawongan=Pawongan::updateOrCreate(['id' => $this->ids], [
                    'nik' => $this->nik,
                    'nama' => $this->nama,
                    'alamat' => $this->alamat,
                    'latlang' => $this->latlang,
                    'telp' => $this->telp,
                    'user_id' => Auth::user()->id,
                ]);
        }  
        $this->alert('success', 'Pawongan berhasil ditambahkan');
        return redirect()->route('pawongans');
    }

    public function onDelete($id){
        $this->ids=$id;
        $pawongan = Pawongan::whereIn('id',[$id]);
        $this->confirm("Apakah anda yakin ingin hapus ?<p class='text-danger font-weight-bold'>".$pawongan->pluck('nama')->implode(',<br>')."</p>", 
        [
            'onConfirmed' => 'delpawongan'
        ]);
    }

    #[On('delpawongan')]
    public function delpawongan()
    {
        Pawongan::findOrFail($this->ids)->delete();
        $this->resetForm();
        $this->alert('success', 'Pawongan berhasil dihapus');
        return redirect()->route('pawongans');
    }

    public function onDelSelect(){
        $pawongan = Pawongan::whereIn('id',$this->checked);
        $this->confirm("Apakah anda yakin ingin hapus ?<p class='text-danger font-weight-bold'>".$pawongan->pluck('nama')->implode(', ')."</p>", 
        [
            'onConfirmed' => 'delpawonganselect'
        ]);
    }

    #[On('delpawonganselect')]
    public function delpawonganselect()
    {
        Pawongan::whereIn('id',$this->checked)->delete();
        $this->resetForm();
        $this->alert('success', 'Pawongan berhasil dihapus');
        return redirect()->route('pawongans');
    }

    public function onEdit($id){
        $this->mode='edit';
        $this->dispatch('run_autolocation');
        $this->dispatch('run_inputmask');
        $this->ids=$id;
        $pawongan = Pawongan::findOrFail($id);
        $this->nik = $pawongan->nik;
        $this->nama = $pawongan->nama;
        $this->alamat = $pawongan->alamat;
        $this->latlang = $pawongan->latlang;
        $this->telp = $pawongan->telp;
        $this->photo = null;
        $this->tmpphoto=$pawongan->photo; 
        $data=explode(",", $this->latlang);
        //dd( $data);
        if(!empty($data[0])){
            $this->lt=$data[0];
            $this->lg=$data[1];
            $this->dispatch('getMAPltlg',lt:$this->lt,lg:$this->lg);
        }   
    }

    public function editpawongan()
    {     
        $this->validate(
            [ 
                'nik' => 'required|digits:16',
                'nama' => 'required',
                'photo' => 'nullable|image|max:1024'
            ]);
        if(!empty($this->photo)){
            $this->newpath="data:image/png;base64,".base64_encode(file_get_contents($this->photo->path()));
        }else{
            $this->newpath=Pawongan::findOrFail($this->ids)->photo;
        }
        
        $pawongan=Pawongan::updateOrCreate(['id' => $this->ids], [
            'nik' => $this->nik,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'latlang' => $this->latlang,
            'telp' => $this->telp,
            'photo' => $this->newpath,
            'user_id' => Auth::user()->id,
        ]);
        $this->alert('success', 'Pawongan berhasil diupdate');
        return redirect()->route('pawongans');
    }

    public function render()
    {
        $data = [
            'Pawongan'=>$this->Pawongan,
            'Restorepawongan'=>$this->Restorepawongan,
        ];

        return view('livewire.backend.pawongans',$data)->layout('layouts.app');
    }
}
