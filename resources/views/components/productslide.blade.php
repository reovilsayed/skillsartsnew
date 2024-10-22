@foreach($products as $product)
		<div class="product-card card-gape border">
			<div class="product-img">
			  <a href="{{$product->path()}}">
				<img src="{{Voyager::image($product->thumbnail('small'))}}" alt="product">
			  </a>
			</div>
			<div class="product-content">
				<div class="product-name">
					<h6><a href="{{$product->path()}}">{{ Str::limit($product->name, $limit = 20, $end = '...')}}</a></h6>
				</div>
				<div class="product-price">
					@if(!$product->is_variable)
					   @if($product->saleprice)
						  <h6><del class="mr-2">{{ Shop::price($product->price)}}</del>{{ Shop::price($product->saleprice)}} </h6>
					   @else
						  <h6>{{ Shop::price($product->price)}} </h6>
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
							<button class="custom-btn"><i class="fas fa-shopping-basket"></i> اضف الى السلة</button>
                        @else
                        <button class="btn btn-danger text-light" disabled>نفذت الكمية</button>
						@endif
					</form>
				</div>
			</div>
		</div>
@endforeach

