@extends('layouts.app')
@section('title', 'Contact')
@section('meta-description')
@section('css')

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
