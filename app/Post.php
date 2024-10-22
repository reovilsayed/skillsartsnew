<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
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
