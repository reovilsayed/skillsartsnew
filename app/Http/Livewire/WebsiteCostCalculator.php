<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WebsiteCostCalculator extends Component
{
    public $checked;
    public $website_types;

    public $total_cost;

    //select
    public $websiteType;
    // range
    public $page;
    public $language;
    public $email;
    // bollean
    public $blog;
    public $ecommerce;
    public $onlinePayment;
    public $onlineShipping;

    public $website;

    public function mount()
    {
     
        $this->website_types  = [
            [
                'label' => 'With Dashboard',
                'title' => 'مع لوحة تحكم',
                'price' => 4000,
            ],
            [
                'label' => 'Without Dashboard',
                'title' => 'لايوجد لوحة تحكم',
                'price' => 3000
            ]
        ];

        $this->total_cost = 0;
        $this->page = 1;
        $this->language = 1;
        $this->email = 1;
        $this->blog = false;
        $this->ecommerce = false;

        $this->onlinePayment = false;
        $this->onlineShipping = false;

        if ($this->website != null) {
            $this->websiteType = json_decode($this->website)->type;
            $this->page = json_decode($this->website)->pages;
            $this->language = json_decode($this->website)->languages;
            $this->email = json_decode($this->website)->emails;
            if(array_key_exists('features',json_decode($this->website))){
            foreach (json_decode($this->website)->features as $feature) {
                switch (strtolower($feature)) {
                    case 'blog':
                        $this->blog = true;
                        break;
                    case 'ecommerce':
                        $this->ecommerce = true;
                        break;

                    case 'online payment':
                        $this->onlinePayment = true;
                        break;
                    case 'online shipping':
                        $this->onlineShipping = true;
                   
                }
            // $this->checked = true;
            }
        }
            $this->updated();
        }
    }

    public function updatedChecked()
    {
        if ($this->checked == true) {
            $this->emitUp('websitechecked', $this->total_cost);
        } else {
            $this->emitUp('websitechecked', 0);
        }
    }


    public function updated()
    {
        $this->calculate();
        $this->updatedChecked();
    }

    public function calculate()
    {
        $this->total_cost = 0;

        $this->total_cost += $this->websiteType === "With Dashboard" ? $this->website_types[0]['price'] : 0;
        $this->total_cost += $this->websiteType === "Without Dashboard" ? $this->website_types[1]['price'] : 0;
        if ($this->websiteType === "With Dashboard" || $this->websiteType === "Without Dashboard") {
            if ($this->page > 5) {
                $this->total_cost += ($this->page - 5) * 250;
            }
            if ($this->language > 1) {
                $this->total_cost += ($this->language - 1) * 1500;
            }

            if ($this->email > 5) {
                $this->total_cost += ($this->email - 5) * 100;
            }
            $this->total_cost += $this->blog ? 250 : 0;
            $this->total_cost += $this->ecommerce ? 3000 : 0;
            $this->total_cost += $this->onlinePayment ? 1500 : 0;
            $this->total_cost += $this->onlineShipping ? 1500 : 0;
        }
    }


    public function render()
    {
        return view('livewire.website-cost-calculator');
    }
}
