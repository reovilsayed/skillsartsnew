@extends('layouts.app')
@section('title', $product->name)
@section('meta-description', $product->meta_description)

@section('social_media')
<meta property="og:title" content="{{ $product->title}}" />
<meta property="og:description"content="{{$product->details}}" />
<meta property="og:url" content="{{route('product',$product->slug)}}" />
<meta property="og:image" content="{{Voyager::image($product->image)}}" />
@endsection
@section('css')
    <link href="{{ asset('js/magiczoom/magiczoom.css') }}" rel="stylesheet">
    <link href="{{ asset('js/magicscroll/magicscroll.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <style type="text/css">
        .primary-btn:hover {
            background: #ffee5c;
            border: 1px solid #ffee5c;
        }

        .product-summery span {
            color: #fff !important
        }

        .preview-slider img {
            width: auto !important
        }

    </style>
@endsection
@section('content')
    @php
    $images = json_decode($product->images);
    @endphp
    <div class="blog-header">
        <div class="container " @if (App::getLocale() == 'en') style="text-align: left" @endif>
            <h2 class="h1 mb-3 " @if (App::getLocale() == 'en') style="text-align: left" @endif>{{ $product->name }}</h2>
            <ul class="breadcrumb pl-3 pr-3">
                <li class="">
                    <a href="{{ route('home') }}" class="transition pr-3"> <i class="fa fa-home"></i> </a>
                </li>
                <li class="active"> <a href="{{ route('shop') }}" class="transition pr-3 pl-3">{{ __('sentence.the_store') }}</a></li>
                <li> <a href="{{ $product->path() }}" class="transition pr-3 pl-3">{{ $product->name }} </a></li>
            </ul>
        </div>
    </div>
    <section class="product-part py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="parent_mg_zoom"><a href="{{ Voyager::image($product->image) }}" id="product-zoom"
                            class="MagicZoom" data-options="hint: off; variableZoom: true;"
                            data-mobile-options="zoomMode: off;"><img src="{{ Voyager::image($product->image) }}"></a>
                    </div>

                    @if ($product->images)
                        <div class="MagicScroll" data-options="items:3;" data-mode="scroll"
                            style="margin-top: 25px; visibility: visible; display: inline-block; width: 100%; height: 70px; overflow: visible;">
                            <a data-zoom-id="product-zoom" href="{{ Voyager::image($product->image) }}"
                                data-image="{{ Voyager::image($product->image) }}"><img
                                    src="{{ Voyager::image($product->image) }}" /></a>
                            @foreach ($images as $image)
                                <a data-zoom-id="product-zoom" href="{{ Voyager::image($image) }}"
                                    data-image="{{ Voyager::image($image) }}"><img
                                        src="{{ Voyager::image($image) }}" /></a>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-md-6 col-lg-6">
                    <h3 class="" @if (App::getLocale() == 'en') style="text-align: left" @endif>{{ $product->name }}</h3>
                    <div class="product-price text-dark">
                        @if ($product->saleprice)
                            <h6 @if (App::getLocale() == 'en') style="text-align: left" @endif><del
                                    class="mr-2">{{ Shop::price($product->price) }}</del>{{ Shop::price($product->saleprice) }}
                            </h6>
                        @else
                            <h6 @if (App::getLocale() == 'en') style="text-align: left" @endif>{{ Shop::price($product->price) }} </h6>
                        @endif
                    </div>
                    <div class="product-summery py-3">
                        <p>{!! $product->description !!}</p>
                    </div>
                    <div class="product-cart">
                        <form action="{{ route('cart.store') }}" method="post" class="form-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            <div class="row">
                                <div class="input-group">
                                    <input type="hidden" class="form-control mr-3" value="1" min="1" name="quantity" />
                                    <button class="btn btn-red">
                                        <i class="fa fa-shopping-cart"></i>
                                        {{ __('sentence.add_to_cart') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('javascript')
    <script src="{{ asset('js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('js/custom/slick.js') }}"></script>

    <!-- FOR COMMON SCRIPT -->
    <script src="{{ asset('js/custom/main.js') }}"></script>
    <script src="{{ asset('js/magiczoom/magiczoom.js') }}"></script>
    <script src="{{ asset('js/magicscroll/magicscroll.js') }}"></script>
    <script>
        // Change product image size (adaptive)
        window.onload = function() {
            $('.changedImgSize').each(function() {
                if ($(this).height() > 210) {
                    $(this).css({
                        "height": "210px",
                        "paddingLeft": "30px",
                        "paddingRight": "30px",
                        "top": "30px"
                    });
                }
            });
        };
    </script>
@endsection
