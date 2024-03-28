<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\User;
use App\Models\Info;
use App\Models\Sawah;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On; 

class Dashboard extends Component
{
    
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $perPage=10;
    public $infobanner;
    public $map_id = 0;

    public function mount()
    {
        $this->infobanner=Info::orderBy('updated_at', 'DESC')->get();
    }

    public function dehydrate(){
        $this->map_id++;
    }

    public function getMapsawahProperty(){
        return Sawah::select('namasawah','latlang')->where('user_id',Auth::user()->id)->get();
    }

    public function render()
    {
        $data = [
            'mapsawah'=>$this->Mapsawah->toArray(),
        ];
        return view('livewire.backend.dashboard',$data)->layout('layouts.app');
    }
}
