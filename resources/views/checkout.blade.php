@extends('layouts.app')
@section('title', 'checkout')
@section('meta-description')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom/checkout.css') }}">
@endsection
@section('content')
    @php
    if (Auth::check()) {
        $user = Auth::user();
    } else {
        $userarray = [
            'name' => '',
            'last_name' => '',
            'email' => '',
            'phone' => '',
            'address' => '',
            'city' => '',
            'post_code' => '',
            'state' => '',
            'country' => '',
        ];
        $user = (object) $userarray;
    }
    @endphp
    <div class="blog-header">
        <div dir="" class="container ">
            <h2 class="h1 mb-3 ">تأكيد الطلب</h2>
            <ul class="breadcrumb pl-3 pr-3">
                <li class="active" class="">
                    <a href="{{ route('home') }}" class="transition pr-3"> <i class="fa fa-home"></i> </a>
                </li>
                <li> <a href="{{ route('shop') }}" class="transition pr-3 pl-3 "> سلة المشتريات </a></li>
                <li> <a href="{{ route('checkout') }}" class="transition pr-3 pl-3">إنهاء الطلب</a></li>
            </ul>
        </div>
    </div>

    <section class="checkout-part">
        <div class="container">
            <div class="row">
                @guest
                    <div class="col-lg-12">
                        <div class="checkout-action">
                            <i class="fas fa-external-link-alt"></i>
                            <span>عميل سابق؟<a href="{{ route('login') }}">أدخل هنا</a></span>
                        </div>
                    </div>
                @endguest
                <div class="col-lg-12">
                    <div class="check-form-title">
                        <h3 class="text-light">تأكيد بياناتك</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <form id="checkout" method="POST" action="{{ route('checkout.store') }}">
                        @csrf
                        <div class="row">
                            @if (auth()->user()->role_id == 1)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-light" for="user_id">Select User</label>
                                        <select onchange="fetchUser()" name="user_id" id="user_id" class="form-control"
                                            dir="rtl">
                                            <option value="">Select User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name . ' ' . $user->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-light" for="discount">Discount</label>
                                        <input name="custom_discount" type="number" min=".001" step="any"
                                            class="form-control" id="discount">
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-light" for="first_name">الأسم الأول</label>
                                    <input dir="rtl" value="{{ old('first_name', $user->name) }}" type="text"
                                        class="form-control  text-light @error('first_name') is-invalid @enderror"
                                        id="first_name" placeholder="الإسم الأول" name="first_name" required>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-light" for="last_name">الأسم الأخير</label>
                                    <input dir="rtl" value="{{ old('last_name', $user->last_name) }}" type="text"
                                        class="form-control  text-light @error('last_name') is-invalid @enderror"
                                        id="last_name" placeholder="الإسم الأخير" name="last_name">
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-light" for="phone">رقم الجوال</label>
                                    <input dir="rtl" value="{{ old('phone', $user->phone) }}" type="number" minlength="6"
                                        class="form-control  text-light @error('phone') is-invalid @enderror" id="phone"
                                        placeholder="موبايل" name="phone" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-light" for="email">البريد الإلكتروني</label>
                                    <input dir="rtl" value="{{ old('email', $user->email) }}" name="email" type="text"
                                        class="form-control text-light  @error('email') is-invalid @enderror" id="email"
                                        placeholder="email" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="form-group">
                                    <button class="btn btn-red" type="submit">تأكيد الطلب</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (Cart::getTotalQuantity() > 0)
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="check-form-title">
                            <h3 class="text-light">بيانات الطلب</h3>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-scroll">
                            <table dir="rtl" class="table-list table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">صورة المنتج</th>
                                        <th scope="col">اسم المنتج</th>
                                        <th scope="col">الكمية</th>
                                        <th scope="col">السعر</th>
                                        <th scope="col">حذف</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::getContent() as $product)
                                        <tr>
                                            <td>
                                                <a href="{{ $product->model->path() }}" class="text-secondary">
                                                    <img src=" {{ Voyager::image($product->model->image) }}" alt=""
                                                        style="width:100px" />
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ $product->model->path() }}"
                                                    class="text-light">{{ $product->model->name }}</a> <br />
                                                @if ($product->model->variation)
                                                    {{ json_encode($product->model->variation) }}
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('cart.update') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                                    <div class="input-group mb-3">
                                                        <input style="width:50px" name="quantity" class="form-control"
                                                            min="1" step="1" type="number"
                                                            value="{{ $product->quantity }}">
                                                        <div class="input-group-append">
                                                            <input style="border-radius: 0" type="submit"
                                                                class="btn btn-inline py-0 px-2" value="تحديث">
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="text-light">{{ Shop::price($product->price) }}</td>
                                            <td class="table-action">
                                                <a href="{{ url('/cart-destroy/' . $product->id) }}"><i
                                                        class="fa fa-trash text-light"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div dir="rtl" class="checkout-charge text-light">
                        <ul>
                            @if (session()->has('discount'))
                                <li><span>الخصم <a href="{{ route('coupon.destroy') }}"> ( Remove
                                            )</a></span><span>{{ Shop::price(Shop::discount()) }}</span></li>
                            @endif
                            <li>
                                <span>المجموع</span>
                                <span>{{ Shop::price(Cart::getSubTotal()) }}</span>
                            </li>
                            <li>
                                <span>اجمالي الطلب</span>
                                <span>{{ Shop::price(Shop::newTotal()) }}</span>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 d-flex justify-content-center">
            <div class="form-group">
                <a class="btn btn-red" onclick="myFunction()">تأكيد الطلب</a>
            </div>
        </div>
    </section>





@endsection
@section('javascript')
    <script>
        function myFunction() {
            document.getElementById("checkout").submit();

        }
    </script>
    <script type="text/javascript">
        function fetchUser() {
            var user_id = $('#user_id :selected').val();
            // console.log(shipping_id);
            $.ajax({
                url: "/fetch-user",
                method: "post",
                data: {
                    user_id: user_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#first_name').val(response.user.name);
                    $('#last_name').val(response.user.last_name);
                    $('#email').val(response.user.email);
                    $('#phone').val(response.user.phone);
                }
            });
        }
    </script>
    <script>
        $('#city').val("{{ $user->city }}");
    </script>

@endsection
