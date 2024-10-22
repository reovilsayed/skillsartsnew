<?php
namespace App\Shop;

use Cart;
use App\Coupon;
use App\Shipping;
use App\Models\Alert;
use Illuminate\Support\Facades\Session;
use Location;
class Shop
{
    public function price($price)
    {
      if($this->currency() =='usd'){
		return "$ ".$this->round_num($price/3.75);
	  }
	  else{
		return "SAR ".$this->round_num($price);
	  }
    }
    public function basePrice($price)
    {
      if($this->currency() =='usd'){
		return $this->round_num($price/3.75);
	  }
	  else{
		return $this->round_num($price);
	  }
    }
    public function currency()
    {
        if(session()->has('currency')){
            if(session()->get('currency') == 'sar'){
                return 'sar';
            }else{
                return 'usd';
            }
        }else{
           if($this->location() =='SA'){
            session()->put('currency','sar');
                return 'sar';
           }else{
            session()->put('currency','usd');
               return 'usd';
           };
        }
    }
    public function location()
    {
        if(env('APP_ENV') == 'local'){
            $ip = '93.178.9.129';
        }else{
            $ip = request()->ip();
        }
        $position = Location::get($this->getUserIpAddress());
        return $position->countryCode;
    }
    public function tax(){
        return 0;
		$total =  Cart::getSubTotal() - $this->discount();
		$tax = $total* 0.1304374;
		return $tax;
	}
	public function discount(){
        if($this->discount_code()){
            $coupon = Coupon::where('code',$this->discount_code())->first();
            if($coupon){
                if($coupon->minimum_cart < Cart::getSubTotal()){
                    if($coupon->coupon_type == 'percentage'){
                        $subtotal = Cart::getSubTotal();
                    return (($subtotal*$coupon->discount)/100) +session('custom_discount');
                    }else{
                        return $coupon->discount + session('custom_discount');
                    }
                }
                return session('custom_discount') ?? 0;
              }
            return session('custom_discount') ?? 0;
        }
		return session('custom_discount') ?? 0;
	}
	public function discount_code(){
		if(session()->has('discount_code')){
			return session()->get('discount_code');
		}
		return ;
	}
	public function shipping_method(){
		if(session()->has('shipping_method')){
			return session()->get('shipping_method');
		}else{
         $shipping = Shipping::first();
         return $shipping->Shipping_method;
		}
	}
	public function shipping(){
        return 0;
		if(Cart::getSubTotal() >=500){
			return 0;
		}
		return  setting('admin.shipping_cost');
	}
	public function newSubtotal(){
		return Cart::getSubTotal() - $this->discount();
	}
	public function newTotal(){
		return ($this->newSubtotal() + $this->shipping());
	}
	public function round_num($price){
		return sprintf('%.2f', $price);
	}
	public function average_rating($ratings){
		if($ratings->count() > 0){
			return $ratings->sum('rating')/$ratings->count();
		}
		return 0.00;
	}
    public function createAlert($user_id=null,$text=null)
    {
        Alert::create([
            'user_id'=>$user_id,
            'title'=>$text,
        ]);
    }
    public function getUserIpAddress() {
        $ch = curl_init('https://api.ipify.org?format=json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    
        if ($response) {
            $data = json_decode($response, true);
            return $data['ip'];
        }
    
        return 'Unable to get IP address';
    }
}
