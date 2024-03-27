<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;

class Search extends Component
{
    #[Url(as: 'q',except: '')]
    public $search='';

    public function clearSearch(){
        $this->search='';
    }
    
    public function get_search(){    
        session()->flash('search', $this->search);  
        return redirect()->route('result'); 
    }
    
    public function render()
    {
        return view('livewire.search');
    }
}
