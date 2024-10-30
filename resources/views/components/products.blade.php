@foreach($products as $product)
	 <div class="col-12 col-sm-6 col-md-3 col-lg-3 mb-4 ">
		<div class="product-card card-gape border">
			<div class="product-img">
			  <a href="{{$product->path()}}" class="card-link">
			    <img src="{{Voyager::image($product->thumbnail('small'))}}" alt="product">
			    <!-- <img src="https://hbr.org/resources/images/article_assets/2020/04/Apr20_07_1162572100.jpg" alt="product"> -->
			  </a>
			</div>
			<div class="product-content">
				<div class="product-name">
					<h6 class="m-3"><a href="{{$product->path()}}" class="text-dark">{{ Str::limit($product->translate(app()->getLocale())->name, $limit = 20, $end = '...')}}</a></h6>
				</div>
				<div class="product-price">
					@if(!$product->is_variable)
					   @if($product->saleprice)
						  <h6 class="text-dark"><del class="m-2 text-dark">{{ Shop::price($product->price)}}</del>{{ Shop::price($product->saleprice)}} </h6>
					   @else
						  <h6 class="text-dark m-2">{{ Shop::price($product->price)}} </h6>
					   @endif
					@endif
					@if(Shop::average_rating($product->ratings) > 0 )
						<div class="product-rating">
							<i class="fas fa-star"></i>
							<span>{{Shop::average_rating($product->ratings)}}/5</span>
						</div>
					@endif
				</div>
				<div class="product-btn">
					<form action="{{route('cart.store')}}" method="post">
					  @csrf
						 <input type="hidden" class="form-control qty" value="1" min="1" name="quantity">
						 <input type="hidden" name="product_id"value="{{$product->id}}" />
						 @if($product->quantity>0)
							<button class="btn btn-outline-primary ml-3 mt-2 mb-1"><i class="fa fa-shopping-basket"></i> {{ __('sentence.add_to_cart') }}</button>
						@else
                        <button class="btn btn-danger text-light ml-3 mt-2 mb-1" disabled>{{ __('sentence.out_of_stock') }}</button>
						@endif
					</form>
				</div>
			</div>
		</div>
	</div>
	
@endforeach

