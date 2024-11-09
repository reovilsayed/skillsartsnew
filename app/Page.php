<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $translatable = ['title', 'body', 'meta_description'];
}
