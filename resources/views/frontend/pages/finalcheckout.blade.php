<!doctype html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>SaleGarden</title>
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
        <style type="text/css">
            form {
                width: 300px;
                margin: 0 auto;
                text-align: center;
            }

            .value-button {
                display: inline-block;
                border: 1px solid #ddd;
                margin: 0px;
                width: 40px;
                height: 20px;
                text-align: center;
                vertical-align: middle;
                padding: 11px 0;
                background: #eee;
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .value-button:hover {
                cursor: pointer;
            }
        </style>
    </head>


    <body>
        <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
        <!--===============================================================================-->
        <!--header-->
        @include('frontend/layouts/menuBar')
        <!--//header-->

        <div class="cart-items">
            <div class="container">
                @if($order)
                <h3 class="wow fadeInUp animated" data-wow-delay=".5s">My Shopping Cart({{ $order->orderDetails()->count('order_id') }})</h3>
                @else
                <h3 class="wow fadeInUp animated" data-wow-delay=".5s">My Shopping Cart(0)</h3>
                @endif
                @if($order)
                @foreach($order->orderDetails as $orderDetail)
                <div class="cart-header wow fadeInUp animated" data-wow-delay=".5s">
                    <div class="alert-close"> </div>
                    <div class="cart-sec simpleCart_shelfItem">
                        <div class="cart-item cyc">
                            @php
                            $product_image = App\ProductImageModel::where('product_image_product_id', $orderDetail->product_id)->first();
                            @endphp
                            @if(!empty($product_image))
                            <a href="#"><img src="{{ asset('upload/frontend/product_image_file/' . $product_image->product_image_file) }}" class="img-responsive" alt=""></a>
                            @else
                            <a href="#"><img src="{{ asset('frontend/images/g11.jpg') }}" class="img-responsive" alt=""></a>
                            @endif
                        </div>
                        <div class="cart-item-info">
                            <h4><a href="#"> {{ $orderDetail->product->product_title }} </a><span>Pickup time :</span></h4>
                            <ul class="qty">
                                <li><p>Min. order value :</p></li>
                                <li><p>delivery</p></li>
                            </ul>
                            <div class="delivery">
                                <div class="col-md-6">
                                    <p>Product Charges : ${{ $orderDetail->amount }}</p>
                                </div>
                                <div class="col-md-4">
                                    <form method="POST" action="{{ url('checkoutStore') }}" id="checkout">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $orderDetail->id }}">
                                        <select class="form-control" onchange="document.getElementById('checkout').submit();" name="quantity" id="quantity">
                                                                    <option value="">Select item No</option>
                                                                    @for($i=1; $i<=10; $i++)
                                                                    <option value="{{ $i }}"@if($i == $orderDetail->quantity) selected="selected" @endif>{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                    </form>
                                </div>
                                <div class="col-md-1"> </div>
                                <div class="col-md-1"> 
<a href="#" title="Delete"
                                       onclick="if (confirm(&quot;Are you sure you want to remove ?&quot;)) { document.getElementById('deleteForm{{ $orderDetail->id }}').submit(); } event.returnValue = false; return false;">
                                        <img class="remove-icon" src="{{ asset('frontend/images/remove.png') }}" alt="">
                                    </a>
<form method="POST" action="{{ URL('orderDestroy') }}" id="deleteForm{{ $orderDetail->id }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="order_detail_id" value="{{ $orderDetail->id }}">
                                        </form> 
                                </div>
                                <div class="clearfix"></div>
                            </div>	
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <script type="text/javascript" src="{{ asset('frontend/js/customScript.js') }}">
        </script>
        <script>
            new UISearch(document.getElementById('sb-search'));
        </script>
    </body>

</html>