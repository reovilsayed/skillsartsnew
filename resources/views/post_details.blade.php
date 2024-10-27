@extends('layouts.app')
@section('title', $post->title)
@section('meta-description', $post->meta_description)

@section('social_media')
<meta property="og:title" content="{{ $post->title}}" />
<meta property="og:description"content="{{$post->meta_description}}" />
<meta property="og:url" content="{{route('post_details',$post->slug)}}" />
<meta property="og:image" content="{{Voyager::image($post->image)}}" />
@endsection
@section('content')
    <div class="blog-header">
        <div class="container" @if (App::getLocale() == 'en') style="text-align: left" @endif>
            <h2 class="h2 mb-3" @if (App::getLocale() == 'en') style="text-align: left" @endif>{{ __('sentence.blog') }}</h2>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}" class="transition"> <i class="fa fa-home"></i> </a>
                </li>
                <li class="active"> <a href="{{ route('blog') }}" class="transition"> {{ __('sentence.blog') }}</a></li>
                <li> <a href="#" class="transition"> {{ __('sentence.article') }}</a></li>
            </ul>
        </div>
    </div>
    <div id="tf-blog" class="blog-page sec-padding">
        <div class="container-fluid">
            <div class="sec-title text-center mb50">
                <h1>{{ $post->title }}</h1>
                <div class="devider"><img src="{{ asset('home-page/img/skills-icon.png') }}" alt="{{$post->image_alt}}">
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-8 col-md-12 mb-5 mb-lg-0">
                    <div class="post-wrap transition shadow p-5">
                        <span class="small mb-2 d-block" @if (App::getLocale() == 'en') style="text-align: left" @endif>{{ $post->created_at->format('M d, Y') }}</span>
                        <a href="{{ url('/post/' . $post->slug) }}" class="transition">
                                                </a>

                        <div class="clearfix">
                        </div>
                        <img src="{{ Voyager::image($post->image) }}" class="img-fluid pb-3" alt="{{$post->image_alt}}" title="{{$post->seo_title}}">
                        <div class="description" @if (App::getLocale() == 'en') dir="ltr" @else dir="rtl" @endif @if (App::getLocale() == 'en') style="text-align: left" @endif> {!! $post->body !!}</div><br> <br>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 sidebar-widgets">
                    <div class="widget-wrap">
                        <div class="single-sidebar-widget popular-post-widget">
                            <h4 class="title">{{ __('sentence.favorite_articles') }}</h4>
                            <div class="popular-post-list">
                                @foreach ($popular_posts as $post)
                                    <div class="single-post-list justify-content-end d-flex flex-row align-items-center">
                                        <div class="details">
                                            <a href="{{ route('post_details', $post->slug) }}" class="transition">
                                                <h5>{{ $post->title }}</h5>
                                            </a>
                                            <span>{{ $post->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="thumb"> <img style="width: 120px"
                                                src="{{ Voyager::image($post->image) }}" alt="{{$post->image_alt}}" title="{{$post->seo_title}}"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="single-sidebar-widget post-category-widget">
                            <h4 class="title">{{ __('sentence.articles_sections') }}</h4>
                            <ul class="cat-list">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('blog', ['category' => $category->slug]) }}"
                                            class="d-flex justify-content-between transition">
                                            <small>{{ $category->posts->count() }}</small>
                                            <span>{{ $category->name }}</span>

                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
