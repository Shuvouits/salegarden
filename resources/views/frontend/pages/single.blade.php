<!doctype html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Tree Plant</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <meta property="og:title" content="{{ $dataList->product_title }}" />
        <meta property="og:description" content="{{ strip_tags($dataList->product_description) }}" />
        <meta property="og:image" content="{{ asset($imageFolder . $applicationImage) }}"/>

        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="{{ $dataList->product_title }}" />
        <meta name="twitter:description" content="{{ strip_tags($dataList->product_description) }}" />
        <meta name="twitter:image" content="{{ asset($imageFolder . $applicationImage) }}" />


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
        <style>
            .shareIcons .social-icon {
                font-size: 30px;
                width: 50px;
                line-height: 50px;
                height: 50px;
                text-align: center;
                text-decoration: none;
                margin: 5px 2px;
                border-radius: 50%;
            }
            .shareIcons .social-icon.fa:hover {
                opacity: 0.7;
            }

            .shareIcons .social-icon.fa-facebook {
                background: #3B5998;
                color: white;
            }

            .shareIcons .social-icon.fa-twitter {
                background: #55ACEE;
                color: white;
            }

            .shareIcons .social-icon.fa-google {
                background: #dd4b39;
                color: white;
            }
        </style>
    </head>

    <body>
        <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://sale.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
        <!--===============================================================================-->
        <!--header-->
        @include('frontend/layouts/menuBar')
        <!--//header-->
        <!--single-page-->
        <div class="single">
            <div class="container">
                <div class="single-info">       
                    @if (session('success'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ session('success') }}</strong>
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ session('error') }}</strong>
                    </div>
                    @endif
                    <div class="col-md-6 single-top wow fadeInLeft animated" data-wow-delay=".5s">  
                        <div class="flexslider">
                            <ul class="slides">
                                @if(count($imageList) > 0)
                                @foreach($imageList as $image)
                                <li data-thumb="{{ asset('upload/frontend/product_image_file/' . $image->product_image_file) }}" style="height: 427px; width: 352px">
                                    @if(!empty($image->product_image_file))
                                    <div class="thumb-image"> <img src="{{ asset('upload/frontend/product_image_file/' . $image->product_image_file) }}" data-imagezoom="true" class="img-responsive" alt="" style="height: 427px; width: 352px"> </div>
                                    @endif
                                </li>
                                @endforeach
                                @else
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 single-top-left simpleCart_shelfItem wow fadeInRight animated" data-wow-delay=".5s">

                        <h3>{{ $dataList->product_title }}
                        </h3>
                            
                        <div class="pull-right shareIcons">
                            <a href="javascript:void(0)" data-url="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(URL::current()) }}&title={{ $dataList->product_title }}&description={{ $dataList->product_description }}&picture={{ asset($imageFolder . $applicationImage) }}%3Fjadewits_media_id%3D1025971" class="social-icon fa fa-facebook"></a>
                            <a href="javascript:void(0)" data-url="https://twitter.com/intent/tweet?text={{ $dataList->application_title_bn }}&url={{ urlencode(URL::current()) }}"  class="social-icon fa fa-twitter"></a>
                            <a href="javascript:void(0)" data-url="https://plus.google.com/share?url={{ urlencode(URL::current()) }}"  class="social-icon fa fa-google"></a>
                        </div>
                        <div class="single-rating">
                            @if($review > '4')
                            <span class="starRating">
                                <input id="rating5" type="radio" value="5" checked>
                                <label for="rating5">5</label>
                                <input id="rating4" type="radio" value="4">
                                <label for="rating4">4</label>
                                <input id="rating3" type="radio" value="3">
                                <label for="rating3">3</label>
                                <input id="rating2" type="radio" value="2">
                                <label for="rating2">2</label>
                                <input id="rating1" type="radio" value="1">
                                <label for="rating1">1</label>
                            </span>
                            @elseif($review > '3')
                            <span class="starRating">
                                <input id="rating5" type="radio" value="5" >
                                <label for="rating5">5</label>
                                <input id="rating4" type="radio" value="4" checked>
                                <label for="rating4">4</label>
                                <input id="rating3" type="radio" value="3">
                                <label for="rating3">3</label>
                                <input id="rating2" type="radio" value="2">
                                <label for="rating2">2</label>
                                <input id="rating1" type="radio" value="1">
                                <label for="rating1">1</label>
                            </span>
                            @elseif($review > '2')
                            <span class="starRating">
                                <input id="rating5" type="radio" value="5" >
                                <label for="rating5">5</label>
                                <input id="rating4" type="radio" value="4">
                                <label for="rating4">4</label>
                                <input id="rating3" type="radio" value="3" checked>
                                <label for="rating3">3</label>
                                <input id="rating2" type="radio" value="2">
                                <label for="rating2">2</label>
                                <input id="rating1" type="radio" value="1">
                                <label for="rating1">1</label>
                            </span>
                            @elseif($review > '1')
                            <span class="starRating">
                                <input id="rating5" type="radio" value="5" >
                                <label for="rating5">5</label>
                                <input id="rating4" type="radio" value="4">
                                <label for="rating4">4</label>
                                <input id="rating3" type="radio" value="3">
                                <label for="rating3">3</label>
                                <input id="rating2" type="radio" value="2" checked>
                                <label for="rating2">2</label>
                                <input id="rating1" type="radio" value="1">
                                <label for="rating1">1</label>
                            </span>
                            @elseif($review > '0')
                            <span class="starRating">
                                <input id="rating5" type="radio" value="5" >
                                <label for="rating5">5</label>
                                <input id="rating4" type="radio" value="4">
                                <label for="rating4">4</label>
                                <input id="rating3" type="radio" value="3">
                                <label for="rating3">3</label>
                                <input id="rating2" type="radio" value="2">
                                <label for="rating2">2</label>
                                <input id="rating1" type="radio" value="1" checked>
                                <label for="rating1">1</label>
                            </span>
                            <p>{{ $review }} out of 5</p>
                            @else
                            <span class="starRating">
                                <input id="rating5" type="radio" value="5" >
                                <label for="rating5">5</label>
                                <input id="rating4" type="radio" value="4">
                                <label for="rating4">4</label>
                                <input id="rating3" type="radio" value="3">
                                <label for="rating3">3</label>
                                <input id="rating2" type="radio" value="2">
                                <label for="rating2">2</label>
                                <input id="rating1" type="radio" value="1">
                                <label for="rating1">1</label>
                            </span>
                            <p>0 out of 5</p>
                            @endif
                            <a target="_blank" href="{{ url('review/' . $dataList->product_track_id) }}">Add Your Review</a>
                        </div>
                        <h6 class="item_price">Tk-{{ $dataList->product_price - $dataList->product_discount_price }}</h6> 
                        <div class="btn_form">
                            <a href="{{ url('order/' . $dataList->product_track_id) }}" class="add-cart item_add">ADD TO CART</a>   
                        </div>
                        
                        <h5 class="btn btn-border btn-1">
                            <svg>
                            <!--<rect x="0" y="0" fill="none" width="100%" height="100%"/>
                            </svg>--><i class="fa fa-phone"></i> {{ $dataList->users_mobile }}</h5>     
                        <ul class="size">
                            <p><span>Product Country</span>  {{ $dataList->product_country }}</p>
                            <p><span>Product Brand</span>  {{ $dataList->brand_name }}</p>

                        </ul>
                        <ul class="color">
                            <p> <span>Total View</span> {{ $dataList->product_view }}</p>
                            <p> <span>Product Code</span>  {{ $dataList->product_no }}</p>
                        </ul>
                        <div class="clearfix"> </div>
                        @if(!empty($dataList->product_quantity))
                        <div class="quantity">
                            <!--<p class="qty"> Qty :  {{ $dataList->product_quantity }}</p>-->
                        </div>
                        @endif
                        
                    </div>
                    <div class="clearfix"> </div>
                </div>                

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Product Description
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                {!! $dataList->product_description !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Refund Policy
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                {!! $dataList->product_description !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Delivery
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                                {!! $dataList->product_description !!}
                            </div>
                        </div>
                    </div>
                </div>




            </div>
            <div class="container">

                <!--related-products-->
                <div class="related-products">
                    <div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
                        <h3 class="title">Related<span> Products</span></h3>
                    </div>
                    <div class="related-products-info">
                        @if(count($relatedList) > 0)
                        @foreach($relatedList as $related)
                        <div class="col-md-3 popular-item wow flipInY animated" data-wow-delay=".15s">
                            <div class="new-grid simpleCart_shelfItem">
                                <div class="new-top">
                                    @php
                                    $product_image = App\ProductImageModel::where('product_image_product_id', $related->product_track_id)->first();
                                    @endphp
                                    @if(!empty($product_image))
                                    <a href="{{ url('productDetails/' .$related->product_track_id ) }}"><img src="{{ asset('upload/frontend/product_image_file/' . $product_image->product_image_file) }}" class="img-responsive" alt="" /></a>
                                    @else
                                    <a href="{{ url('productDetails/' .$related->product_track_id ) }}"><img src="{{ asset('frontend/images/g11.jpg') }}" class="img-responsive" alt=""  /></a>
                                    @endif
                                    <div class="new-text">
                                        <ul>
                                            <li><a class="item_add" href=""> Add to cart</a></li>
                                            <!-- <li><a href="single.html">Quick View </a></li> -->
                                            <li><a href="{{ url('productDetails/' .$related->product_track_id ) }}">Show Details </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="new-bottom">
                                    <h5><a class="name" href="{{ url('productDetails/' .$related->product_track_id ) }}">{{ $related->product_title }}</a></h5>
                                    <div class="ofr">
                                        @if(!empty($related->product_discount_price))
                                        <p class="pric1"><del>${{ $related->product_price }}</del></p>
                                        @endif
                                        <p><span class="item_price">${{ $related->product_price - $related->product_discount_price }}</span></p>
                                        @if($related->product_review > '4')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                        </div>  
                                        @elseif($related->product_review > '3')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                        </div>  
                                        @elseif($related->product_review > '2')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>  
                                        @elseif($related->product_review > '1')
                                        <div class="rating">
                                            <span class="on">☆</span>
                                            <span class="on">☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                            <span>☆</span>
                                        </div>  
                                        @elseif($related->product_review > '0')
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
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <!--//related-products-->
            </div>
        </div>
        
        @include('frontend/layouts/footer')
        <!--//single-page-->
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
        <script src="{{ asset('frontend/js/uisearch.js') }}">
        </script>
        <script>
            new UISearch(document.getElementById('sb-search'));
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".shareIcons .social-icon").click(function () {
                    var shareUrl = $.trim($(this).attr("data-url")).replace(/(\r\n|\n|\r)/gm, "");
                    window.open(shareUrl, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
                });
            });
        </script>
    </body>
</html>