@foreach($posts as $post)
	  <div class="col-md-4 mt-3">
		  <div class="card blog-card bg-white">
            <a href="{{route('post_details',$post->slug)}}">
                <img class="card-img-top" src="{{Voyager::image($post->image)}}" alt="{{$post->image_alt}}">
            </a>
			<div class="card-body">
			  <h5 class="card-title text-dark"><a class="text-dark" href="{{route('post_details',$post->slug)}}">{{$post->title}}</a></h5>
			  <p class="card-text mb-5">
			  {!! Str::limit(strip_tags($post->body), $limit = 200, $end = '...') !!}
			  </p>
			</div>
		  </div>
	  </div>
@endforeach
