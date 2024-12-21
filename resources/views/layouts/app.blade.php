<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ar" class="no-js">
<!--<![endif]-->

<head>
    <!-- meta charec set -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="@yield('meta-description', __('sentence.site_description'))">
    <!-- Page Title -->
    <title>@yield('title')</title>
    @yield('social_media')
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <meta name="keywords" content="agency, responsive, parallax, creative, business, html5, css3, css3 animation">
    <meta name="author" content="Karim Ezzat">
    <!-- Mobile Specific Meta -->
    <link rel="canonical" href="{{ url(Request::url()) }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700,900" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/10ec6aaa98.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('home-page/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.0.0/css/bootstrap.min.css"
        integrity="sha384-P4uhUIGk/q1gaD/NdgkBIl3a6QywJjlsFJFk7SPRdruoGddvRVSwv5qFnvZ73cpz" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('home-page/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home-page/css/owl-animation.css') }}">
    <link rel="stylesheet" href="{{ asset('home-page/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('home-page/css/animate.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('home-page/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('home-page/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .blog-header {
            margin-top: 0px;
        }

        body,
        h2,
        h1,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        i {
            font-style: normal !important
        }

        .breadcrumb {
            direction: rtl;
        }

        a:focus,
        a:hover {
            color: #ff3131 !important;
        }

        .btn-red {
            background: #ff3131 !important;
            color: #fff
        }

        .btn-red:hover {
            color: rgb(218, 211, 211) !important
        }

        .text-red {
            color: #ff3131;
        }

        .btn-outline-red {
            border: 1px solid #ff3131;
        }

        .btn-outline-red:hover {
            background: #ff3131;
        }

        #navigation {
            padding: 5px 5px;
        }

        #navigation .navbar-nav li a {
            font-size: 14px
        }

        .social-links li a {
            background: #000;
            padding: 2px 9px;
        }

        .cart-redirect-alert {
            max-width: 500px;
            position: absolute;
            margin-left: 25px;
            /* right: 25px; */
            text-align: center;
            z-index: 9999;
            top: 50px
        }

        .footer {
            padding: 30px 0;
        }

        del {
            color: #ff3131
        }
    </style>

    @if (App::getLocale() == 'en')
        <style>
            #footer_logo {
                text-align: left
            }

            #footer_links {
                text-align: left
            }

            #footer_service {
                text-align: left
            }

            #footer_search {
                text-align: left
            }

            #login {
                text-align: left
            }

            #total {
                text-align: left !important;
            }
        </style>
    @endif
    @yield('css')
    @production
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-223055103-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-223055103-1');
        </script>
        <!-- Google Tag Manager -->
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })
            (window, document, 'script', 'dataLayer', 'GTM-NK2HP76');
        </script>
        <!-- End Google Tag Manager -->
    @endproduction
    {{-- {!! ReCaptcha::htmlScriptTagJsApi() !!} --}}

    <style>
        {!! setting('code.style') !!}
    </style>
</head>

<body id="body">
    <!-- <div id="preloader">
        <div class="loader">
            <span class="loader-inner">Loading...</span>
        </div>
    </div> -->
    @if (session()->has('cart_alert'))
        <div @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif class="cart-redirect-alert">
            <div class="card bg-light">
                <button class="ml-auto border-0 shadow" id="side_cart_hide">x</button>
                <div class="card-header text-center text-success bg-dark d-flex">
                    <p>{{ __('sentence.Added to cart successfully') }}</p>
                </div>
                <div class="card-body p-1">
                    @foreach (Cart::getContent() as $product)
                        <div class="row">
                            <div class="col-2">
                                <img src=" {{ Voyager::image($product->model->image) }}" alt=""
                                    style="width:100px" />
                            </div>
                            <div class="col-9">
                                <p class="text-dark">{{ $product->model->translate(app()->getLocale())->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer bg-dark border mt-2">
                    <div class="row mb-2">
                        <div class="col-md-6 text-left text-light font-weight-bold" id="total">
                            {{ __('sentence.totle') }}</div>
                        <div class="col-md-6 text-right text-light font-weight-bold">
                            {{ Shop::price(Cart::getSubTotal()) }}</div>
                    </div>
                    <a href="{{ route('checkout') }}"
                        class="btn btn-success text-light">{{ __('sentence.checkout') }}</a>
                    <a href=""
                        class="btn btn-outline-success text-light">{{ __('sentence.continue_shoppings') }}</a>
                </div>
            </div>
        </div>
    @endif
    <div id="app">
        <header id="navigation" class="navbar navbar-expand-lg">
            <div @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif class="container-fluid">
                <div class="navbar-header">
                    @if (App::getLocale() == 'ar')
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <h2 id="logo">
                                @if (setting('site.logo'))
                                    <img src="{{ Voyager::image(setting('site.logo')) }}" alt="skillsarts logo">
                                @else
                                    {{ __('sentence.site_title') }}
                                @endif
                            </h2>
                        </a>
                    @else
                        <a class="navbar-brand" href="{{ url('/en') }}">
                            <h2 id="logo" style="height: 51px;">
                                @if (setting('site.logo'))
                                    <img style="height: 100%; width: 100%;"
                                        src="{{ Voyager::image(setting('site.logo_english')) }}"
                                        alt="skillsarts logo">
                                @else
                                    {{ __('sentence.site_title') }}
                                @endif
                            </h2>
                        </a>
                    @endif
                </div>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-bars fa-lg"></i>
                </button>
                <nav class="collapse navbar-collapse">
                    @if (app()->getLocale() == 'ar')
                        {!! menu('arabic', 'menus.bootstrap') !!}
                    @else
                        {!! menu('english', 'menus.bootstrap') !!}
                    @endif
                </nav>
                <nav class="collapse navbar-collapse">
                    <ul id="nav" class="nav navbar-nav ml-auto" id="login">
                        @guest
                            @if (App::getLocale() == 'ar')
                                <li>
                                    <a href="{{ url('/login') }}">
                                        {{ __('sentence.login') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/register') }}">
                                        {{ __('sentence.register') }}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ url('en/login') }}">
                                        {{ __('sentence.login') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('en/register') }}">
                                        {{ __('sentence.register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li>
                                <a href="#" class="navbar-link dropdown-indicator transition">
                                    {{ auth()->user()->name . ' ' . auth()->user()->last_name }}
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                </a>
                                <ul class="submenu transition">
                                    @if (App::getLocale() == 'ar')
                                        <li class="navbar-item"><a href="{{ url('/dashboard') }}"
                                                class="navbar-link">{{ __('sentence.control_panel') }}</a></li>
                                        <li class="navbar-item"><a href="{{ url('/orders') }}"
                                                class="navbar-link">{{ __('sentence.register') }}</a></li>
                                    @else
                                        <li class="navbar-item"><a href="{{ url('en/dashboard') }}"
                                                class="navbar-link">{{ __('sentence.control_panel') }}</a></li>
                                        <li class="navbar-item"><a href="{{ url('en/orders') }}"
                                                class="navbar-link">{{ __('sentence.register') }}</a></li>
                                    @endif

                                    <li class="navbar-item">
                                        <a href="{{ route('logout') }}" class="navbar-link transition"
                                            onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                            document.getElementById('logout-form').submit();">
                                            <span>{{ __('sentence.sign_out') }}</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                        <li>
                            <a href="#" class="navbar-link dropdown-indicator transition">
                                {{ Shop::currency() == 'sar' ? 'SAR' : 'USD' }}
                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </a>

                            <ul class="submenu transition">
                                <li class="navbar-item"><a href="{{ route('currency', ['currency' => 'sar']) }}"
                                        class="navbar-link">SAR</a></li>
                                <li class="navbar-item"><a href="{{ route('currency', ['currency' => 'usd']) }}"
                                        class="navbar-link">USD</a></li>
                            </ul>
                        </li>
                        <li>
                            @php
                                $english = request()->segments();
                                $arabic = request()->segments();
                                if (in_array(@$english[0], config('app.locales'))) {
                                    $english[0] = 'en';
                                } else {
                                    array_unshift($english, 'en');
                                }
                                if (in_array(@$arabic[0], config('app.locales'))) {
                                    $arabic[0] = '';
                                } else {
                                    array_unshift($arabic, '');
                                }
                                $english = implode('/', $english);
                                $arabic = implode('/', $arabic);

                            @endphp
                            <a href="#" class="navbar-link dropdown-indicator transition">
                                Languages
                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </a>
                            <ul class="submenu transition">
                                <li class="navbar-item"><a href="{{ url($english) }}"
                                        class="navbar-link">ENGLISH</a></li>
                                <li class="navbar-item"><a href="{{ url($arabic) }}" class="navbar-link">ARABIC</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            @if (App::getLocale() == 'ar')
                                <a href="{{ url('/cart') }}">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('sentence.cart') }}
                                    ( <span
                                        class="text-danger font-weight-bold">{{ Cart::getTotalQuantity() }}</span>)
                                </a>
                            @else
                                <a href="{{ url('en/cart') }}">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('sentence.cart') }}
                                    ( <span
                                        class="text-danger font-weight-bold">{{ Cart::getTotalQuantity() }}</span>)
                                </a>
                            @endif
                        </li>
                    </ul>
                </nav>
            </div>
        </header>


        @yield('content')


        <footer id="footer" class="footer bg-black">
            <div @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0" id="footer_logo">
                        <div class="footer-single">
                            @if (setting('site.logo'))
                                <img src="{{ Voyager::image(setting('site.logo')) }}" alt="SKILLSARTS LOGO">
                            @else
                                <h4>{{ __('sentence.site_title') }}</h4>
                            @endif
                            <p>المملكة العربية السعودية</p>
                            <img src="{{ asset('images/contact-us.png') }}" alt="">

                        </div>
                    </div>


                    <div class="col-lg-2 col-md-6 col-sm-6 mb-4 mb-md-0 mb-lg-0  mb-sm-0" id="footer_links">
                        <div class="footer-single">
                            <h4>{{ __('sentence.useful_links') }}</h4>
                            <ul>
                                @if (App::getLocale() == 'ar')
                                    <li><a href="{{ url('/') }}"><i class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>
                                            {{ __('sentence.home') }}</a>
                                    </li>
                                    <li><a href="{{ url('/posts') }}"><i class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>
                                            {{ __('sentence.blog') }}</a>
                                    </li>
                                    <li><a href="{{ url('/portfolio') }}"><i class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>
                                            {{ __('sentence.our_previous_work') }}</a>
                                    </li>
                                    <li><a href="{{ url('/page/website-map') }}"><i class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>
                                            {{ __('sentence.site_map') }}</a>
                                    </li>
                                    <li><a href="{{ url('/page/Privacy-policy') }}"><i
                                                class="fa fa-check-circle-o pr-1" aria-hidden="true"></i>
                                            {{ __('sentence.privacy_policy') }}</a>
                                    </li>
                                    <li><a href="{{ url('/page/terms-and-conditions') }}"><i
                                                class="fa fa-check-circle-o pr-1" aria-hidden="true"></i>
                                            {{ __('sentence.terms_conditions') }}</a>
                                    </li>
                                @else
                                    <li><a href="{{ url('/en') }}"><i class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>
                                            {{ __('sentence.home') }}</a>
                                    </li>
                                    <li><a href="{{ url('en/posts') }}"><i class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>
                                            {{ __('sentence.blog') }}</a>
                                    </li>
                                    <li><a href="{{ url('en/portfolio') }}"><i class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>
                                            {{ __('sentence.our_previous_work') }}</a>
                                    </li>
                                    <li><a href="{{ url('en/page/website-map') }}"><i
                                                class="fa fa-check-circle-o pr-1" aria-hidden="true"></i>
                                            {{ __('sentence.site_map') }}</a>
                                    </li>
                                    <li><a href="{{ url('en/page/Privacy-policy') }}"><i
                                                class="fa fa-check-circle-o pr-1" aria-hidden="true"></i>
                                            {{ __('sentence.privacy_policy') }}</a>
                                    </li>
                                    <li><a href="{{ url('en/page/terms-and-conditions') }}"><i
                                                class="fa fa-check-circle-o pr-1" aria-hidden="true"></i>
                                            {{ __('sentence.terms_conditions') }}</a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6" id="footer_service">
                        <div class="footer-single">
                            <h4>{{ __('sentence.our_services') }}</h4>
                            <ul>
                                @if (App::getLocale() == 'ar')
                                    <li><a href="{{ url('/page/company-profile-design') }}"><i
                                                class="fa fa-check-circle-o pr-1" aria-hidden="true"></i>
                                            {{ __('sentence.company_profile') }}
                                        </a></li>
                                    <li><a href="{{ url('/page/logo-design') }}"><i class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>
                                            {{ __('sentence.logo_design') }}
                                        </a></li>
                                    <li><a href="{{ url('/page/design-commercial-identity-graphic-designs') }}"><i
                                                class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>{{ __('sentence.brand_identity') }}
                                        </a></li>
                                    <li><a href="{{ url('/page/web-development') }}"><i
                                                class="fa fa-check-circle-o pr-1" aria-hidden="true"></i>
                                            {{ __('sentence.websites') }}
                                        </a></li>
                                    <li><a href="{{ url('/page/Motion-video') }}"><i
                                                class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>{{ __('sentence.motion_video') }}
                                        </a></li>
                                    <li><a href="{{ url('/page/Content-writing') }}"><i
                                                class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>{{ __('sentence.content_writing') }}
                                        </a></li>
                                @else
                                    <li><a href="{{ url('en/page/company-profile-design') }}"><i
                                                class="fa fa-check-circle-o pr-1" aria-hidden="true"></i>
                                            {{ __('sentence.company_profile') }}
                                        </a></li>
                                    <li><a href="{{ url('en/page/logo-design') }}"><i
                                                class="fa fa-check-circle-o pr-1" aria-hidden="true"></i>
                                            {{ __('sentence.logo_design') }}
                                        </a></li>
                                    <li><a href="{{ url('en/page/design-commercial-identity-graphic-designs') }}"><i
                                                class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>{{ __('sentence.brand_identity') }}
                                        </a></li>
                                    <li><a href="{{ url('en/page/web-development') }}"><i
                                                class="fa fa-check-circle-o pr-1" aria-hidden="true"></i>
                                            {{ __('sentence.websites') }}
                                        </a></li>
                                    <li><a href="{{ url('en/page/Motion-video') }}"><i
                                                class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>{{ __('sentence.motion_video') }}
                                        </a></li>
                                    <li><a href="{{ url('en/page/Content-writing') }}"><i
                                                class="fa fa-check-circle-o pr-1"
                                                aria-hidden="true"></i>{{ __('sentence.content_writing') }}
                                        </a></li>
                                @endif
                            </ul>
                        </div>
                    </div>


                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0" id="footer_search">

                        <div class="footer-single">
                            <h4>{{ __('sentence.mailing_list') }}</h4>
                            <p>{{ __('sentence.subscribe_news') }}</p>
                            <form action="#" class="subscribe mt-2">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control rounded-left"
                                        placeholder="{{ __('sentence.your_email') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-red"
                                            type="button">{{ __('sentence.subscribe') }}</button>
                                    </div>
                                </div>
                            </form>
                            <ul class="text-center social-links mt-2">
                                <li><a href="{{ Voyager::setting('social-link.twitter') }}"
                                        class="transition bg-black rounded"><i class="fa fa-twitter"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="{{ Voyager::setting('social-link.facebook') }}" class="transition"><i
                                            class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="{{ Voyager::setting('social-link.instagram') }}" class="transition"><i
                                            class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="{{ Voyager::setting('social-link.snapchat') }}" class="transition"><i
                                            class="fa fa-snapchat-ghost" aria-hidden="true"></i></a></li>
                                <li><a href="{{ Voyager::setting('social-link.linkedin') }}" class="transition"><i
                                            class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="{{ Voyager::setting('social-link.tiktok') }}" class="transition"><i
                                            class="fa fa-tiktok" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div dir="rtl" class="copyright bg-light-black" style="background: #0f0f0f">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-6">
                        <p class="copyright text-center mt-0">
                            جميع الحقوق محفوظة لموقع <span>سكيلز آرتس</span> 2022 <a href="https://skillsarts.com/"
                                target="_blank"> Skills Arts</a>© </p>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="{{ asset('images/payment.webp') }}" class="w-50">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (App::getLocale() == 'ar')
        <a href="https://wa.me/966593031810?text=السلام عليكم سكيلز آرتس" target="_blank" class="whatsapp">
            <img src="{{ Voyager::setting('whatsapp-icon.whatsapp_ar') }}" alt="whatsapp">
        </a>
    @else
        <a href="https://wa.me/966593031810?text=السلام عليكم سكيلز آرتس" target="_blank" class="whatsapp">
            <img src="{{ Voyager::setting('whatsapp-icon.whatsapp_en') }}" alt="whatsapp">
        </a>
    @endif
    <a href="javascript:void(0);" id="back-top"><i class="fa fa-angle-up fa-3x"></i></a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Single Page Nav -->
    <script src="{{ asset('home-page/js/jquery.singlePageNav.min.js') }}"></script>
    <!-- Twitter Bootstrap -->
    <script src="{{ asset('home-page/js/bootstrap.min.js') }}"></script>
    <!-- owl slider-->
    <script src="{{ asset('home-page/js/owl.carousel.min.js') }}"></script>
    <!-- jquery.Magnific popup -->
    <script src="{{ asset('home-page/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- jquery.mixitup.min -->
    <script src="{{ asset('home-page/js/jquery.mixitup.min.js') }}"></script>
    <!-- jquery.parallax -->
    <script src="{{ asset('home-page/js/jquery.parallax-1.1.3.js') }}"></script>
    <!-- jquery.countTo -->
    <script src="{{ asset('home-page/js/jquery-countTo.js') }}"></script>
    <!-- jquery.appear -->
    <script src="{{ asset('home-page/js/jquery.appear.js') }}"></script>
    <!-- Contact form validation -->
    <script src="{{ asset('home-page/js/jquery.form.js') }}"></script>
    <script src="{{ asset('home-page/js/jquery.validate.min.js') }}"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- jquery easing -->
    <script src="{{ asset('home-page/js/jquery.easing.min.js') }}"></script>
    <!-- jquery easing -->
    <script src="{{ asset('home-page/js/wow.min.js') }}"></script>
    <!-- Custom Functions -->
    <script src="{{ asset('home-page/js/custom.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#app,#side_cart_hide').click(() => {
            $('.cart-redirect-alert').hide()
        })
    </script>
    {{-- @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}')
            @endforeach
        </script>
    @endif
    @if (session()->has('success') || session()->has('error'))
        @if (App::getLocale() == 'ar')
            <script>
                Swal.fire({
                    icon: "{{ session()->has('success') ? 'success' : 'error' }}",
                    title: "{{ session()->has('success') ? 'شكرا ل' : 'Oops' }}",
                    text: "{!! session('success') ?? session('error') !!}",
                    confirmButtonText: 'متابعة',
                    confirmButtonColor: '#ff3131',
                })
            </script>
        @else
            <script>
                Swal.fire({
                    icon: "{{ session()->has('success') ? 'success' : 'error' }}",
                    title: "{{ session()->has('success') ? 'Thank you' : 'Oops' }}",
                    text: "{!! session('success') ?? session('error') !!}",
                    confirmButtonText: 'Tracking',
                    confirmButtonColor: '#ff3131',
                })
            </script>
        @endif
    @endif --}}

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}')
            @endforeach
        </script>
    @endif

    @if (session()->has('success') || session()->has('error'))
        @php
            $isArabic = App::getLocale() == 'ar';
            $iconType = session()->has('success') ? 'success' : 'error';
            $title = session()->has('success') ? ($isArabic ? 'شكرا لك' : 'Thank you') : 'Oops';
            $text = json_encode(session('success') ?? session('error'));
            $buttonText = $isArabic ? 'متابعة' : 'Confirm';
        @endphp

        <script>
            console.log("SweetAlert will display now with the following parameters:");
            console.log("Icon: {{ $iconType }}");
            console.log("Title: {{ $title }}");
            console.log("Text: {{ $text }}");

            Swal.fire({
                icon: "{{ $iconType }}",
                title: "{{ $title }}",
                text: {!! $text !!},
                confirmButtonText: "{{ $buttonText }}",
                confirmButtonColor: '#ff3131',
            }).then(() => {
                console.log("SweetAlert displayed successfully");
            });
        </script>
    @endif

    @yield('javascript')
    @stack('script')
    @production
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NK2HP76" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
    @endproduction
</body>

</html>
