<?php

namespace App\Http\Livewire;

use Illuminate\Support\Arr;
use Livewire\Component;

class IdentityCostCalculator extends Component
{
    public $checked;
    public $items;
    public $total_cost;
    public $identity;
    public function mount()
    {
        $this->items = [
            "business_card" => false,
            "letter_head" => false,
            "payment_voucher" => false,
            "reciept_voucher" => false,
            "floder" => false,
            "stamp" => false,
            "envelope" => false,
            "car_sticker" => false,
            "roll_up_stand" => false,
            "banner" => false,
            "flyer" => false,
            "poster" => false,
            "menu" => false,
        ];
        if($this->identity != null){
        array_map(function ($value) {
            $key = strtolower(str_replace(' ', '_', $value));
            $this->items[$key] = true;
        }, json_decode($this->identity));}

        // $this->checked = $this->identity != null ? true : false;

        $this->total_cost = 0;
        $this->updated();
    }


    public function updatedChecked()
    {
        if ($this->checked == true) {
            $this->emitUp('identitychecked', $this->total_cost);
        } else {
            $this->emitUp('identitychecked', 0);
        }
    }

    public function updated()
    {
        $count = 0;
        foreach ($this->items as $item) {
            if ($item == true) {
                $count++;
            }
        }

        $this->total_cost = 300 * $count;
        if ($count >= 6 && $count < 8) {
            $this->total_cost -= ($this->total_cost * (20 / 100));
        } elseif ($count >= 8 && $count < 10) {
            $this->total_cost -= ($this->total_cost * (25 / 100));
        } elseif ($count >= 10) {
            $this->total_cost -= ($this->total_cost * (30 / 100));
        }
        $this->updatedChecked();
    }
    public function render()
    {
        return view('livewire.identity-cost-calculator');
    }
}
