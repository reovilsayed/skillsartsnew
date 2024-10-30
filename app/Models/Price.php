<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Price extends Model
{
    use HasFactory;
    use Translatable;
    protected $translatable = ['price_name', 'price_feature'];
}
