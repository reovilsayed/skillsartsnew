<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Service extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable = ['icon', 'title', 'body'];
    protected $translatable = ['title', 'body'];
}
