<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CalculatorController;
use App\Mail\SpecialOrderConfirmed;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Voyager\OrdersController;
use Illuminate\Support\Facades\App;
use App\Mail\ChargeInvoice;
use App\Mail\OrderConfirmed;
use App\Mail\OrderInvoice;
use App\Order;
use App\Repository\Phone;
use App\Sms\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use TCG\Voyager\Facades\Voyager;
// Route::get('/',function(){
// 	return view('comming');
// })->name('comming');

Route::get('/test', function () {
    return view('home2');
});

Route::get('/', [PageController::class, 'home'])->name('home');
Route::post('fetch-user', [PageController::class, 'fetch_user'])->name('fetch_user');
Route::get('home', function(){
    return redirect(route('home'));
});

Route::get('portfolio', [PageController::class, 'portfolio'])->name('portfolio');
Route::get('product/{slug}', [ShopController::class, 'product'])->name('product');
Route::post('add-cart', [CartController::class, 'add'])->name('cart.store');
Route::get('shop', [PageController::class, 'shop'])->name('shop');
Route::get('currency', [PageController::class, 'currency'])->name('currency');
Route::get('posts', [PageController::class, 'blog'])->name('blog');
Route::get('category/posts/{slug}', [PageController::class, 'categoryPost'])->name('categoryPost');
Route::get('post/{slug}', [PageController::class, 'post_details'])->name('post_details');
Route::get('cart', [PageController::class, 'cart'])->name('cart');
Route::get('checkout', [PageController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::get('thankyou', [PageController::class, 'thankyou'])->name('thankyou');
Route::get('whatsapp', [PageController::class, 'whatsapp'])->name('whatsapp')->middleware('auth');
Route::get('page/{slug}', [PageController::class, 'page'])->name('page');
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::group(['prefix' => '{locale}'], function () {
    Route::post('contact-store', [PageController::class, 'contact_store'])->name('contact.store');
});


Route::get('calculator', [CalculatorController::class, 'show'])->name('calculator');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::group(['middleware' => 'guest'], function () {
    Route::get('register', [AuthenticationController::class, 'registerForm'])->name('register');
    Route::get('login', [AuthenticationController::class, 'loginForm'])->name('login');
    Route::post('register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('sendOtp', [AuthenticationController::class, 'sendOtp'])->name('otp');
    Route::get('resend-otp', [AuthenticationController::class, 'resendOtp'])->name('resendOtp');
    Route::get('clear-session', [AuthenticationController::class, 'clear_session'])->name('clear.session');
});


Route::get('productfilter', [ShopController::class, 'productfilter'])->name('productfilter');

Route::get('email', function () {
    $aorder = Order::first();
    return new OrderConfirmed($aorder);
});

Route::get('print-invoice/{order}', [EmailController::class, 'printInvoice'])->name('print.invoice');

Route::post('/add-cart', [CartController::class, 'add'])->name('cart.store');
Route::post('/add-update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart-destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('store-checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::post('/shipping', [ShopController::class, 'shipping'])->name('shipping');
Route::post('/add-coupon', [CouponController::class, 'add'])->name('coupon');
Route::get('/delete-coupon', [CouponController::class, 'destroy'])->name('coupon.destroy');
Route::post('rating', [PageController::class, 'rating'])->name('rating');
Route::get('search', [PageController::class, 'search'])->name('search');
Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('orders', [HomeController::class, 'orders'])->name('orders');
Route::get('invoice/{order}', [HomeController::class, 'invoice'])->name('invoice');
Route::post('user-update', [HomeController::class, 'update'])->name('user.update');
Route::post('change-password', [HomeController::class, 'ChangePassword'])->name('change.password');

Route::get('subscription', [SubscriptionController::class, 'create'])
    ->middleware('auth')
    ->name('subscription.create');
Route::post('subscription', [SubscriptionController::class, 'store'])
    ->middleware('auth')
    ->name('subscription.store');

Route::get('shipping', [ShippingController::class, 'shipping'])->name('shipping');

// payment
Route::get('payment/{order}', [CheckoutController::class, 'payment'])->name('payment')->middleware('auth');
Route::post('calculator-store', [CalculatorController::class, 'store'])->name('calculator.store');

// Route::get('emailInvoice', function () {
//     $order = Order::find(300);
//    return new ChargeInvoice($order);
// });

Route::group(['middleware' => 'admin.user'], function () {
    Route::get('deactive-products', [PageController::class, 'deactive_products'])->name('deactive_products');
    Route::get('admin/order/edit-services/{order}',[OrdersController::class,'edit_services'])->name('edit.services');
    Route::get('admin/order/update-services/{order}',[OrdersController::class,'update_services'])->name('update.services');
    Route::get('admin/order/update-services/amount/{order}',[OrdersController::class,'update_services_amount'])->name('update.services.amount');
    //create charge for services order
    Route::post('admin/order/create-charge/{order}',[OrdersController::class,'createCharge'])->name('create.charge');
    Route::get('admin/order/delete-charge/{charge}',[OrdersController::class,'deleteCharge'])->name('delete.charge');
    Route::get('admin/order/send-charge-invoice/{charge}',[OrdersController::class,'sendChargeInvoice'])->name('send.charge.invoice');
    Route::get('admin/order/send-email-invoice/{order}',[OrdersController::class,'sendEmailInvoice'])->name('send.email.invoice');
});


Route::get('/test',function(){
    $test ="//";
    $pattern = "";
    $message = 'asdaskdasd sdfsd.com';
    return preg_match($pattern, $message);
});

Route::get('lang/{locale}', function ($locale) {
    session()->put('locale',$locale);
    return redirect()->back();
});
