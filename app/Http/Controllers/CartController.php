<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Cart;
use App\Product;
use Shop;
class CartController extends Controller
{
    public function add(Request $request){
        if(session()->has('discount_code')){
            $coupon = Coupon::where('code',session('discount_code'))->first();
            if($coupon->allow_sale == 0){
                $product = Product::find($request->product_id);
                if($product->saleprice > 0){
                    session()->forget('discount_code');
                    session()->forget('discount');
                    return back()->withErrors('عفوا! '.session('discount_code').' القسيمة غير متوفرة لمنتجات الخصم. وتم إزالتها من عربة التسوق الخاصة بك');
                }
            }
        }
		if($request->variable_attribute){
			$variation = json_encode($request->variable_attribute);
		    $product = Product::where('parent_id',$request->product_id)->where('variation',$variation)->first();
			if(!$product){
				return back()->withErrors('للأسف هذا النوع لم يعد متوفر');
			}
		}else{
			 $product = Product::find($request->product_id);
		}
		if($product->saleprice){
			$price = $product->saleprice;
		}else{
			$price = $product->price;
		}
		Cart::add($product->id, $product->name, $price,1 )->associate('App\Product');
		
        if(auth()->check()){
            Shop::createAlert(auth()->id(),auth()->user()->name.' أضاف منتج إلى السلة');
        }else{
            Shop::createAlert(0, 'زائر أضاف منتج إلى سلته');
        }
	    return back()->with('success_msg', 'تمت إضافة المنتج إلى عربة التسوق!')->with('cart_alert','true');
	}
    public function update(Request $request){
		Cart::update($request->product_id, array(
		'quantity' => array(
				  'relative' => false,
				  'value' => $request->quantity
			  ),
		));
		return back()->with('success_msg', 'تم تحديث المنتج');
	}
	public function destroy($id){
		Cart::remove($id);
		return back()->with('success_msg', 'تم حذف المنتج');
	}
}
