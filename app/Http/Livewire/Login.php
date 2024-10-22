<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Sms\Message;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
class Login extends Component
{
    public $codes;
    public $number;
    public $country;
    public $phone;
public $message = null;
    public $session_otp = false;

    public function mount()
    {
        if(session()->has('otp')){
            $this->session_otp = true;
        }
        
    }

  

    public function sendOtp()
    {
        $this->phone = $this->country.$this->number;
        if(User::where('phone',$this->phone)->first()){
            session()->forget('otp');
            $otp = rand(10000,99999);
            $message = "Your OTP is : $otp";
            Session::put('otp',$otp);
            
            $response = (new Message($this->phone,$message))->send();
        }
        else{
            $message = "No User Found";
        }
      
      
    }
    
    public function render()
    {
 
        return view('livewire.login');
    }
}
