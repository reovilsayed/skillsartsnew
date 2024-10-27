@extends('layouts.app')
@section('title', 'Register')
@section('css')
    @if (App::getLocale() == 'en')
        <style>
            #register_privacy_policy {
                text-align: left;
            }
            .card-header {
                text-align: left;
            }
        </style>
    @endif
@stop
@section('content')
    <br>
    <br>

    <div dir="rtl" class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8" @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif>
                <div class="card bg-dark">
                    <div class="card-header">{{ __('sentence.new_user') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('sentence.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" oninvalid="this.setCustomValidity('')"
                                        onchange="this.setCustomValidity('This field is required')" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('sentence.email') }}</label>
                                <div class="col-md-6">
                                    <input id="email" oninvalid="this.setCustomValidity('This field is required')"
                                        onchange="this.setCustomValidity('')" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('sentence.number') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <select name="country" class="form-control h-100" style="border:none"
                                                id="">
                                                @foreach ($codes as $code)
                                                    <option value="{{ $code['code'] }}"
                                                        {{ old('country', '966') == $code['code'] ? 'selected' : '' }}>
                                                        {{ $code['region'] }} ({{ $code['code'] }})</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <input type="tel"
                                            oninvalid="this.setCustomValidity('Please provide a valid phone number')"
                                            onchange="this.setCustomValidity('')" name="phone"
                                            value="{{ old('phone') }}"
                                            class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @error('country')
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
                                    <input id="password" oninvalid="this.setCustomValidity('This field is required')"
                                        onchange="this.setCustomValidity('')" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation"
                                    class="col-md-4 col-form-label text-md-right">{{ __('sentence.confirm_password') }}</label>
                                <div class="col-md-6">
                                    <input id="password_confirmation"
                                        oninvalid="this.setCustomValidity('This field is required')"
                                        onchange="this.setCustomValidity('')" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-8">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                            oninvalid="this.setCustomValidity('يجب الموافقة لتتمكن من التسجيل')"
                                            onchange="this.setCustomValidity('')" type="checkbox" name="terms_condition"
                                            value="1" id="terms_condition" required>
                                        <label class="form-check-label" id="register_privacy_policy" for="terms_condition">
                                            {{ __('sentence.please_agree_to') }}<a class="text-red"
                                                href="{{ route('page', ['slug' => 'terms-and-conditions']) }}">{{ __('sentence.to_terms_and_conditions') }}</a>{{ __('sentence.in_addition') }}<a
                                                class="text-red"
                                                href="{{ route('page', ['slug' => 'Privacy-policy']) }}">{{ __('sentence.privacy_policy') }}</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-danger mt-2">
                                        {{ __('sentence.save_data') }}
                                    </button>
                                    <a href="{{ route('login') }}" class="btn btn-outline-light mt-2">
                                        {{ __('sentence.former_user') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
