<?php

namespace App\Http\Livewire;

use App\Repositories\CostRepository;
use Livewire\Component;

class Calculator extends Component
{

    public $logo = 0;
    public $profile = 0;
    public $website = 0;
    public $total = 0;
    public $identity = 0;
    public $services;
    protected $listeners = ['logochecked', 'profilechecked', 'websitechecked', 'identitychecked'];


    public function mount()
    {
        $this->updated();
    }
    public function logochecked($value)
    {
       
    }

    public function profilechecked($value)
    {
        $this->profile = 0;
        $this->profile += $value;
        $this->updated();
    }

    public function identitychecked($value)
    {
        $this->identity = 0;
        $this->identity += $value;
        $this->updated();
    }

    public function websitechecked($value)
    {
        $this->website = 0;
        $this->website += $value;
        $this->updated();
    }

    public function updated()
    {
        $this->total = 0;
        $this->total = $this->logo + $this->profile +  $this->website + $this->identity;
    }

    public function render()
    {
        return view('livewire.calculator');
    }
}
