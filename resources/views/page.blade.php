@extends('layouts.app')
@section('title', $page->translate(app()->getLocale())->title)
@section('meta-description', $page->translate(app()->getLocale())->meta_description)

@section('social_media')
    <meta property="og:title" content="{{ $page->translate(app()->getLocale())->title }}" />
    <meta property="og:description"content="{{ $page->translate(app()->getLocale())->meta_description }}" />
    <meta property="og:url" content="{{ route('page', $page->slug) }}" />
    <meta property="og:image" content="{{ Voyager::image(setting('site.social_image')) }}" />
@endsection
@section('css')
    <style>
        .description img {
            max-width: 100% !important;
        }
        .description_bold p strong {
                font-weight: 700 !important;
                font-family: sans-serif !important;
                font-size: large;
            }
        ul li strong{
                font-family: learges !important;
            }
    </style>
    @if (App::getLocale() == 'en')
        <style>
            .blogeSection {
                direction: ltr;
            }
        </style>
    @endif>
@stop
@section('content')


    <div id="tf-blog" class="blog-page sec-padding">
        <div class="container">
            <div class="sec-title text-center mb50">
                <h1 class="blogeSection">{{ $page->translate(app()->getLocale())->title }}</h1>
                <div class="devider"><img src="{{ asset('home-page/img/skills-icon.png') }}" alt="skills arts logo icon">
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-md-12 mb-5 mb-lg-0">
                    <div class="post-wrap transition shadow p-3">
                        <!-- <span class="small mb-2 d-block">{{ $page->created_at->format('M d, Y') }}</span> -->

                        <div class="clearfix">

                        </div>
                        <div class="description description_bold" @if (App::getLocale() == 'en') dir="ltr" style="text-align: left" @else dir="rtl" @endif>
                            {!! $page->translate(app()->getLocale())->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
