<div>
   
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label text-md-right text-dark">موبايل</label>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <select wire:model="country"  name="country" class="form-control mt-2 bg-white text-dark" style="border:none" id="">
                        @foreach ($codes as $code )
                        <option value="{{$code['code']}}">{{$code['region']}} ({{$code['code']}})</option>
                        @endforeach 
                        
                      </select>
                    </div>
                    <input wire:model="number" type="tel" name="phone" class="form-control bg-white text-dark"  aria-label="Text input with dropdown button">
                  </div>
               
            </div>
           
        </div>
        <br>
        
      
        @if(session()->has('otp'))
        <div class="form-group row">
            
            <label for="otp" class="col-md-4 col-form-label text-md-right text-dark">كرقم سري صالح لمرة واحدة </label>

            <div class="col-md-6">
                <input id="otp" type="text" class="form-control bg-white text-dark @error('otp') is-invalid @enderror" name="otp" required >

                @error('otp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @endif
        @if($message != null)
        <small class="text-warning">
            {{$message}}
        </small>
        @endif
        <a href="{{route('register')}}" class="text-info">مستخدم جديد </a>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-dark">
                    تسجيل الدخول
                </button>

            
                <a role="button" href="#" class="btn btn-outline-dark" wire:click="sendOtp()">
                   ارسل الرمز السري
                </a>
                 
            </div>
        </div>
    </form>
</div>
