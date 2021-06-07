<span id="productDiv">
@if(count($dataList) > 0)
                        @foreach($dataList as $data)
                        <div class="col-md-4 search-product-item product-item wow slideInRight animated" data-wow-delay=".15s">
                            <div class="new-grid simpleCart_shelfItem">
                                <div class="new-top">
                                    @if(!empty($data->product_image))
                                    <a href="{{ url('productDetails/' .$data->product_track_id ) }}"><img src="{{ asset('upload/frontend/product_image/' . $data->product_image) }}" class="img-responsive" alt="" /></a>
                                    @else
                                    <a href="{{ url('productDetails/' .$data->product_track_id ) }}"><img src="{{ asset('frontend/images/g11.jpg') }}" class="img-responsive" alt="" /></a>
                                    @endif
                                    <div class="new-text">
                                        <ul>
                                            <li><a class="item_add" href=""> Add to cart</a></li>
                                            <!-- <li><a href="single.html">Quick View </a></li> -->
                                            <li><a href="{{ url('productDetails/' .$data->product_track_id ) }}">Show Details </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="new-bottom">
                                    <h5><a class="name" href="{{ url('productDetails/' .$data->product_track_id ) }}">{{ $data->product_title }}</a></h5>
                                    <div class="ofr">
                                        @if(!empty($data->product_discount_price))
                                        <p class="pric1"><del>${{ $data->product_price }}</del></p>
                                        @endif
                                        <p><span class="item_price">${{ $data->product_price - $data->product_discount_price }}</span></p>&nbsp;
                                        <p><span class="item_price">{{ $data->product_division }}</span></p>
                                        @if($data->product_review > '4')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                        </div>  
                                        @elseif($data->product_review > '3')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                        </div>  
                                        @elseif($data->product_review > '2')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>  
                                        @elseif($data->product_review > '1')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>  
                                        @elseif($data->product_review > '0')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>  
                                        @else
                                        <div class="rating">
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>  
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        No Products added
                        @endif
                        {{ $dataList->links('frontend.layouts.custom_pagination') }}
						</span>