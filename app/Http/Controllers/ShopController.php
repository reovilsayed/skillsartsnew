<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\Prodcat;
use App\Brand;
use App\Shipping;
use App\Rating;
use Voyager;
use Shop;
use Session;
class ShopController extends Controller
{
	public function  productfilter(Request $request){
		$min = $request->minimum_price * 100;

		$max = $request->maximum_price * 100;
		$category = $request->category;
		$orderbyprice = $request->orderbyprice;
		$color = $request->color;
		$texture = $request->texture;

		$products = Product::query();
		$products = $products->whereBetween('price', [$min, $max]);



		if (isset($category)) {
			$products = $products->whereHas('categories', function ($query) use ($category) {
			    $query->whereIn('prodcats.id', $category);
			});
		}
         if($request->filled("color")){
            $products = $products->where('color_id',$color);
         }
         if($request->filled("texture")){
            $products = $products->where('texture_id',$texture);
         }
		if($request->filled("orderbyprice")){
			if($orderbyprice == 'asc' || $orderbyprice == 'desc' ){
				$products = $products->orderby('price',$orderbyprice);
			}elseif($orderbyprice == 'bestsale'){
				$products = $products->orderby('sale_count','desc');
			}elseif($orderbyprice == 'new'){
				$products = $products->latest();
			}elseif($orderbyprice == 'popularity'){
				$products = $products->orderby('view','desc');
			}

		}
		$products = $products->where('status',1)->whereNull('parent_id')->paginate(8);
	    return view('components.products_ajax',compact('products'));
	}

	public function product($slug){
		$related_products = Product::inRandomOrder()->where('status',1)->limit(4)->whereNull('parent_id')->get();
		
		$categories = Prodcat::all();
		$categories->translate(app()->getLocale());

	    $product = Product::where('slug', '=', $slug)->with('subproductsuser','attributes','ratings')->firstOrFail();
		$product->translate(app()->getLocale());

		session()->put("product_id",$product->id);
		$product->increment('view');
		Session::push('last_viewed', $product->id);
		return view('product',compact('product','categories','related_products'));
	}
	public function shipping(Request $request){
		$shipping = Shipping::find($request->shipping_id);
		Session::put('shipping_method', $shipping->Shipping_method);
		Session::put('shipping_cost', $shipping->shipping_cost);
	}
}
