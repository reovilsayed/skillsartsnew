<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProfileCostCalculator extends Component
{
    public $checked;
    public $pages;

    public $total_cost;

    public $arabic;
    public $english;

    public $profile;

    public function mount()
    {

        $this->pages = $this->profile != null ? json_decode($this->profile)->pages : 8;
        // $this->checked = $this->profile != null ? true : false;
        $this->total_cost = 0;
        $this->arabic = false;
        $this->arabicAndEnglish = false;
        if ($this->profile != null && json_decode($this->profile)->language == 'Arabic') {
            $this->arabic = true;
        } else {
            $this->arabicAndEnglish = true;
        }
        $this->updated();
    }

    public function updatedChecked()
    {
        if ($this->checked == true) {
            $this->emitUp('profilechecked', $this->total_cost);
        } else {
            $this->emitUp('profilechecked', 0);
        }
    }

    public function booted()
    {
        $this->total_cost = $this->pages * 100;
    }

    public function updated()
    {
        $this->calculate();
        $this->updatedChecked();
    }

    public function calculate()
    {
        $this->total_cost = 0;
        $this->total_cost += $this->pages * 100;
        if ($this->arabicAndEnglish) {
            $this->arabic = false;
        }
        $this->total_cost += $this->arabicAndEnglish ? 100 * $this->pages : 0;
        $this->total_cost += $this->arabic ? 50 * $this->pages : 0;

        if ($this->pages >= 16 and $this->pages < 24) {
            $this->total_cost -= ($this->total_cost * (20 / 100));
        } elseif ($this->pages >= 24 and $this->pages < 32) {
            $this->total_cost -= ($this->total_cost * (25 / 100));
        } elseif ($this->pages >= 32 and $this->pages < 40) {
            $this->total_cost -= ($this->total_cost * (30 / 100));
        } elseif ($this->pages >= 40 and $this->pages < 48) {
            $this->total_cost -= ($this->total_cost * (35 / 100));
        } elseif ($this->pages >= 48) {
            $this->total_cost -= ($this->total_cost * (40 / 100));
        }
    }

    public function render()
    {
        return view('livewire.profile-cost-calculator');
    }
}
