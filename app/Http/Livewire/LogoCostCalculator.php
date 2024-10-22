<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LogoCostCalculator extends Component
{
    public $checked;
    public $concepts;
    public $total_cost;
    public  $logo;

    public function updatedChecked()
    {
        if ($this->checked == true) {
            
            $this->emitUp('identitychecked', $this->total_cost);
        } else {
            $this->emitUp('identitychecked', 0);
        }
    }

    public function mount()
    {
        $this->concepts = $this->logo != null ? json_decode($this->logo)->concepts : 3;
        // $this->checked = $this->logo != null ? true : false;
       
        $this->total_cost = 1000;

        $this->updated();
  
    }
 

    public function updated()
    {
        $this->calculate();
        $this->updatedChecked();
    }

    public function calculate()
    {
        $this->total_cost = 1000;
        $this->total_cost += ($this->concepts - 3) * 150;
        
    }

    public function render()
    {
        return view('livewire.logo-cost-calculator');
    }
}
