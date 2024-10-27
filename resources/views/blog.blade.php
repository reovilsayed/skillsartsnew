@extends('layouts.app')
@section('title', 'blog')
@section('meta-description')

@section('social_media')
<meta property="og:title" content="{{setting('site.title')}}" />
<meta property="og:description"content="{{setting('site.description')}}" />
<meta property="og:url" content="{{route('blog')}}" />
<meta property="og:image" content="{{Voyager::image(setting('site.social_image'))}}" />
@endsection
@section('content')
    <div class="blog-header shadow bg-black">
        <div class="container" @if (App::getLocale() == 'en') style="text-align: left" @endif>
            <h2 class="h1 mb-3" @if (App::getLocale() == 'en') style="text-align: left" @endif>{{ __('sentence.blog') }}</h2>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}" class="transition"> <i class="fa fa-home"></i> </a>
                </li>
                <li class="active"> <a href="{{ route('blog') }}" class="transition">{{ __('sentence.blog') }}</a></li>
                <li> <a href="#" class="transition">{{ __('sentence.article') }}</a></li>
            </ul>
        </div>
    </div>
    <div id="tf-blog" class="blog-page sec-padding">
        <div class="container">
            <div class="sec-title text-center mb50">
                <h2>{{ __('sentence.latest_articles') }}</h2>
                <div class="devider"><img src="{{ asset('home-page/img/skills-icon.png') }}" alt="Heydarah">
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-8 col-md-12 mb-5 mb-lg-0" >
                    @foreach ($posts as $post)
                        <div class="post-wrap transition shadow bg-black">
                            <div class="media post">
                                <div class="media-body">
                                    <span class="small mb-2">{{ $post->created_at->format('M d, Y') }}</span>
                                    <a href="{{ route('post_details', $post->slug) }}" class="transition">
                                        <h4 class="media-heading mb-3">{{ $post->title }}</h4>
                                    </a>
                                    <p> {!! Str::limit(strip_tags($post->body), $limit = 200, $end = '...') !!}</p>
                                </div>
                                <div class="media-left">
                                    <a href="{{ route('post_details', $post->slug) }}" class="transition">
                                        <img style="width: 120px" class="media-object" src="{{ Voyager::image($post->image) }}"
                                            alt="{{$post->image_alt}}" title="{{$post->seo_title}}">
                                    </a>
                                </div>
                            </div>
                            <div class="post-meta">
                                <ul>
                                    <li>
                                        <a href="{{ route('post_details', $post->slug) }}" class="transition">
                                            <span>{{ __('sentence.read_more') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                    {{ $posts->appends(['search' => request()->query('search')])->links() }}
                </div>

                <div class="col-lg-4 col-md-12 sidebar-widgets">
                    <div class="widget-wrap shadow bg-black">
                        <div class="single-sidebar-widget search-widget">
                            <form class="search-form">
                                <input class="form-control" placeholder="{{ __('sentence.search_article') }}" name="search" type="text">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="single-sidebar-widget popular-post-widget">
                            <h4 class="title">{{ __('sentence.favorite_articles') }}</h4>
                            <div class="popular-post-list">
                                @foreach ($posts->take(4) as $post)
                                    <div class="single-post-list d-flex justify-content-end flex-row align-items-center">
                                        <div class="details">
                                            <a href="{{ route('post_details', $post->slug) }}" class="transition">
                                                <h5>{{ $post->title }}</h5>
                                            </a>
                                            <span>{{ $post->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="thumb">
                                            <img style="width: 75px"
                                                src="{{ Voyager::image($post->image) }}" alt="{{$post->image_alt}}" title="{{$post->seo_title}}">
                                            </div>
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

                                            <small>{{ $category->posts_count }}</small>
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
@section('javascript')

@endsection
