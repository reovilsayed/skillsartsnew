<?php

namespace App\Http\Controllers;

use App\Mail\NotificationEmail;
use App\Models\User;
use App\Repository\Phone;
use Shop;
use App\Sms\Message;
use App\Traits\AssignUser;
use Darryldecode\Cart\Validators\Validator;
use Error;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class AuthenticationController extends Controller
{
    use AuthenticatesUsers,AssignUser;

    public function registerForm()
    {
        $codes  = Phone::numbers();
        return view('auth.register', compact('codes'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'country' => ['required'],
            'phone' => ['required', 'string', 'phone', 'unique:users,phone'],
        ]);
    }

    /**
     * Send otp to given number
     *
     * @param  mixed $phone
     * @return void
     */
    public function otp(string $phone, $user)
    {
        session()->forget('otp');
        $otp = rand(10000, 99999);
        $message = "رمز التحقق هو: $otp";
        Session::put('otp', $otp);
        session()->put('user_id',$user->id);
        $mail_data = [
            'subject' => 'تم إستلام رمز تحقق جديد',
            'body' => $message,
            'button_link' => route('login'),
            'button_text' => 'أضغط للدخول',
            'emails' => [],
        ];
        Mail::to($user->email)->send(new NotificationEmail($mail_data));
        if (app()->environment() == 'production') {
            (new Message($phone, $message))->send();
        }
    }

    public function checkOtp($otp)
    {
        if ($otp == session()->get('otp')) {
            session()->forget('otp');
            return true;
        }
        return false;
    }
    /**
     * Register new user
     *
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'unique:users,phone'],
            'password' => ['required', 'string','confirmed','min:8'],
        ]);
        $phone =  $request->country.''.$request->phone;
        $chk = User::where('phone',$phone)->first();
        if($chk){
            throw ValidationException::withMessages([
                'phone' => ['رقم الجوال مسجل سابقاً'],
            ]);
            return back()->withInput()->withErrors('رقم الجوال مسجل سابقاً');
        }
        event(new Registered($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $phone,
            'password' => Hash::make($request->password),
        ])));
        Shop::createAlert(0, $user->name . ' has created a account');
        //$this->otp($phone,$user);
        $this->assignUserToOrder($user);
        return redirect(route('login'));
    }

    public function loginForm()
    {
        $codes  = Phone::numbers();
        return view('auth.login', compact('codes'));
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            $this->assignUserToOrder(); //method from AssignUser trait
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $this->otp($user->phone, $user);
            return back()->withInput()->with('success', 'تم ارسال رمز التحقق إلى بريدك الإلكتروني، أضغط متابعة لتسجيل الدخول');
        }
        return back()->withInput()->withErrors('الرجاء التأكد من البريد الإلكتروني المدخل.');
    }
    public function resendOtp()
    {
        if (session()->has('user_id')) {
            $user = User::find(session()->get('user_id'));
            $this->otp($user->phone, $user);
            return back()->withInput()->with('success', 'تم ارسال رمز التحقق إلى بريدك الإلكتروني، أضغط متابعة لتسجيل الدخول');
        }
        return back()->withInput()->withErrors('الرجاء التأكد من البريد الإلكتروني المدخل.');
    }
    public function clear_session()
    {
        Session::flush();
        return back();
    }
}
