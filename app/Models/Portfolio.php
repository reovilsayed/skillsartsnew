<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Portfolio extends Model
{
    use HasFactory;
    use Translatable;
    protected $translatable = ['title'];

    public function category()
    {
        return $this->belongsTo('App\Models\Portcat', 'porcats_id', 'id');
    }
}
