@extends('layouts.homeapp')
@section('title', __('sentence.site_title'))

@section('social_media')
    <meta property="og:title" content="{{ __('sentence.site_title') }}" />
    <meta property="og:description" content="{{ __('sentence.site_description') }}" />
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:image" content="{{ Voyager::image(setting('site.social_image')) }}" />
@endsection

@section('css')
    <style>
        .carousel-caption {
            top: 50%;
            transform: translateY(-50%);
            bottom: initial;

        }

        .toggleHeading {
            animation-delay: 0.5s;
            -webkit-animation-delay: 0.5s;
            -moz-animation-delay: 0.5s;
            -o-animation-delay: 0.5s;
            -moz-transition: none !important;
        }

        .toggleCaption {
            animation-delay: 0.5s;
            -webkit-animation-delay: 0.5s;
            -moz-animation-delay: 0.5s;
            -o-animation-delay: 0.5s;
            -moz-transition: none !important;
        }

        .toggleButton {
            animation-delay: 0.5s;
            -webkit-animation-delay: 1.5s;
            -moz-animation-delay: 1.5s;
            -o-animation-delay: 1.5s;
            -moz-transition: none !important;
        }

        .sec-title .devider_pricing:before {
            right: -8px;
        }

        .sec-title .devider_pricing:after {
            left: -3px;
        }
    </style>

    @if (App::getLocale() == 'en')
        <style>
            .contact_title {
                direction: ltr;
                text-align: left;
            }

            .contact_body p {
                direction: ltr !important;
                text-align: left !important;
            }

            .primary-btn {
                direction: ltr;
            }

            .contact_btn {
                text-align: end;
            }

            .services-area .service-item .service-icon {
                left: 0px !important;
                margin-left: 10px
            }

            .services-area .service-item {
                position: relative;
                padding: 35px 20px 35px 90px;
            }

            .feature-area ul.features .fa {
                float: inline-start;
            }

            .cart_title {
                text-align: left;
                display: block
            }

            .pricing-area .price_item ul {
                border-right: none;
                border-left: 1px dashed #ff3131;
                margin-left: 32px;
                padding-left: 15px;
            }

            .pricing-area .price_item:before {
                content: "Special offer";
                color: #ffffff;
                background: #ff3131;
                font-weight: bold;
                position: absolute;
                right: -27px;
                top: 29px;
                font-size: 12px;
                text-transform: uppercase;
                padding: 0px 30px;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }
        </style>
    @endif
@stop
@section('content')

    <?php if(1==2){?>
    <section class="slider">
        <div id="homeslider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($sliders_mobile as $slider)
                    @if ($slider->device == 'mobile')
                        <div class="carousel-item {{ $loop->index }} {{ $loop->index == 0 ? 'active' : '' }}">
                            <img class="d-block w-100" src="{{ Storage::url($slider->image) }}"
                                alt="{{ __('sentence.site_title') }}">
                            @if ($slider->heading)
                                <div class="carousel-caption">
                                    <h5 class="mb-3 display-4 text-red font-weight-bold toggleHeading"
                                        style="background-color: rgba(255, 255, 255, 0.685);font-size:20px">
                                        {{ $slider->heading }}
                                    </h5>
                                    <p class="toggleCaption mb-3" style="font-size:16px">{{ $slider->paragraph }}</p>
                                    <p class="toggleButton">
                                        <a href="{{ route('shop') }}"
                                            class="btn btn-red">{{ __('sentence.shop_now') }}</a>
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
            <a class="carousel-control-prev" style="right:0;left:auto" href="#homeslider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">السابق</span>
            </a>
            <a class="carousel-control-next" href="#homeslider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">التالي</span>
            </a>
        </div>
    </section>
    <?php }?>
    <style>
        #homesliderm .carousel-inner .carousel-item {
            height: 90vh;

        }

        #homesliderm .carousel-inner .carousel-item:nth-child(odd) {
            background-image: radial-gradient(#2b2c30, #333439, #2b2c30);
        }

        #homesliderm .carousel-inner .carousel-item:nth-child(even) {
            background: radial-gradient(#2b2c30, #333439, #2b2c30);
        }

        .on-mobile-font-sec {
            font-size: 20px;
        }

        @media(max-width: 540px) {
            .on-mobile-font {
                font-size: 28px !important
            }

            .on-mobile-font-sec {
                font-size: 16px;
            }
        }
    </style>
    <section class="slider">
        <div id="homesliderm" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($sliders_desktop as $slider)
                    @if ($slider->device == 'desktop')
                        <div class="carousel-item {{ $loop->index }} {{ $loop->index == 0 ? 'active' : '' }}">
                            <img class="d-block w-100" src="{{ Storage::url($slider->image) }}"
                                alt="{{ __('sentence.site_title') }}">
                            @if ($slider->heading)
                                <div class="carousel-caption">
                                    <h5 class="mb-3 display-4 text-red font-weight-bold on-mobile-font"
                                        style="background-color: rgba(255, 255, 255, 0.678);opacity: .6;">
                                        {{ $slider->translate(app()->getLocale())->heading }}
                                    </h5>
                                    <p class="toggleCaption mb-3 on-mobile-font-sec">
                                        {{ $slider->translate(app()->getLocale())->paragraph }}
                                    </p>
                                    <p class="toggleButton">
                                        @if (App::getLocale() == 'ar')
                                            <a href="{{ url('/shop') }}"
                                                class="btn btn-red">{{ __('sentence.shop_now') }}</a>
                                        @else
                                            <a href="{{ url('en/shop') }}"
                                                class="btn btn-red">{{ __('sentence.shop_now') }}</a>
                                        @endif
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
            <a class="carousel-control-prev" style="right:0;left:auto" href="#homesliderm" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">السابق</span>
            </a>
            <a dir="" class="carousel-control-next" href="#homesliderm" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">التالي</span>
            </a>
        </div>
    </section>


    @if (Voyager::setting('permission.about') == 1)
        <section id="about" class="sec-padding about-area bg-light-black">
            <div class="container">
                <!-- section title -->
                <div class="sec-title text-center mb50">
                    <h2>{{ __('sentence.who_we_are') }}</h2>
                    <div class="devider">
                        <img src="{{ asset('home-page/img/skills-icon.webp') }}"
                            alt="ايقونة شعار سكيلز آرتس لتصميم بروفايل الشركات">
                        <!-- small image icon between divider -->
                    </div>
                </div>
                <!-- /section title -->

                <div class="about-slider bg-light-black shadow">
                    <div class="item mb-4">
                        <div class="about-item" @if (App::getLocale() == 'en') dir="rtl" @else dir="ltr" @endif>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <img class="img-fluid" src="images/skillsartsaboutus.webp"
                                        alt="هوية تجارية من تصميم سكيلز آرتس للتصميم">
                                </div>
                                <div class="col-lg-6 col-md-12 pr-5 pr-5  py-4">
                                    <h3 class="mb-3 contact_title">{{ __('sentence.skills_arts') }}<span>؟</span></h3>
                                    <p class="contact_title">{{ __('sentence.about_page') }}</p> <br>

                                    <ul class="social-links mt-2 contact_title">
                                        <li class="mr-2">
                                            <a href="https://www.facebook.com/skillsarts1/" rel="nofollow">
                                                <i class="fa fa-facebook fa-2x"></i>
                                            </a>
                                        </li>
                                        <li class="mr-2">
                                            <a href="https://instagram.com/skillsarts_agency/" rel="nofollow">
                                                <i class="fa fa-instagram fa-2x"></i>
                                            </a>
                                        </li>
                                        <li class="mr-2">
                                            <a href="https://twitter.com/skillsarts1/" rel="nofollow">
                                                <i class="fa fa-twitter fa-2x"></i>
                                            </a>
                                        </li>
                                        <li class="mr-2">
                                            <a href="https://www.snapchat.com/add/skillsarts/" rel="nofollow">
                                                <i class="fa fa-snapchat-ghost fa-2x"></i>
                                            </a>
                                        </li>
                                        <li class="mr-2">
                                            <a href="https://wa.me/966593031810?text=السلام عليكم سكيلز آرتس">
                                                <i class="fa fa-whatsapp fa-2x"></i>
                                            </a>
                                        </li>

                                    </ul>

                                    <div class="contact_btn">
                                        <a href="https://skillsarts.com/#contact" class="primary-btn mt-4"
                                            data-text="{{ __('sentence.contact_us') }}">
                                            <span>C</span>
                                            <span>o</span>
                                            <span>n</span>
                                            <span>t</span>
                                            <span>a</span>
                                            <span>c</span>
                                            <span>t</span>
                                            <span> </span>
                                            <span>U</span>
                                            <span>s</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item mb-4">
                        <div class="about-item" @if (App::getLocale() == 'en') dir="rtl" @else dir="ltr" @endif>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <img class="img-fluid" src="images/aboutuss.webp"
                                        alt="موقع الكتروني من تصميم سكيلز آرتس لتصميم المواقع">
                                </div>
                                <div class="col-lg-6 col-md-12 pr-5 pl-5  py-4">
                                    <h3 class="mb-3 contact_title">{{ __('sentence.our_customers') }}<span></span></h3>
                                    <p class="contact_title">{{ __('sentence.about_page_two') }}</p>

                                    <div class="contact_btn">
                                        <a href="https://skillsarts.com/#contact" class="primary-btn mt-4"
                                            data-text="{{ __('sentence.contact_us') }}">
                                            <span>C</span>
                                            <span>o</span>
                                            <span>n</span>
                                            <span>t</span>
                                            <span>a</span>
                                            <span>c</span>
                                            <span>t</span>
                                            <span> </span>
                                            <span>U</span>
                                            <span>s</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </section>
    @endif


    @if (Voyager::setting('permission.services') == 1)
        <section id="services" class="sec-padding services-area bg-black">
            <div class="container">
                <!-- section title -->
                <div class="sec-title text-center mb50">
                    <h2>{{ __('sentence.our_services_one') }}</h2>
                    <div class="devider"><img src="{{ asset('home-page/img/skills-icon.webp') }}"
                            alt="ايقونة شعار سكيلز آرتس لتصميم بروفايل الشركات">
                        <!-- small image icon between divider -->
                    </div>
                </div>
                <!-- / section title -->
                <div class="row">
                    <!-- service item -->
                    @foreach ($services as $service)
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <div class="service-item d-flex">
                                <div class="effect transition"></div>
                                <div class="service-icon transition">
                                    <img style="width: 100%; height:100%" src="{{ Storage::url($service->icon) }}"
                                        alt="">
                                </div>

                                <div class="service-desc">
                                    <a href="https://skillsarts.com/page/design-commercial-identity-graphic-designs">
                                        <h4 class="contact_title">{{ $service->translate(app()->getLocale())->title }}
                                        </h4>
                                        <h5 class="contact_body">{!! $service->translate(app()->getLocale())->body !!}</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- end service item -->
                    {{-- <div class="col-lg-4 col-md-12">
                    <div class="service-item">
                        <div class="effect transition"></div>
                        <div class="service-icon transition">
                            <i class="fas fa-palette"></i>
                        </div>

                        <div class="service-desc">
                            <a href="https://www.artisan.com.sa">
                                <h4 class="contact_title">{{ __('sentence.Design') }}</h4>
                            </a>
                            <a href="https://www.artisan.com.sa/logo-design/">
                                <p class="contact_title">{{ __('sentence.Logo_Design') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/brand-identity/">
                                <p class="contact_title">{{ __('sentence.Brand_Identity') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/campaign-design/">
                                <p class="contact_title">{{ __('sentence.Campaign_Design') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/digital-drawings/">
                                <p class="contact_title">{{ __('sentence.Digital_Drawing') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/social-media-designs/">
                                <p class="contact_title">{{ __('sentence.Social_Media_Designs') }}</p>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="service-item">
                        <div class="effect transition"></div>
                        <div class="service-icon transition">
                            <i class="fas fa-play"></i>
                        </div>

                        <div class="service-desc">
                            <a href="https://www.artisan.com.sa">
                                <h4 class="contact_title">{{ __('sentence.Media') }}</h4>
                            </a>
                            <a href="https://www.artisan.com.sa/motion-graphics-video/">
                                <p class="contact_title">{{ __('sentence.Motion_Graphics_Video') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/documentary-video/">
                                <p class="contact_title">{{ __('sentence.Documentary_Video') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/drone-videography/">
                                <p class="contact_title">{{ __('sentence.Drone_Videography') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/photography/">
                                <p class="contact_title">{{ __('sentence.Photography') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/event-photography/">
                                <p class="contact_title">{{ __('sentence.Event_Photography') }}</p>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="service-item">
                        <div class="effect transition"></div>
                        <div class="service-icon transition">
                            <i class="fas fa-database"></i>
                        </div>

                        <div class="service-desc">
                            <a href="https://www.artisan.com.sa">
                                <h4 class="contact_title">{{ __('sentence.Development') }}</h4>
                            </a>
                            <a href="https://www.artisan.com.sa/websites-design/">
                                <p class="contact_title">{{ __('sentence.Websites_Design') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/online-store-development/">
                                <p class="contact_title">{{ __('sentence.Online_Store') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/mobile-apps-development/">
                                <p class="contact_title">{{ __('sentence.Mobile_Apps') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/web-apps-development/">
                                <p class="contact_title">{{ __('sentence.Web_Apps') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/event-photography/">
                                <p class="contact_title">{{ __('sentence.Artificial_Intelligence') }}</p>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="service-item">
                        <div class="effect transition"></div>
                        <div class="service-icon transition">
                            <i class="fas fa-search-location"></i>
                        </div>

                        <div class="service-desc">
                            <a href="https://www.artisan.com.sa">
                                <h4 class="contact_title">{{ __('sentence.Marketing') }}</h4>
                            </a>
                            <a href="https://www.artisan.com.sa/digital-marketing-strategy/">
                                <p class="contact_title">{{ __('sentence.Digital_Marketing_Strategy') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/social-media-management/">
                                <p class="contact_title">{{ __('sentence.Social_Media_Management') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/search-engine-optimization/">
                                <p class="contact_title">{{ __('sentence.Search_Engine_Optimization') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/google-ads/">
                                <p class="contact_title">{{ __('sentence.Google_Ads') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/social-media-ads/">
                                <p class="contact_title">{{ __('sentence.Social_Media_Ads') }}</p>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="service-item">
                        <div class="effect transition"></div>
                        <div class="service-icon transition">
                            <i class="fas fa-chart-line"></i>
                        </div>

                        <div class="service-desc">
                            <a href="https://www.artisan.com.sa">
                                <h4 class="contact_title">{{ __('sentence.Advertising') }}</h4>
                            </a>
                            <a href="https://www.artisan.com.sa/3d-letters-signages/">
                                <p class="contact_title">{{ __('sentence.Signages') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/vehicle-stickers/">
                                <p class="contact_title">{{ __('sentence.Stickers') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/banner-printing-in-riyadh/">
                                <p class="contact_title">{{ __('sentence.Printing') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/exhibition-booths/">
                                <p class="contact_title">{{ __('sentence.Exhibition_Booths') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/wp-content/uploads/2024/artisan-giveaways-catalogue.pdf">
                                <p class="contact_title">{{ __('sentence.Giveaways') }}</p>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="service-item">
                        <div class="effect transition"></div>
                        <div class="service-icon transition">
                            <i class="fas fa-cube"></i>
                        </div>

                        <div class="service-desc">
                            <a href="https://www.artisan.com.sa">
                                <h4 class="contact_title">{{ __('sentence.3D_Production') }}</h4>
                            </a>
                            <a href="https://www.artisan.com.sa/3d-architectural/">
                                <p class="contact_title">{{ __('sentence.3D_Architectural') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/3d-product-design-service/">
                                <p class="contact_title">{{ __('sentence.3D_Product_Design') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/3d-medical-visualization/">
                                <p class="contact_title">{{ __('sentence.3D_Medical_Visualization') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/3d-character-design/">
                                <p class="contact_title">{{ __('sentence.3D_Character_Design') }}</p>
                            </a>
                            <a href="https://www.artisan.com.sa/virtual-reality-augmented-reality/">
                                <p class="contact_title">{{ __('sentence.Virtual_Reality_Augmented_Reality') }}</p>
                            </a>
                        </div>

                    </div>
                </div> --}}
                </div>
            </div>
        </section>
    @endif

    @if (Voyager::setting('permission.works') == 1)
        <section id="works" class="sec-padding works-area clearfix bg-light-black">
            <div class="container">
                <div class="sec-title text-center mb50">
                    <h2>{{ __('sentence.our_business') }}</h2>
                    <div class="devider"><img src="{{ asset('home-page/img/skills-icon.webp') }}"
                            alt="ايقونة شعار سكيلز آرتس">
                    </div>
                </div>
                <div dir="rtl" class="row justify-content-center">
                    <div class="work-filter wow fadeInRight animated" data-wow-duration="500ms">
                        <ul class="text-center">
                            <li><a href="javascript:;" data-filter="all"
                                    class="active filter">{{ __('sentence.everyone') }}</a></li>
                            @foreach ($portcats as $portcat)
                                <li>
                                    <a href="javascript:;" data-filter=".{{ $portcat->key }}"
                                        class="filter">{{ $portcat->translate(app()->getLocale())->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="project-wrapper container-fluid">
                <div class="row">
                    @foreach ($portfolios as $portfolio)
                        <figure class="mix work-item  {{ $portfolio->category->key }}">

                            <img src="{{ Voyager::image($portfolio->image) }}"
                                alt="صور من أعمال سكيلز آرتس تصميم بروفايل شركة وشعار وهوية تجارية ومواقع الكترونية">

                            <figcaption class="overlay transition">
                                <a class="portfolio-lightbox" title="{{ $portfolio->category->name }}"
                                    href="{{ Voyager::image($portfolio->image) }}"><i class="fa fa-search fa-lg"></i></a>
                                <h4>{{ $portfolio->translate(app()->getLocale())->title }}
                                </h4>
                                <p>
                                    {{ $portfolio->category->translate(app()->getLocale())->name }}
                                </p>
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            </div>
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    @if (App::getLocale() == 'ar')
                        <a href="{{ url('/portfolio') }}" class="btn btn-red mt-5">{{ __('sentence.more') }}</a>
                    @else
                        <a href="{{ url('en/portfolio') }}" class="btn btn-red mt-5">{{ __('sentence.more') }}</a>
                    @endif
                </div>
            </div>
        </section>
    @endif

    @if (Voyager::setting('permission.team') == 1)
        <section id="team" class="sec-padding team-area bg-black">
            <div class="container">
                <!-- section title -->
                <div class="sec-title text-center mb50">
                    <h2>{{ __('sentence.our_team') }}</h2>
                    <div class="devider"><img src="{{ asset('home-page/img/skills-icon.webp') }}"
                            alt="ايقونة شعار سكيلز آرتس لتصميم بروفايل الشركات">
                        <!-- small image icon between divider -->
                    </div>
                </div>
                <!-- / section title -->
                <div class="row justify-content-center">
                    <!-- single member -->
                    @foreach ($teams as $team)
                        <figure class="col-lg-2 col-md-6 text-center mb-4 mb-lg-0">
                            <div class="our-team">
                                <div class="pic">
                                    <img src="{{ Voyager::image($team->image) }}"
                                        alt="صورة فريق عمل سكيلز آرتس لتصميم الهوية التجارية" class="img-fluid">
                                </div>
                                <div class="team-content">
                                    <p>{{ $team->translate(app()->getLocale())->name }}
                                    </p>
                                    <span>{{ $team->translate(app()->getLocale())->job_title }}</span>
                                    <ul class="social transition scale0">
                                        @if ($team->icon1)
                                            <li><a href="#"><img style="width:25px;height:25px"
                                                        src="{{ Voyager::image($team->icon1) }}"
                                                        alt="ايقونة برنامج التصميم"></a></li>
                                        @endif
                                        @if ($team->icon2)
                                            <li><a href="#"><img style="width:25px;height:25px"
                                                        src="{{ Voyager::image($team->icon2) }}"
                                                        alt="ايقونة برنامج التصميم"></a></li>
                                        @endif
                                        @if ($team->icon3)
                                            <li><a href="#"><img style="width:25px;height:25px"
                                                        src="{{ Voyager::image($team->icon3) }}"
                                                        alt="ايقونة برنامج التصميم"></a></li>
                                        @endif
                                        @if ($team->icon4)
                                            <li><a href="#"><img style="width:25px;height:25px"
                                                        src="{{ Voyager::image($team->icon4) }}"
                                                        alt="ايقونة برنامج التصميم"></a></li>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </figure>
                    @endforeach
                    <!-- end single member -->

                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </section>
    @endif

    @if (Voyager::setting('permission.feature') == 1)
        <section id="feature" class="sec-padding feature-area bg-light-black">
            <div class="container">
                <!-- section title -->
                <div class="sec-title text-center mb50">
                    <h2>{{ __('sentence.how_we_work') }}</h2>
                    <div class="devider"><img src="{{ asset('home-page/img/skills-icon.webp') }}"
                            alt="ايقونة شعار سكيلز آرتس لتصميم بروفايل الشركات">
                        <!-- small image icon between divider -->
                    </div>
                </div>

                <!-- / section title -->
                <!-- container -->
                <div class="row" role="tabpanel" @if (App::getLocale() == 'en') dir="ltr" @else dir="rtr" @endif>
                    <!-- row -->
                    <div class="col-lg-5 col-md-12 mb-4 mb-lg-0">
                        <!-- tab menu col 5 -->

                        <ul class="features nav nav-tabs nav-stacked" role="tablist">
                            <li class="nav-item active">
                                <!-- feature tab menu #1 -->
                                <a href="#f1" class="shadow" aria-controls="f1" data-toggle="tab">
                                    <span class="fa fa-volume-up"></span>
                                    <span class="cart_title">{{ __('sentence.we_listen') }}</span> <br><small
                                        class="cart_title">{{ __('sentence.we_section_one') }}</small>
                                </a>
                            </li>
                            <li role="presentation">
                                <!-- feature tab menu #2 -->
                                <a href="#f2" class="shadow" aria-controls="f2" role="tab" data-toggle="tab">
                                    <span class="fa fa-search-plus"></span>
                                    <span class="cart_title">{{ __('sentence.we_research') }}</span><br><small
                                        class="cart_title">{{ __('sentence.we_section_two') }}</small>
                                </a>
                            </li>
                            <li role="presentation">
                                <!-- feature tab menu #3 -->
                                <a href="#f3" class="shadow" aria-controls="f3" role="tab" data-toggle="tab">
                                    <span class="fa fa-paper-plane"></span>
                                    <span class="cart_title"> {{ __('sentence.we') }}</span><br><small
                                        class="cart_title">{{ __('sentence.we_section_three') }}</small>
                                </a>
                            </li>
                            <li role="presentation">
                                <!-- feature tab menu #4 -->
                                <a href="#f4" class="shadow" aria-controls="f4" role="tab" data-toggle="tab">
                                    <span class="fa fa-wrench"></span>
                                    <span class="cart_title">{{ __('sentence.we_process') }}</span><br><small
                                        class="cart_title">{{ __('sentence.we_section_four') }}</small>
                                </a>
                            </li>
                            <li role="presentation">
                                <!-- feature tab menu #5 -->
                                <a href="#f5" class="shadow" aria-controls="f5" role="tab" data-toggle="tab">
                                    <span class="fa fa-ticket"></span>
                                    <span class="cart_title"> {{ __('sentence.we_support') }}</span><br><small
                                        class="cart_title">{{ __('sentence.we_section_five') }}</small>
                                </a>
                            </li>
                        </ul>

                    </div><!-- end tab menu col 5 -->

                    <div class="col-lg-7 col-md-12">
                        <!-- right content col 6 -->
                        <!-- Tab panes -->
                        <div class="tab-content features-content">
                            <!-- tab content wrapper -->
                            <div role="tabpanel" class="tab-pane fade show active" id="f1">
                                <!-- feature #1 content open -->
                                <p>{{ __('sentence.we_section_title_one') }}</p>
                                <p class="mb-4"></p>
                                <img src="{{ asset('images/strategy/logo (2).webp') }}" class="img-fluid"
                                    alt="{{ __('sentence.we_section_title_one') }}">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="f2">
                                <!-- feature #2 content -->
                                <p>{{ __('sentence.we_section_title_two') }}</p>
                                <p class="mb-4"></p>
                                <img src="{{ asset('images/strategy/indetity-branding.webp') }}" class="img-fluid"
                                    alt="{{ __('sentence.we_section_title_two') }}">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="f3">
                                <!-- feature #3 content -->
                                <p>{{ __('sentence.we_section_title_three') }}</p>
                                <p class="mb-4"></p>
                                <img src="{{ asset('images/strategy/logo.webp') }}" class="img-fluid"
                                    alt="{{ __('sentence.we_section_title_three') }}">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="f4">
                                <p>{{ __('sentence.we_section_title_four') }}</p>
                                <p class="mb-4"></p>
                                <img src="{{ asset('images/strategy/profile.webp') }}" class="img-fluid"
                                    alt="{{ __('sentence.we_section_title_four') }}">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="f5">
                                <!-- feature #5 content -->
                                <p>{{ __('sentence.we_section_title_five') }}</p>
                                <p class="mb-4"></p>
                                <img src="{{ asset('images/strategy/web2.webp') }}" class="img-fluid"
                                    alt="{{ __('sentence.we_section_title_five') }}">
                            </div>
                        </div> <!-- end tab content wrapper -->
                    </div><!-- end right content col 6 -->

                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
    @endif

    <!--=============================== -->

    @if (Voyager::setting('permission.facts') == 1)
        <section id="facts" class="facts">
            <div class="parallax-overlay">
                <div class="container">
                    <!-- section title -->
                    <div class="sec-title text-center mb50">
                        <h2>{{ __('sentence.achievements') }}</h2>
                        <div class="devider"><img src="{{ asset('home-page/img/skills-icon.webp') }}"
                                alt="ايقونة شعار سكيلز آرتس لتصميم بروفايل الشركات">
                            <!-- small image icon between divider -->
                        </div>
                    </div>
                    <!-- / section title -->
                    <div class="row number-counters">
                        <!-- first count item -->
                        <div class="col-lg-3 col-md-6 text-center wow fadeInUp animated counter-box mb-4 mb-lg-0"
                            data-wow-duration="500ms">
                            <div class="counters-item">
                                <i class="fa fa-hourglass-end fa-3x"></i>
                                <strong data-to="3200">0</strong>
                                <!-- Set Your Number here. i,e. data-to="56" -->
                                <span>{{ __('sentence.customer_service') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center wow fadeInUp animated counter-box mb-4 mb-lg-0"
                            data-wow-duration="500ms" data-wow-delay="300ms">
                            <div class="counters-item">
                                <i class="fa fa-users fa-3x"></i>
                                <strong data-to="650">0</strong>
                                <!-- Set Your Number here. i,e. data-to="56" -->
                                <span>{{ __('sentence.satisfied_customer') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center wow fadeInUp animated counter-box mb-4 mb-lg-0 mb-md-0"
                            data-wow-duration="500ms" data-wow-delay="600ms">
                            <div class="counters-item">
                                <i class="fa fa-rocket fa-3x"></i>
                                <strong data-to="750">0</strong>
                                <!-- Set Your Number here. i,e. data-to="56" -->
                                <span>{{ __('sentence.project') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center wow fadeInUp animated counter-box"
                            data-wow-duration="500ms" data-wow-delay="900ms">
                            <div class="counters-item">
                                <i class="fa fa-trophy fa-3x"></i>
                                <strong data-to="330">0</strong>
                                <!-- Set Your Number here. i,e. data-to="56" -->
                                <span>{{ __('sentence.appreciation') }}</span>
                            </div>
                        </div>
                        <!-- end first count item -->

                    </div> <!-- end of row -->
                </div> <!-- end of container -->
            </div> <!-- end of parallax-overlay -->
        </section>
    @endif


    @if (Voyager::setting('permission.pricing') == 1)
        <section id="pricing" class="sec-padding pricing-area bg-light-black">
            <div class="container">
                <div class="sec-title text-center mb50">
                    <h2>{{ __('sentence.packages') }}</h2>
                    <div class="devider_pricing">
                        <img src="{{ asset('home-page/img/skills-icon.webp') }}"
                            alt="ايقونة شعار سكيلز آرتس لتصميم بروفايل الشركات">
                    </div>
                </div>
                <div class="row" @if (App::getLocale() == 'en') dir="ltr" @else dir="rtr" @endif>
                    @foreach ($prices as $price)
                        @php
                            $features = explode(',', $price->price_feature);
                        @endphp
                        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                            <div class="price_item shadow bg-black">
                                <div class="price_head">
                                    <h3>{{ $price->translate(app()->getLocale())->price_name }}</h3>

                                    <span>{{ Shop::price($price->pricing) }}</span>
                                </div>
                                <ul class="contact_title">
                                    @foreach ($features as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                                <div class="price-btn py-4 text-center">
                                    <a href="{{ $price->link }}" class="primary-btn transition"
                                        data-text="{{ __('sentence.More_details') }}">
                                        <span>S</span>
                                        <span>I</span>
                                        <span>G</span>
                                        <span>N</span>
                                        <span> </span>
                                        <span>U</span>
                                        <span>P</span>

                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-contact />
@endsection
@section('javascript')
    <script>
        var carouselContainer = $('.carousel');
        var slideInterval = 5000;

        function toggleH() {
            $('.toggleHeading').hide()
            var caption = carouselContainer.find('.active').find('.toggleHeading').addClass('animated zoomInDown').one(
                'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                function() {
                    $(this).removeClass('animated flipInX')
                });
            caption.slideToggle();
        }

        function toggleC() {
            $('.toggleCaption').hide()
            var caption = carouselContainer.find('.active').find('.toggleCaption').addClass('animated fadeInUpBig').one(
                'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                function() {
                    $(this).removeClass('animated fadeInUpBig')
                });
            caption.slideToggle();
        }

        function toggleB() {
            $('.toggleButton').hide()
            var caption = carouselContainer.find('.active').find('.toggleButton').addClass('animated zoomInUp').one(
                'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                function() {
                    $(this).removeClass('animated zoomInUp')
                });
            caption.slideToggle();
        }
        carouselContainer.carousel({
                interval: slideInterval,
                cycle: true,
                pause: "hover"

            })
            .on('slide.bs.carousel slid.bs.carousel', toggleH).trigger('slide.bs.carousel')
            .on('slide.bs.carousel slid.bs.carousel', toggleC).trigger('slide.bs.carousel')
            .on('slide.bs.carousel slid.bs.carousel', toggleB).trigger('slide.bs.carousel');
    </script>
@endsection
