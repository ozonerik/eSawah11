<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Test extends Component
{
    #[Layout('components.layouts.app')] 
    public $count = 1;
 
    public function increment()
    {
        $this->count++;
    }
 
    public function decrement()
    {
        $this->count--;
    }

    
    public function render()
    {
        return view('livewire.test');
    }
}
