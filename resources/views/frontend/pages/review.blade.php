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
    </head>

    <body>
        <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
        <!--===============================================================================-->
        <!--header-->
        @include('frontend/layouts/menuBar')
        <!--//header-->
        <!--single-page-->
        <div class="single">
            <div class="container">
                <div class="single-info">  
                    <!--collapse-tabs-->
                    <div class="collpse tabs">
                        <div class="panel-group collpse">
                            <div class="panel panel-default wow fadeInUp animated" data-wow-delay=".5s">
                                <div class="panel-heading" >
                                    <h4 class="panel-title">
                                        <a role="button">
                                            Give Your Review To [ {{ $dataList->product_title }} ]
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--//collapse -->     
                    <div class="col-md-6 single-top wow fadeInLeft animated" data-wow-delay=".5s">  
                        <div class="flexslider">
                            <ul class="slides">
                            </ul>
                        </div>
                    </div>
                    @if (session('errorArray'))
                    <div class="alert alert-danger">
                        @foreach($errors->all() AS $key => $value)
                        <strong><i class="fa fa-warning"></i> {{ $value }}</strong><br>
                        @endforeach
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger"  id="error">
                        <strong><i class="fa fa-warning"></i> {{ session('error') }}</strong>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success"  id="success">
                        <strong><i class="fa fa-check"></i> {{ session('success') }}</strong>
                    </div>
                    @endif
                    <form method="POST" class="form-horizontal" action="{{ url('postReview') }}">
                        {{ csrf_field() }}
                        <input type="hidden" id="review_product_id" name="review_product_id" value="{{ $dataList->product_track_id }}">
                        <div class="col-md-6 single-top-left simpleCart_shelfItem wow fadeInRight animated" data-wow-delay=".5s">
                            <div class="single-rating">
                                <span class="starRating">
                                    <input id="rating5" type="radio" name="review_star" value="5" checked>
                                    <label for="rating5">5</label>
                                    <input id="rating4" type="radio" name="review_star" value="4">
                                    <label for="rating4">4</label>
                                    <input id="rating3" type="radio" name="review_star" value="3">
                                    <label for="rating3">3</label>
                                    <input id="rating2" type="radio" name="review_star" value="2">
                                    <label for="rating2">2</label>
                                    <input id="rating1" type="radio" name="review_star" value="1">
                                    <label for="rating1">1</label>
                                </span>
                            </div>

                            <div class="col-md-12">
                                <label>Give Yor review Details</label>
                                <textarea name="review_details" id="review_details" style="width :100%; height: 100px; color:black">{{ old('review_details') }}</textarea>
                            </div>


                            <div class="btn_form">
                                <button type="submit" class="btn btn-success center-block"><i class="fa fa-check"></i> SUBMIT</button>  
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"> </div>
                </div>

            </div>
            <div class="container-fluid">
            </div>
        </div>
        
        @include('frontend/layouts/footer')
        <!--//single-page-->
        <!--===============================================================================-->
        <!--=== All JS ===-->
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
    </body>

</html>