<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\Models\User;
use App\Order;
use App\Product;
use App\Post;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function dashboard()
    {
		$orders = Order::where('user_id', auth()->id())->latest()->paginate(12);
        return view('auth.dashboard',compact('orders'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required','max:40'],
            'last_name' => ['required','max:40'],
            'address' =>['required','max:200'],
            // 'city' =>['required','max:50'],
            // 'post_code' =>['required','max:10'],
            // 'state' =>['required','max:20'],
        ]);
        User::where('id',auth()->id())->update([
		   'name'=> $request->name,
		   'last_name'=> $request->last_name,
		   'address'=> $request->address,
		//    'city'=> $request->city,
		//    'post_code'=> $request->post_code,
		//    'state'=> $request->state,
		   'phone'=> $request->phone,
		]);
		return back()->with('success_msg', 'Profile updated successfully!');
    }
	function ChangePassword(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

       return back()->with('success_msg', 'Password changed successfully');
	}
    public function orders()
    {
		$orders = Order::where('user_id', auth()->id())->latest()->paginate(12);
        return view('auth.orders',compact('orders'));
    }
    public function invoice(Order $order)
    {
        $products = $order->products;
	    if($order->user_id != auth()->id()){
			 return redirect('/');
		}
        return view('auth.invoice',compact('order','products'));
    }
	public function printemail(){
		$order =  Order::find(34);
		return new OrderPlaced($order);
	}
}
