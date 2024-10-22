<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Rating extends Model
{
    protected $fillable = ['name','email','review','rating','product_id'];
}
