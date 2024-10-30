<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class Prodcat extends Model
{
    use Resizable;
    use Translatable;
    protected $translatable = ['name', 'saleprice', 'details', 'description'];
    public function childrens()
    {
        return $this->hasMany(Prodcat::class, 'parent_id');
    }
}
