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
                <div class="register-details-section">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="register-main">
                            <div class="register-buy-header">
                                <h2>Order Details</h2>
                            </div>
    
                            @if (session('errorArray'))
                            <div class="alert alert-danger">
                                @foreach($errors->all() AS $key => $value)
                                <strong><i class="fa fa-warning"></i> {{ $value }}</strong><br>
                                @endforeach
                            </div>
                            @endif
                            <form method="POST" class="form-horizontal" action="{{ url('orderDetailsStore') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="order_track_id" value="{{ $id }}">
                            <div class="register-buy-wrapper">
                                <div class="row">
                                    <div class="form-item">
                                        <div class="col-md-3">
                                            <label>Full Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="order_name" value="{{ Auth::user() ? Auth::user()->users_name : '' }}" placeholder="Write your name">
                                        </div>
                                    </div>
                                    <div class="form-item">
                                        <div class="col-md-3">
                                            <label>area</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="order_area">
    
                                              <option value="">Select Area</option>
                                            @foreach($areas as $area)
                                              <option value="{{ $area->area_track_id }}">{{ $area->area_name }}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-item">
                                        <div class="col-md-3">
                                            <label>Address</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea placeholder="write your address" name="order_address"></textarea>
                                        </div>
                                    </div> 
                                    <div class="form-item">
                                        <div class="col-md-3">
                                            <label>Mobile no</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="order_mobile" value="{{ Auth::user() ? Auth::user()->users_mobile : '' }}" placeholder="write your number">
                                        </div>
                                    </div>  
                                    <div class="form-item">
                                        <div class="col-md-3">
                                            <label>Payment Method</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="order_payment_type">
                                              <option value="COD">Cash on Delivery</option>
                                              <option value="COD">Bkash Payment</option>
                                            </select>
                                        </div>
                                    </div> 
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <button type="submit" class="btn btn-primary">
                                                Continue To Next
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
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