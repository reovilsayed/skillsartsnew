<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;

class Prodcat extends Model
{
    use Resizable;
    public function childrens()
    {
        return $this->hasMany(Prodcat::class, 'parent_id');
    }
}
