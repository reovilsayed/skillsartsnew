@extends('layouts.app')
@section('title','Contact')
@section('meta-description')
@section('css')

@endsection
@section('content')
<div class="blog-header shadow bg-black">
    <div class="container">
        <h2 class="h1 mb-3">هلا فيك</h2>
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('home') }}" class="transition"> <i class="fa fa-home"></i> </a>
            </li>
            <li class="active"> <a href="{{ route('contact') }}" class="transition"> تواصل </a></li>
            <li> <a href="#" class="transition"> معنا </a></li>
        </ul>
    </div>
</div>
<x-contact/>
@endsection
