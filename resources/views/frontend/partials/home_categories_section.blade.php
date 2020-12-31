@foreach (\App\HomeCategory::where('status', 1)->get() as $key => $homeCategory)
    @if ($homeCategory->category != null)
        <section class="mb-4">
            <div class="container">
                <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                    <div class="section-title-1 clearfix">
                        <h3 class="heading-5 strong-700 mb-0 float-lg-left">
                            <span class="mr-4">{{ __($homeCategory->category->name) }}</span>
                        </h3>
                        <ul class="inline-links float-lg-right nav mt-3 mb-2 m-lg-0">
                            <li><a href="{{ route('products.category', $homeCategory->category->slug) }}" class="active">View More</a></li>
                        </ul>
                    </div>
                    <div class="row arrow-round gutters-5">
                        
                        @foreach (filter_products(\App\Product::where('published', 1)->where('category_id', $homeCategory->category->id))->latest()->limit(12)->get() as $key => $product)
                        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                                <div class="product-box-2 bg-white alt-box my-2">
                                    <div class="position-relative overflow-hidden">
                                        <a href="{{ route('product', $product->slug) }}" class="d-block product-image h-100 text-center">
                                            <img class="img-fit lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                        </a>
                                    
                                    </div>
                                    <div class="p-md-3 p-2">
                                                <h2 class="product-title p-0">
                                                    <a href="{{ route('product', $product->slug) }}" class=" text-center text-truncate">{{ __($product->name) }}</a>
                                                </h2>
                                                <div class="price-box d-flex justify-content-center">
                                                    @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                        <del class="old-product-price  strong-400">{{ home_base_price($product->id) }}</del>
                                                    @endif
                                                    <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                                </div>
                                                <div class=" d-flex justify-content-center star-rating star-rating-sm mt-1">
                                                    {{ renderStarRating($product->rating) }}
                                                </div>
                                                <div class="pt-1 d-flex justify-content-center">
                                                    <button class=" btn btn-success"  onclick="showAddToCartModal({{ $product->id }})">
                                                        <span class="text-white"> Add To Cart</span>
                                                    </button>
                                                </div>
                                            </div>
                                </div>
                            </diV>
                        @endforeach
                        
                    </div>
                    <div class="show-more text-center mt-2 pb-3">
                        <a href="{{ route('products.category', $homeCategory->category->slug) }}" class="bg-green pl-4 pr-4 pt-2 pb-2">Show More >></a>
                    </div>
                </div>
                
            </div>
        </section>
    @endif
@endforeach
