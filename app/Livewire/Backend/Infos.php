<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Info;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Livewire\Attributes\On; 

class Infos extends Component
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
    public $ids,$title,$message,$img;
    public $oldpath,$newpath,$tmpimg;
    public $filename="Choose File";

    //jangan gunakan variabel dengan nama rules dan messages 
 

     // Batas Awal Fungsi Tabel
    public function getInfoProperty(){
        $searchQuery = trim($this->search);
        $requestData = ['title', 'message'];
        return Info::where(function($q) use($requestData, $searchQuery) {
            foreach ($requestData as $field)
               $q->orWhere($field, 'like', "%{$searchQuery}%");
        })->orderBy('updated_at', 'DESC')->paginate($this->perPage,['*'], 'infoPage');
    }

    public function getRestoreinfoProperty()
    {
        return Info::onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate($this->perPage,['*'], 'infotrashPage');
    }

    public function onTrashed(){
        $this->mode='trashed';
    }

    public function onResDel($id){
        Info::where('id',$id)->withTrashed()->restore();
        $this->resetForm();
        $this->alert('success', 'Info berhasil direstore');
    }

    public function onDelForce($id){
        $this->ids=$id;
        $info = Info::whereIn('id',[$id]);
        $this->confirm("Apakah anda yakin ingin hapus permanen ?<p class='text-danger font-weight-bold'>".$info->pluck('title')->implode(',<br>')."</p>", 
        [
            'onConfirmed' => 'onDelForceProses'
        ]);
    }

    #[On('onDelForceProses')]
    public function onDelForceProses(){
        Info::where('id',$this->ids)->withTrashed()->forceDelete();
        $this->resetForm();
        $this->alert('success', 'Info berhasil dihapus permanen');
    }
    
    public function updatedSelectPage($value){
        if($value){
            $this->checked = $this->Info->pluck('id')->toArray();
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
        $this->title='';
        $this->message='';
        $this->img=null;
        $this->editimg=null;
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
        $this->resetForm();
    }

    public function updatedImg($value){
        if($value){
            $this->filename=$value->getClientOriginalName();
        }else{
            $this->filename="Choose File";
        }
    }
    
    public function addinfo(){
        if(!empty($this->img)){
            $this->validate(
            [ 
                'title' => 'required|min:4|max:255',
                'message' => 'required|min:4|max:255',
                'img' => 'image|max:1024'
            ]);
            $this->newpath="data:image/png;base64,".base64_encode(file_get_contents($this->img->path()));
            $info=Info::updateOrCreate(['id' => $this->ids], [
                'title' => $this->title,
                'message' => $this->message,
                'img' => $this->newpath,
            ]);
        }else{
            $this->validate(
                [ 
                    'title' => 'required|min:4|max:255',
                    'message' => 'required|min:4|max:255',
                ]);
                $info=Info::updateOrCreate(['id' => $this->ids], [
                    'title' => $this->title,
                    'message' => $this->message,
                ]);
        }  
        $this->alert('success', 'Info berhasil ditambahkan');
        return redirect()->route('infos');
    }

    public function onDelete($id){
        $this->ids=$id;
        $info = Info::whereIn('id',[$id]);
        $this->confirm("Apakah anda yakin ingin hapus ?<p class='text-danger font-weight-bold'>".$info->pluck('title')->implode(',<br>')."</p>", 
        [
            'onConfirmed' => 'delinfo'
        ]);
    }

    #[On('delinfo')]
    public function delinfo()
    {
        Info::findOrFail($this->ids)->delete();
        $this->resetForm();
        $this->alert('success', 'Info berhasil dihapus');
        return redirect()->route('infos');
    }

    public function onDelSelect(){
        $info = Info::whereIn('id',$this->checked);
        $this->confirm("Apakah anda yakin ingin hapus ?<p class='text-danger font-weight-bold'>".$info->pluck('title')->implode(', ')."</p>", 
        [
            'onConfirmed' => 'delinfoselect'
        ]);
    }

    #[On('delinfoselect')]
    public function delinfoselect()
    {
        Info::whereIn('id',$this->checked)->delete();
        $this->resetForm();
        $this->alert('success', 'Info berhasil dihapus');
        return redirect()->route('infos');
    }

    public function onEdit($id){
        $this->mode='edit';
        $this->ids=$id;
        $info = Info::findOrFail($id);
        $this->title = $info->title;
        $this->message = $info->message;
        $this->img = null;
        $this->tmpimg=$info->img;    
    }

    public function editinfo()
    {     
        $this->validate(
            [ 
                'title' => 'required|min:4|max:255',
                'message' => 'required|min:4|max:255',
                'img' => 'nullable|image|max:1024'
            ]);
        if(!empty($this->img)){
            $this->newpath="data:image/png;base64,".base64_encode(file_get_contents($this->img->path()));
        }else{
            $this->newpath=Info::findOrFail($this->ids)->img;
        }
        
        $info=Info::updateOrCreate(['id' => $this->ids], [
            'title' => $this->title,
            'message' => $this->message,
            'img' => $this->newpath,
        ]);
        $this->alert('success', 'Info berhasil diupdate');
        return redirect()->route('infos');
    }

    public function render()
    {
        $data = [
            'Info'=>$this->Info,
            'Restoreinfo'=>$this->Restoreinfo,
        ];
        return view('livewire.backend.infos',$data)->layout('layouts.app');
    }
}
