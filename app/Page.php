<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Page as ModelsPage;

class Page extends ModelsPage
{
    protected $translatable = ['title', 'body', 'meta_description'];
}
