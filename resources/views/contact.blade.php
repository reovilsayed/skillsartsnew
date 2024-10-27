@extends('layouts.app')
@section('title','Contact')
@section('meta-description')
@section('css')

@endsection
@section('content')
<div class="blog-header shadow bg-black">
    <div class="container" @if (App::getLocale() == 'en') style="text-align: left" @endif>
        <h2 class="h1 mb-3" @if (App::getLocale() == 'en') style="text-align: left" @endif>{{ __('sentence.welcome') }}</h2>
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('home') }}" class="transition"> <i class="fa fa-home"></i> </a>
            </li>
            <li class="active"> <a href="{{ route('contact') }}" class="transition">{{ __('sentence.communication') }}</a></li>
            <li> <a href="#" class="transition"> {{ __('sentence.with_us') }}</a></li>
        </ul>
    </div>
</div>
<x-contact/>
@endsection
