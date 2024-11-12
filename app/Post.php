<?php

namespace App;


use TCG\Voyager\Models\Page as ModelsPage;
use TCG\Voyager\Traits\Translatable;

class Post extends  ModelsPage
{
    use Translatable;
    protected $translatable = ['title', 'seo_title', 'excerpt', 'body', 'meta_description', 'meta_keywords', 'image_alt'];
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'author_id', 'id');
    }

    function scopeFilter($query, array $filter)
    {
        $query->when($filter['category'] ?? false, function ($query, $category) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('categories.slug', $category);
            });
        })->when($filter['search'] ?? false, function ($query, $search) {
            $query->where('title', 'LIKE', '%' . $search . '%')->orWhere('body', 'LIKE', '%' . $search . '%');
        });
    }
}
