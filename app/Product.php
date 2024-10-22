<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;

class Product extends Model
{
  use Resizable;
	protected $guarded = [];

    public function setPriceAttribute($value){
      $this->attributes['price'] = $value * 100;
    }


    public function getPriceAttribute($value){
      if ($value) {
        $price = $value / 100;
		return sprintf('%.2f', $price);
      }
    }


    public function setSalePriceAttribute($value){
      $this->attributes['saleprice'] = $value * 100;
    }


    public function getSalePriceAttribute($value){
      if ($value) {
        $price = $value / 100;
		return sprintf('%.2f', $price);
      }
    }

     public function categories(){
		return $this->belongsToMany('App\Prodcat')->withTimestamps();
	}

     public function brands(){
        return $this->belongsToMany('App\Brand')->withTimestamps();
    }

     public function tags(){
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function parentproduct(){
        return $this->belongsTo(Product::class, 'parent_id', 'id');
    }
	public function path(){
		if($this->parent_id == null){
			return route('product', $this->slug);
		}else{
			return route('product', $this->parentproduct->slug);
		}
	}
    public function subproducts(){
        return $this->hasMany(Product::class, 'parent_id', 'id');
    }
    public function subproductsuser(){
        return $this->hasMany(Product::class, 'parent_id', 'id')->where('price','>', 0)->whereNotNull('variation');
    }
    public function attributes()
    {
      return $this->hasMany('App\Attribute');
    }
    public function ratings()
    {
      return $this->hasMany('App\Rating')->where('status',1)->latest();
    }
    public function setVariationAttribute($value)
    {
      $this->attributes['variation'] = json_encode($value);
    }
    public function getVariationAttribute($value)
    {
      if ($value) {
        return json_decode($value);
      }
    }
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
    public function color(){
        return $this->belongsTo(Color::class)->withDefault();
    }
    public function texture(){
        return $this->belongsTo(Texture::class)->withDefault();
    }
}
