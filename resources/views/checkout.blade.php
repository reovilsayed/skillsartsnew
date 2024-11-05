@extends('layouts.app')
@section('title', 'checkout')
@section('meta-description')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom/checkout.css') }}">

    @if (App::getLocale() == 'en')
        <style>
            #confirm_your_data {
                text-align: left
            }

            .confirm_your_data {
                text-align: left
            }
        </style>
    @endif
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
        <div dir="" class="container confirm_your_data">
            <h2 class="h1 mb-3 ">{{ __('sentence.confirm_order') }}</h2>
            <ul class="breadcrumb pl-3 pr-3">
                @if (App::getLocale() == 'ar')
                    <li class="active" class="">
                        <a href="{{ url('/ar') }}" class="transition pr-3"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li> <a href="{{ url('ar/shop') }}" class="transition pr-3 pl-3 ">{{ __('sentence.shopping_cart') }}</a>
                    </li>
                    <li> <a href="{{ url('ar/checkout') }}"
                            class="transition pr-3 pl-3">{{ __('sentence.end_of_order') }}</a>
                    </li>
                @else
                    <li class="active" class="">
                        <a href="{{ url('/en') }}" class="transition pr-3"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li> <a href="{{ url('en/shop') }}" class="transition pr-3 pl-3 ">{{ __('sentence.shopping_cart') }}</a>
                    </li>
                    <li> <a href="{{ url('en/checkout') }}"
                            class="transition pr-3 pl-3">{{ __('sentence.end_of_order') }}</a>
                    </li>
                @endif

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
                    <div class="check-form-title" id="confirm_your_data">
                        <h3 class="text-light">{{ __('sentence.confirm_your_data') }}</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <form id="checkout" method="POST" action="{{ route('checkout.store') }}">
                        @csrf
                        <div class="row">
                            @if (auth()->user()->role_id == 1)
                                <div class="col-md-6">
                                    <div class="form-group confirm_your_data">
                                        <label class="text-light " for="user_id">Select User</label>
                                        <select onchange="fetchUser()" name="user_id" id="user_id" class="form-control"
                                            @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif>
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
                                    <div class="form-group confirm_your_data">
                                        <label class="text-light" for="discount">Discount</label>
                                        <input name="custom_discount" type="number" min=".001" step="any"
                                            class="form-control" id="discount">
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="form-group confirm_your_data">
                                    <label class="text-light" for="first_name">{{ __('sentence.first_name') }}</label>
                                    <input @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif
                                        value="{{ old('first_name', $user->name) }}" type="text"
                                        class="form-control  text-light @error('first_name') is-invalid @enderror"
                                        id="first_name" placeholder="{{ __('sentence.first_name') }}" name="first_name"
                                        required>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group confirm_your_data">
                                    <label class="text-light" for="last_name">{{ __('sentence.last_name') }}</label>
                                    <input @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif
                                        value="{{ old('last_name', $user->last_name) }}" type="text"
                                        class="form-control  text-light @error('last_name') is-invalid @enderror"
                                        id="last_name" placeholder="{{ __('sentence.last_name') }}" name="last_name">
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group confirm_your_data">
                                    <label class="text-light" for="phone">{{ __('sentence.number') }}</label>
                                    <input @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif
                                        value="{{ old('phone', $user->phone) }}" type="number" minlength="6"
                                        class="form-control  text-light @error('phone') is-invalid @enderror" id="phone"
                                        placeholder="{{ __('sentence.number') }}" name="phone" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group confirm_your_data">
                                    <label class="text-light" for="email">{{ __('sentence.emali') }}</label>
                                    <input @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif
                                        value="{{ old('email', $user->email) }}" name="email" type="email"
                                        class="form-control text-light  @error('email') is-invalid @enderror"
                                        id="email" placeholder="email" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="form-group ">
                                    <button class="btn btn-red "
                                        type="submit">{{ __('sentence.confirm_order') }}</button>
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
                            <h3 class="text-light confirm_your_data">{{ __('sentence.order_data') }}</h3>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-scroll">
                            <table @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif
                                class="table-list table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">{{ __('sentence.product_image') }}</th>
                                        <th scope="col">{{ __('sentence.product') }}</th>
                                        <th scope="col">{{ __('sentence.quantity') }}</th>
                                        <th scope="col">{{ __('sentence.the_price') }}</th>
                                        <th scope="col">{{ __('sentence.delete') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::getContent() as $product)
                                        <tr>
                                            <td>
                                                <a href="{{ $product->model->path() }}" class="text-secondary">
                                                    <img src=" {{ Voyager::image($product->model->image) }}"
                                                        alt="" style="width:100px" />
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ $product->model->path() }}"
                                                    class="text-light">{{ $product->model->translate(app()->getLocale())->name }}</a>
                                                <br />
                                                @if ($product->model->variation)
                                                    {{ json_encode($product->model->variation) }}
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('cart.update') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $product->id }}" />
                                                    <div class="input-group mb-3">
                                                        <input style="width:50px;  border: 1px solid #ffffff;"
                                                            name="quantity" class="form-control" min="1"
                                                            step="1" type="number"
                                                            value="{{ $product->quantity }}">
                                                        <div class="input-group-append">
                                                            <button style="border-radius: 0" type="submit"
                                                                class="btn btn-inline py-0 px-2">{{ __('sentence.update') }}</button>
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
                    <div @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif
                        class="checkout-charge text-light">
                        <ul>
                            @if (session()->has('discount'))
                                <li><span>الخصم <a href="{{ route('coupon.destroy') }}"> ( Remove
                                            )</a></span><span>{{ Shop::price(Shop::discount()) }}</span></li>
                            @endif
                            <li>
                                <span>{{ __('sentence.the_total') }}</span>
                                <span>{{ Shop::price(Cart::getSubTotal()) }}</span>
                            </li>
                            <li>
                                <span>{{ __('sentence.total_request') }}</span>
                                <span>{{ Shop::price(Shop::newTotal()) }}</span>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 d-flex justify-content-center">
            <div class="form-group">
                <a class="btn btn-red" onclick="myFunction()">{{ __('sentence.confirm_order') }}</a>
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
