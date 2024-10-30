@extends('layouts.app') @section('title', 'blog') @section('meta-description') @section('content')
<div class="blog-header">
    <div class="container">
        <h2 class="h1 mb-3">Blog</h2>
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('home') }}" class="transition"> <i class="fa fa-home"></i> </a>
            </li>
            <li class="active"><a href="{{ route('blog') }}" class="transition"> Blog </a></li>
            <li><a href="blog-post.html" class="transition"> Plog Post </a></li>
        </ul>
    </div>
</div>
<div id="tf-blog" class="blog-page sec-padding">
    <div class="container">
        <div class="sec-title text-center mb50">
            <h2>LATEST FROM THE BLOG</h2>
            <div class="devider"><img src="{{ asset('home-page/img/heydarah-icon.png') }}" alt="Heydarah" /></div>
        </div>
        <div class="row justify-content-between">
            <div class="col-lg-7 col-md-12 mb-5 mb-lg-0">
                @foreach ($posts as $post)
                    <div class="post-wrap transition shadow">
                        <div class="media post">
                            <div class="media-left">
                                <a href="{{ route('post_details', $post->slug) }}" class="transition">
                                    <img class="media-object" src="{{ Voyager::image($post->image) }}" alt="Heydarah" />
                                </a>
                            </div>
                            <div class="media-body">
                                <span class="small mb-2">{{ $post->created_at->format('M d, Y') }}</span>
                                <a href="{{ route('post_details', $post->slug) }}" class="transition">
                                    <h4 class="media-heading mb-3">{{ $post->title }}</h4>
                                </a>
                                <p>{!! Str::limit(strip_tags($post->body), $limit = 200, $end = '...') !!}</p>
                            </div>
                        </div>
                        <div class="post-meta">
                            <ul>
                                <li>
                                    <a href="#" class="transition">{{ $post->user->name }}</a>
                                </li>
                                <!-- <li>
                    <a href="" class="transition">20 Comments</a>
                  </li> -->
                                <li>
                                    <a href="{{ route('post_details', $post->slug) }}" class="transition">
                                        <span>Read More</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- <ul>
                <li>
                  <a href="#" class="transition"><i class="fa fa-heart"></i></a>
                   50
                  </li>
                  <li>
                    <i class="fa fa-eye"></i> 110</li>
                  </ul> -->
                        </div>
                    </div>
                @endforeach
                {{ $posts->appends(['search' => request()->query('search')])->links() }}

                <!-- <nav class="pagination-outer mt-5 text-center" aria-label="Page navigation">
                       <ul class="pagination">
                         <li class="page-item">
                           <a href="#" class="page-link shadow transition" aria-label="Previous"> <span aria-hidden="true">Prev</span> </a>
                          </li>
                          <li class="page-item">
                            <a class="page-link shadow transition" href="#">1</a>
                          </li>
                          <li class="page-item active">
                            <a class="page-link shadow transition" href="#">2</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link shadow transition" href="#">3</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link shadow transition" href="#">4</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link shadow transition" href="#">5</a>
                          </li>
                          <li class="page-item">
                             <a href="#" class="page-link shadow transition" aria-label="Next"> <span aria-hidden="true">Next</span>
                             </a>
                            </li>
                          </ul>
                        </nav> -->
            </div>
            <div class="col-lg-4 col-md-12 sidebar-widgets">
                <div class="widget-wrap">
                    <div class="single-sidebar-widget search-widget">
                        <form class="search-form">
                            <input class="form-control" placeholder="Search Posts" name="search" type="text" />
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="single-sidebar-widget user-info-widget text-center">
                        <img src="img/blog/user.jpg" alt="blog" />
                        <a href="#" class="transition">
                            <h4>Karim EzZat</h4>
                        </a>
                        <p>Senior blog writer</p>
                        <ul class="social-links">
                            <li>
                                <a href="#" class="transition"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="transition"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="transition"><i class="fa fa-github"></i></a>
                            </li>
                            <li>
                                <a href="#" class="transition"><i class="fa fa-behance"></i></a>
                            </li>
                        </ul>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to
                            make a type specimen book.
                        </p>
                    </div>
                    <div class="single-sidebar-widget popular-post-widget">
                        <h4 class="title">Popular Posts</h4>
                        <div class="popular-post-list">
                            @foreach ($posts->take(4) as $post)
                                <div class="single-post-list d-flex flex-row align-items-center">
                                    <div class="thumb"><img class="img-fluid"
                                            src="{{ Voyager::image($post->image) }}" alt="blog" /></div>
                                    <div class="details">
                                        <a href="{{ route('post_details', $post->slug) }}" class="transition">
                                            <h5>{{ $post->title }}</h5>
                                        </a>
                                        <span>{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="single-sidebar-widget post-category-widget">
                        <h4 class="title">Post Catgories</h4>
                        <ul class="cat-list">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('categoryPost', $category->slug) }}"
                                        class="d-flex justify-content-between transition">
                                        <span>{{ $category->name }}</span>
                                        <small>{{ $category->posts->count() }}</small>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    @endsection
</div>
</div>
