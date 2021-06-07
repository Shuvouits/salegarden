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
    </head>

    <body>
        <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
        <!--===============================================================================-->
        <!--header-->
        @include('frontend/layouts/menuBar')
        <div class="container">
            <div class="row">
               <div class="row">
                   <div class="col-md-8 col-md-offset-2">
                       <div class="final-confirm-main">
                           <div class="final-confirm-item">
                               <div class="register-buy-header">
                                <h2>Order Confirmation</h2>
                            </div>
                               <h1>Your Payable Amount: <span>Tk. {{ $order->orderDetails()->sum('amount') }}</span></h1>
                               <h2>Payment Method : Cash on Delivery</h2>
                               <h4>How to Pay</h4>
                               <ul>
                                   <li>Click on "Confirm Order".</li>
                                    <li>You will get the parcel of happiness within 2-3 working days(in Dhaka).</li>   
                                    <li>After receiving the parcel, pay to the delivery man.</li>
                               </ul>
                               <a href="{{ url('orderDetails/' . $order->order_track_id) }}" class="back-btn">Back</a>
                               <a href="{{ url('orderConfirm/' . $order->order_track_id) }}" class="confirm-btn">Confirm order</a>
                            </div>
                       </div>
                   </div>
               </div> 
            </div>
        </div>
    
        @include('frontend/layouts/footer')
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
        <script>
new UISearch(document.getElementById('sb-search'));
        </script>
    </body>

</html>