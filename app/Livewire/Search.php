<?php

namespace App\Livewire;

use Livewire\Component;

class Search extends Component
{
    public $search_txt;

    public function clearSearch(){
        $this->search_txt='';
    }
    
    public function get_search(){    
        session()->flash('search', $this->search_txt);  
        return redirect()->route('result'); 
    }
    
    public function render()
    {
        return view('livewire.search');
    }
}
