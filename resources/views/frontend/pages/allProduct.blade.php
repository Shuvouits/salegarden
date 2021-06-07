<!doctype html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Treeplant</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="application/x-javascript"> 
            addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
            function hideURLbar(){ window.scrollTo(0,1); } 
        </script>
        <!--=== Reset Css ===-->
        <link rel="stylesheet" href="{{ asset('frontend/css/normalize.css') }}">
        <!--=== Fontawesome icon ===-->
        <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
        <!--=== All Css ===-->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/default.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/component.css') }}" />
        <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{ asset('frontend/css/flexslider.css') }}" rel="stylesheet" type="text/css" media="screen" />
        <link href="{{ asset('frontend/css/animate.min.css') }}" rel="stylesheet" type="text/css" media="all" />
        <meta name="token" content="{{ csrf_token() }}">       
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>

    <body>
        <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
        <!--===============================================================================-->
        <!--header-->
        @include('frontend/layouts/menuBar')
        <!--//header-->
        <!--products-->
        <div class="products">   
            <div class="container">
                <div class="col-md-9 product-model-sec">
                    <ul class="nav nav-tabs">
                        <li class="<?php if ($preOrder == '' && $user == '' && $company == ''): ?> active<?php endif; ?>"><a href="{{ url('allProduct/') }}">All Products</a></li>
                        <li class="<?php if ($user == 'User'): ?> active<?php endif; ?>"><a href="{{ url('userProduct/') }}">Individual Products</a></li>
                        <li class="<?php if ($company == 'Company'): ?> active<?php endif; ?>"><a href="{{ url('companyProduct/') }}">Company Products</a></li>
                        <li class="<?php if ($preOrder == 'PreOrder'): ?> active<?php endif; ?>"><a href="{{ url('preOrderProduct/') }}">PreOrder Products</a></li>
                    </ul>
                    <span id="productDiv">
                        @if(count($dataList) > 0)
                        @foreach($dataList as $data)
                        <div class="col-md-4 search-product-item product-item wow slideInRight animated" data-wow-delay=".15s">
                            <div class="new-grid simpleCart_shelfItem">
                                <div class="new-top">
                                    @php
                                    $product_image = App\ProductImageModel::where('product_image_product_id', $data->product_track_id)->first();
                                    @endphp
                                    @if(!empty($product_image))
                                    <a href="{{ url('productDetails/' .$data->product_track_id ) }}"><img src="{{ asset('upload/frontend/product_image_file/' . $product_image->product_image_file) }}" class="img-responsive" alt=""/></a>
                                    @else
                                    <a href="{{ url('productDetails/' .$data->product_track_id ) }}"><img src="{{ asset('frontend/images/g11.jpg') }}" class="img-responsive" alt="" /></a>
                                    @endif
                                    <div class="new-text">
                                        <ul>
                                            <li><a class="item_add" href="{{ url('order/' . $data->product_track_id) }}"> Add to cart</a></li>
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
                </div>

                @include('frontend.layouts.sideBar')
            </div>
        </div>
        
        @include('frontend/layouts/footer')
        <!--//products-->
        <!--===============================================================================-->
        <!--=== All JS ===-->
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.js') }}"></script>    
        <script src="{{ asset('frontend/js/modernizr.custom.js') }}"></script>
        <script src="{{ asset('frontend/js/simpleCart.min.js') }}"></script>
        <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/move-top.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/easing.js') }}"></script> 
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
        <script defer src="{{ asset('frontend/js/jquery.flexslider.js') }}"></script>
        <script src="{{ asset('frontend/js/main.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
        <script src="{{ asset('frontend/js/classie.js') }}"></script>
        <script src="{{ asset('frontend/js/uisearch.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/customScript.js') }}">
        </script>
        <script>
            new UISearch(document.getElementById('sb-search'));
        </script>
    </body>

</html>