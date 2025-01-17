@extends('layouts.app')
@section('title', 'Contact')
@section('meta-description')
@section('css')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

    @if (App::getLocale() == 'en')
        <style>
            .blog-header .breadcrumb li:not(:last-of-type)::after {
                content: "";
                position: absolute;
                top: 50%;
                left: -10px;
                width: 0;
                transform: translate(50%, -50%) rotate(181deg);
                height: 0;
                border-style: solid;
                border-width: 25px 12px 25px 0px;
                border-color: transparent #8d9eaf transparent transparent;
            }

            .blog-header .breadcrumb li:not(:last-of-type)::before {
                content: "";
                position: absolute;
                top: 50%;
                left: -14px;
                /* transform: translate(50%); */
                transform: translate(50%, -49%) rotate(181deg);
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 24px 13px 24px 0;
                border-color: transparent #333439 transparent transparent;
                z-index: 1;
            }
        </style>
    @endif
@endsection
@section('content')
    <div class="blog-header shadow bg-black">
        <div class="container" @if (App::getLocale() == 'en') style="text-align: left" @endif>
            <h2 class="h1 mb-3" @if (App::getLocale() == 'en') style="text-align: left" @endif>
                {{ __('sentence.welcome') }}</h2>
            <ul class="breadcrumb">
                @if (App::getLocale() == 'ar')
                    <li>
                        <a href="{{ url('/') }}" class="transition"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="active"> <a href="{{ url('/contact') }}"
                            class="transition">{{ __('sentence.communication') }}</a></li>
                    <li> <a href="#" class="transition"> {{ __('sentence.with_us') }}</a></li>
                @else
                    <li> <a href="#" class="transition"> {{ __('sentence.with_us') }}</a></li>
                    <li class="active"> <a href="{{ url('en/contact') }}"
                            class="transition">{{ __('sentence.communication') }}</a></li>
                    <li>
                        <a href="{{ url('/en') }}" class="transition"> <i class="fa fa-home"></i> </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <x-contact />
@endsection

