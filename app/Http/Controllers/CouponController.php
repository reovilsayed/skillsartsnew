<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Coupon;
use Shop;
use Cart;
use Session;
class CouponController extends Controller
{
    public function add(request $request){
		$coupon = Coupon::where('code',$request->coupon_code)->first();
		if(!$coupon){
			session()->flash('errors', collect(['رقم الكوبون غير صحيح']));
			return back();
		}
		if(Carbon::create($coupon->expire_at) < now()){
			session()->flash('errors', collect(['الكوبون منتهي الصلاحية']));
			return back();
		}
		if($coupon->limit <= $coupon->used){
			session()->flash('errors', collect(['الكوبون منتهي الصلاحية']));
			return back();
		}
		if(Cart::getSubTotal() < $coupon->minimum_cart){
			session()->flash('errors', collect(['الحد الأدنى لإستخدام هذا الكوبون '.$coupon->minimum_cart]));
			return back();
		}
        if($coupon->allow_sale == 0){
           if($this->discounted_product_check() == false){
            return back()->withErrors('Sorry! '.$request->coupon_code.' الكوبون غير صالح');
           }
        }
		Session::put('discount', $coupon->discount);
		Session::put('discount_code', $coupon->code);
		//$coupon->increment('used');

		return back()->with('success_msg', 'تم إضافة الكوبون بنجاح');
	}
	public function destroy(){
		session()->forget('discount');
		session()->forget('discount_code');
		return back()->with('success_msg', 'تم حذف الكوبون بنجاح');
	}
    public function discounted_product_check()
    {
        foreach(Cart::getContent() as $product){
            if($product->model->saleprice > 0){
                return false;
            }
        }
    }
}
