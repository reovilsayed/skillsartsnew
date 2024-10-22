@extends('layouts.app')
@section('title', 'Register')
@section('content')
    <br>
    <br>

    <div dir="rtl" class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark">
                    <div class="card-header">مستخدم جديد</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">الإسم</label>

                                <div class="col-md-6">
                                    <input id="name" oninvalid="this.setCustomValidity('هذا الحقل مطلوب')" onchange="this.setCustomValidity('')" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">البريد الإلكتروني</label>
                                <div class="col-md-6">
                                    <input id="email" oninvalid="this.setCustomValidity('يرجى التأكد من الإيميل')" onchange="this.setCustomValidity('')" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">رقم الجوال</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <select name="country" class="form-control h-100" style="border:none" id="">
                                                @foreach ($codes as $code)
                                                    <option value="{{ $code['code'] }}"
                                                        {{ old('country','966') == $code['code'] ? 'selected' : '' }}>
                                                        {{ $code['region'] }} ({{ $code['code'] }})</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <input type="tel" oninvalid="this.setCustomValidity('Please provide a valid phone number')" onchange="this.setCustomValidity('')" name="phone" value="{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror">
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
                                <label for="password" class="col-md-4 col-form-label text-md-right">كلمة السر</label>
                                <div class="col-md-6">
                                    <input id="password" oninvalid="this.setCustomValidity('يرجى التأكد من الإيميل')" onchange="this.setCustomValidity('')" type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">تأكيد كلمة السر</label>
                                <div class="col-md-6">
                                    <input id="password_confirmation" oninvalid="this.setCustomValidity('يرجى التأكد من الإيميل')" onchange="this.setCustomValidity('')" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-8">
                                    <div class="form-check">
                                        <input class="form-check-input" oninvalid="this.setCustomValidity('يجب الموافقة لتتمكن من التسجيل')" onchange="this.setCustomValidity('')" type="checkbox" name="terms_condition" value="1" id="terms_condition" required>
                                        <label class="form-check-label" for="terms_condition">
                                          يرجى الموافقة على <a class="text-red" href="{{route('page',['slug'=>'terms-and-conditions'])}}">سياسة الخصوصية</a> بالإضافة <a class="text-red" href="{{route('page',['slug'=>'Privacy-policy'])}}">للشروط والأحكام</a>
                                        </label>
                                      </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-danger mt-2">
                                        أحفظ البيانات
                                    </button>
                                    <a href="{{ route('login') }}" class="btn btn-outline-light mt-2">
                                        مستخدم سابق
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
