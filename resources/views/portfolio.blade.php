@extends('layouts.app')
@section('title', setting('site.title'))
@section('css')

@stop
@section('content')
    <section id="works" class="sec-padding works-area clearfix bg-light-black">
        <div class="container">
            <div class="sec-title text-center mb50">
               <h2>{{ __('sentence.from_our_work') }}</h2>
                <div class="devider"><img src="{{ asset('home-page/img/skills-icon.png') }}" alt="Heydarah">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="work-filter wow fadeInRight animated" data-wow-duration="500ms">
                    <ul class="text-center">
                        <li><a href="javascript:;" data-filter="all" class="active filter">{{ __('sentence.everyone') }}</a></li>
                        @foreach ($portcats as $portcat)
                            <li>
                                <a href="javascript:;" data-filter=".{{ $portcat->key }}"
                                    class="filter">{{ App::getLocale() == 'ar' ? $portcat->translate('ar')->name : $portcat->translate('en')->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="project-wrapper">
            @foreach ($portfolios as $portfolio)
                <figure class="mix work-item  {{ $portfolio->category->key }}">
                    <img src="{{ Voyager::image($portfolio->image) }}" alt="Heydarah">
                    <figcaption class="overlay transition">
                        <a class="portfolio-lightbox" title="{{ $portfolio->category->name }}"
                            href="{{ Voyager::image($portfolio->image) }}"><i class="fa fa-search fa-lg"></i></a>
                        <h4>{{ App::getLocale() == 'ar' ? $portfolio->translate('ar')->titlt : $portfolio->translate('en')->title }}</h4>
                        <p>{{ App::getLocale() == 'ar' ? $portfolio->category->translate('ar')->name : $portfolio->category->translate('en')->name }}</p>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </section>


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
