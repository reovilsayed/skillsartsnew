<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Post;
use App\Page;
use Cart;
use App\Shipping;
use App\Category;
use App\Contact;
use App\Mail\ChargeInvoice;
use App\Mail\OrderPlaced;
use App\Rating;
use App\Slider;
use App\Models\Portcat;
use App\Models\Portfolio;
use App\Models\Price;
use App\Models\Team;
use App\Order;
use App\Payment\Areeba;
use Shop;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSubmission;
use App\Mail\OrderConfirmed;
use App\Mail\OrderNotification;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{
    public function home()
    {
        $sliders_mobile = Slider::with('translations')->where('device', 'mobile')->get();
        $sliders_mobile->translate(app()->getLocale());

        $sliders_desktop = Slider::with('translations')->where('device', 'desktop')->get();
        $sliders_desktop->translate(app()->getLocale());
        
        $teams = Team::get();
        $teams->translate(app()->getLocale());

        $portcats = Portcat::get();
        $portcats->translate(app()->getLocale());

        $portfolios = Portfolio::limit(8)->get();
        $portfolios->translate(app()->getLocale());

        $prices = Price::get();
        $prices->translate(app()->getLocale());
        return view('home', compact('sliders_mobile', 'sliders_desktop', 'teams', 'portcats', 'portfolios', 'prices'));
    }
    public function fetch_user(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        return response()->json([
            'user' => $user
        ]);
    }
    public function shop(Request $request)
    {

        $products = Product::Published()->latest()->limit(24)->whereNull('parent_id')->get();
        $products->translate(app()->getLocale());
        return view('shop', compact('products'));
    }
    public function currency()
    {
        switch (request()->currency) {
            case 'usd':
                Session::put('currency', 'usd');
                break;
            default:
                Session::put('currency', 'sar');
                break;
        }
        return back();
    }

    public function blog()
    {
        $posts = Post::where('status', 'PUBLISHED')->latest()->filter(request(['search', 'category']))->paginate(12);
        $posts->translate(app()->getLocale());
        
        $categories = Category::withCount('posts')->get();
        $categories->translate(app()->getLocale());

        return view('blog', compact('posts', 'categories'));
    }
    public function post_details($slug)
    {
        $categories = Category::all()->take(5);
        $categories->translate(app()->getLocale());

        $popular_posts = Post::latest()->limit(10)->where('status', 'published')->get();
        $popular_posts->translate(app()->getLocale());

        $post = Post::with('category')->where('slug', $slug)->where('status', 'published')->firstOrFail();
        $post->translate(app()->getLocale());

        return view('post_details', compact('post', 'popular_posts', 'categories'));
    }
    public function cart()
    {
        $products = Product::inRandomOrder()->where('status', 1)->limit(4)->whereNull('parent_id')->get();
        $products->translate(app()->getLocale());

        return view('cart', compact('products'));
    }
    public function checkout()
    {
        $users = User::all();
        if (Cart::isEmpty()) {
            return redirect('/shop');
        }
        return view('checkout', compact('users'));
    }
    public function deactive_products()
    {
        $products = Product::where('status', 0)->latest()->get();
        $products->translate(app()->getLocale());

        return view('deactive_products', compact('products'));
    }
    public function thankyou()
    {
        if (request()->has('order')) {
            $order = Order::find(request()->order);

            if ($order->status == 0 && $order->payment_id != null) {
                $status = (new Areeba)->orderStatus(request()->order);
                if ($status->result == "SUCCESS") {
                    if ($order->type == 0) {
                        $order->update([
                            'status' => 1,
                            'payment_type' => 'Online',
                            'payment_status' => 1,
                        ]);
                        $mail_data = [
                            'subject' => "تم تأكيد الطلب # $order->id",
                            'title' => 'شكراً لكم تم السداد وتأكيد الطلب',
                            'opening_message' => "تم تأكيد السداد للطلب ",
                            'button' => [
                                'url' => route('orders'),
                                'text' => 'Visit'
                            ],
                            'footer' => 'شكراَ لثقتكم بنا ونسعد بخدمتكم للتواصل بنا على البريد الإلكتروني : info@skillsarts.com',
                        ];

                        Mail::send(new OrderNotification($order, $mail_data));
                    } else {
                        $charge    = $order->charges()->where('status', 0)->first();
                        if ($charge) {
                            $charge->update([
                                'status' => 1
                            ]);

                            if ($order->charges()->where('status', 1)->sum('amount') < $order->total) {
                                $order->update([
                                    'status' => 0,
                                    'payment_type' => 'Online',
                                    'payment_status' => 2,
                                ]);
                                $date = $order->created_at->format('M d, Y');
                                $mail_data = [
                                    'subject' => "استلام دفعة من قيمة الطلب رقم  # $order->id",
                                    'title' => "دفعة من قيمة الطلب رقم  # $order->id",
                                    'opening_message' => " السلام عليكم $order->first_name  $order->last_name  <br> شكراً لك، تم استلام دفعة من قيمة الطلب الذي تم في تاريخ:$date <br />
                                    تجد ادناه تفاصيل الطلب ",
                                    'button' => [
                                        'url' => route('payment', $order),
                                        'text' => 'للتفاصيل'
                                    ],
                                    'footer' => 'شكراَ لثقتكم بنا ونسعد بخدمتكم للتواصل بنا على البريد الإلكتروني : info@skillsarts.com',
                                ];

                                Mail::send(new OrderNotification($order, $mail_data));
                            } else {
                                $order->update([
                                    'status' => 1,
                                    'payment_type' => 'Online',
                                    'payment_status' => 1,
                                ]);
                                $date = $order->created_at->format('M d, Y');
                                $mail_invoice_data = [
                                    'subject' => "تم استلام الدفعة الأخيرة للطلب  # $order->id",
                                    'title' => "دفعة من قيمة الطلب رقم  # $order->id",
                                    'opening_message' => " السلام عليكم $order->first_name  $order->last_name  <br>
                                    شكراً لك، تم استلام الدفعة الأخيرة من قيمة الطلب الذي تم في تاريخ $date <br />
                                    تجد ادناه تفاصيل الطلب ",
                                    'button' => [
                                        'url' => route('payment', $order),
                                        'text' => 'للتفاصيل'
                                    ],
                                    'footer' => 'شكراَ لثقتكم بنا ونسعد بخدمتكم للتواصل بنا على البريد الإلكتروني : info@skillsarts.com',
                                ];

                                Mail::send(new OrderNotification($order, $mail_invoice_data));

                                $mail_data = [
                                    'subject' => "مبروك! تم الانتهاء من تنفيذ طلبك # $order->id",
                                    'title' => 'وأخيراً تم الإنتهاء ',
                                    'opening_message' => "تهانينا تم اكتمال طلبك ويسعدنا الرد على أي استفسار بخصوص هذا الطلب سوف يتم إرسال الملفات والتصاميم إلى البريد الإلكتروني الموجود في حسابك ",
                                    'button' => [
                                        'url' => route('orders'),
                                        'text' => 'للتفاصيل'
                                    ],
                                    'footer' => 'شكراَ لثقتكم بنا ونسعد بخدمتكم للتواصل بنا على البريد الإلكتروني: info@skillsarts.comاو على رقم الواتس الموجود في الموقع ',
                                ];

                                Mail::send(new OrderNotification($order, $mail_data));
                            }
                        }
                    }
                }
            }
        }
        return view('thankyou');
    }
    public function search()
    {
        $search = request()->search;
        
        $products = Product::where('name', 'LIKE', "%{$search}%")->where('status', 1)->limit(24)->whereNull('parent_id')->latest()->get();
        $products->translate(app()->getLocale());

        return view('search', compact('products'));
    }
    public function contact()
    {
        return view('contact');
    }
    public function contact_store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:40'],
            'email' => ['required', 'max:100', 'email'],
            'subject' => ['required', 'max:100'],
            'message' => ['required', 'max:2000','not_regex:/[(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)/'],
            'phone' => ['required']
        ],[
            'message.not_regex'=>'لدواعي الحماية يمنع استخدام الروابط في نص الرسالة'
        ]);
        // if ($this->checkUrl($request->message)) {
        //     throw ValidationException::withMessages([
        //         'message' => 'لدواعي الحماية يمنع استخدام الروابط في نص الرسالة'
        //     ]);
        // }
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'phone' => $request->phone,
        ]);

        if (auth()->check()) {
            Shop::createAlert(auth()->id(), auth()->user()->name . ' has submitted contact request');
        } else {
            Shop::createAlert(0, 'A Guest has submitted contact request');
        }

        Mail::to(setting('site.email'))->send(new EmailSubmission($contact));
        return back()->with('success', 'تم إرسال الرسالة بنجاح سوف يتم التواصل معكم من قبل فريق الدعم');
    }
    private function checkUrl($message)
    {
        //$pattern = /[(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/;
        //$pattern = "/(((https?:\/\/)|(www\.))[^\s]+)/";
        //return preg_match_all($pattern, $message);
    }
    public function page($slug)
    {
        $page = Page::where('slug', '=', $slug)->where('status', 'ACTIVE')->firstOrFail();
        return view('page', compact('page'));
    }
    public function rating(Request $request)
    {
        //return $request->all();
        Rating::create([
            "name" => $request->name,
            "email" => $request->email,
            "rating" => $request->rating,
            "review" => $request->comment,
            "product_id" => session()->get("product_id"),
        ]);
        return back()->with('success_msg', 'Thanks for your review');
        //return back()->withErrors('Sorry! One of the items in your cart is no longer Available!');
    }

    public function portfolio()
    {
        $portcats = Portcat::get();
        $portfolios = Portfolio::get();
        return view('portfolio', compact('portcats', 'portfolios'));
    }
    public function whatsapp()
    {
        return view('whatsapp');
    }
}
