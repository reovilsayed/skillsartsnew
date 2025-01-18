@extends('layouts.app')
@section('title', 'Login')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    recaptchaCallback = function(value) {
        console.log('value');
        console.log(value);
        if (value.length > 0) {
            document.getElementById('form-submit').removeAttribute('disabled');
        }
    }
</script>
@section('css')
    @if (App::getLocale() == 'en')
        <style>
            .login_section {
                text-align: left
            }
        </style>
    @endif
@endsection
@section('content')
    <br>
    <br>
    <div @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif class="container mt-5 mb-5">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card bg-dark">
                    <div class="card-header login_section">{{ __('sentence.login') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('sentence.enter_your_email') }}</label>
                                <div class="col-md-6">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('sentence.password') }}</label>
                                <div class="col-md-6">
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        value="{{ old('password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4 login_section">
                                    <div class="g-recaptcha" data-sitekey="6LfTjLQqAAAAABxjVLtrGeVVh1WpWPLiG4-MWU2K"
                                    data-callback="recaptchaCallback"></div>
                                    <button type="submit" class="btn btn-danger mt-2" id="form-submit" disabled>{{ __('sentence.login') }}</button>
                                    <!--   <a href="{{ route('register') }}" class="btn btn-outline-light mt-2"
                                                class="text-info">
                                                مستخدم جديد </a> -->
                                    @if (App::getLocale() == 'ar')
                                        <a href="{{ url('password/reset') }}" class="btn btn-outline-light mt-2"
                                            class="text-info">{{ __('sentence.recover_password') }}</a>
                                    @else
                                        <a href="{{ url('en/password/reset') }}" class="btn btn-outline-light mt-2"
                                            class="text-info">{{ __('sentence.recover_password') }}</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
