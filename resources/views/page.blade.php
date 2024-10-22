@extends('layouts.app')
@section('title', $page->title)
@section('meta-description',$page->meta_description)

@section('social_media')
<meta property="og:title" content="{{ $page->title}}" />
<meta property="og:description"content="{{$page->meta_description}}" />
<meta property="og:url" content="{{route('page',$page->slug)}}" />
<meta property="og:image" content="{{Voyager::image(setting('site.social_image'))}}" />
@endsection
@section('css')
<style>
    .description img{
        max-width: 100%!important;
    }
</style>
@stop
@section('content')


    <div id="tf-blog" class="blog-page sec-padding">
        <div class="container">
            <div class="sec-title text-center mb50">
                <h1>{{ $page->title }}</h1>
                <div class="devider"><img src="{{ asset('home-page/img/skills-icon.png') }}" alt="skills arts logo icon">
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-md-12 mb-5 mb-lg-0">
                    <div class="post-wrap transition shadow p-3">
                        <!-- <span class="small mb-2 d-block">{{ $page->created_at->format('M d, Y') }}</span> -->

                        <div class="clearfix">

                        </div>
                        <div class="description" dir="rtl">
                            {!! $page->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
