<div class="row product-card-parent">
    @foreach ($products as $product)
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-6">
            <!-- <div class="product-card card-gape">
     <div class="product-img">
     <a href="{{ $product->path() }}">
     <img src="{{ Voyager::image($product->thumbnail('small')) }}" alt="product">
     </a>
     </div>
     <div class="product-content">
      <div class="product-name">
       <h6><a href="{{ $product->path() }}">{{ Str::limit($product->name, $limit = 20, $end = '...') }}</a></h6>
      </div>
      <div class="product-price">
       @if (!$product->is_variable)
@if ($product->saleprice)
<h6><del class="mr-2">{{ Shop::price($product->price) }}</del>{{ Shop::price($product->saleprice) }} </h6>
@else
<h6>{{ Shop::price($product->price) }} </h6>
@endif
@endif
       @if (Shop::average_rating($product->ratings) > 0)
<div class="product-rating">
         <i class="fas fa-star"></i>
         <span>{{ Shop::average_rating($product->ratings) }}/5</span>
        </div>
@endif
      </div>
      <div class="product-btn">
       <form action="{{ route('cart.store') }}" method="post">
       @csrf
        <input type="hidden" class="form-control qty" value="1" min="1" name="quantity">
        <input type="hidden" name="product_id"value="{{ $product->id }}" />
        @if ($product->quantity > 0)
<button class="btn btn-outline"><i class="fas fa-shopping-basket"></i>أضف للسلة</button>
@else
<button class="btn btn-danger text-light" disabled>نفذت الكمية</button>
@endif
       </form>
      </div>
     </div>
    </div> -->
            <figure class="mix work-item branding">
                <div class="container">


                    <div class="card">
                        <a href="{{ $product->path() }}" class="card-link">
                            <!-- <img class="card-img" src="https://via.placeholder.com/700x550" alt="Vans"> -->
                            <img class="card-img" src="{{ Voyager::image($product->thumbnail('small')) }}"
                                alt="Vans">
                        </a>

                        <a href="#" class="card-link text-danger like">
                            <i class="fa fa-heart"></i>
                        </a>

                        <div class="card-body">
                            <h4 class="card-title"><a class="card-link"
                                    href="{{ $product->path() }}">{{ Str::limit($product->name, $limit = 20, $end = '...') }}</a>
                            </h4>
                            <h6 class="card-subtitle mb-2 text-muted">Style: VA33TXRJ5</h6>
                            <p class="card-text">
                                {{ Str::limit($product->details, $limit = 50, $end = '...') }}</p>
                            <!-- <div class="options d-flex flex-fill">
                            <select class="custom-select mr-1">
                                <option selected>Color</option>
                                <option value="1">Green</option>
                                <option value="2">Blue</option>
                                <option value="3">Red</option>
                            </select>
                            <select class="custom-select ml-1">
                                <option selected>Size</option>
                                <option value="1">41</option>
                                <option value="2">42</option>
                                <option value="3">43</option>
                            </select>
                        </div> -->
                            <div class="row">
                                @if (!$product->is_variable)
                                    @if ($product->saleprice)
                                        <div class="price">
                                            <h5 class="priceh5 mt-4 mr-2 ml-2">{{ Shop::price($product->price) }}<del
                                                    class="ml-2">{{ Shop::price($product->saleprice) }}</del></h5>
                                        </div>
                                    @else
                                        <div class="price">
                                            <h5 class="priceh5 mt-4 mr-2 ml-2">{{ Shop::price($product->price) }}</h5>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="buy d-flex justify-content-between align-items-center">

                                <div class="row align-items-center justify-content-center">
                                    <!-- <a href="#" class="primary-btn mt-5" data-text="خدمات إضافية">
                                <i class="fa fa-shopping-cart"></i>
                                </a> -->
                                </div>
                                <!-- <a href="#" class="primary-btn mt-3"><i class="fa fa-shopping-cart"></i> Add to Cart</a> -->
                                <div class="row align-items-center justify-content-center">


                                    <form action="{{ route('cart.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" class="form-control qty" value="1" min="1"
                                            name="quantity">
                                        <input type="hidden" name="product_id"value="{{ $product->id }}" />
                                        @if ($product->quantity > 0)
                                            <button class="primary-btn mt-1 disabled" data-text="أضف للسلة">
                                                <i class="fa fa-shopping-cart"></i>
                                                <span>A</span>
                                                <span>d</span>
                                                <span>d</span>
                                                <span></span>
                                                <span> t</span>
                                                <span>o</span>
                                                <span></span>
                                                <span>C</span>
                                                <span>a</span>
                                                <span>r</span>
                                                <span>t</span>
                                            </button>
                                        @else
                                            <button class="primary-btn mt-1" data-text="أضفة للسلة">
                                                <i class="fa fa-shopping-cart"></i>
                                                <span>A</span>
                                                <span>d</span>
                                                <span>d</span>
                                                <span></span>
                                                <span> t</span>
                                                <span>o</span>
                                                <span></span>
                                                <span>C</span>
                                                <span>a</span>
                                                <span>r</span>
                                                <span>t</span>

                                            </button>
                                        @endif
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </figure>

        </div>
    @endforeach
</div>


<div class="row">
    <div class="col-md-12 ajax ml-3">
        {{ $products->links() }}
    </div>
</div>
