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
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default" style="margin-top:20px">
                        <div class="panel-heading" style="font-size: 20px;text-align: center;">Contact us</div>
                        @if (session('errorArray'))
                        <div class="alert alert-danger">
                            @foreach($errors->all() AS $key => $value)
                            <strong><i class="fa fa-warning"></i> {{ $value }}</strong><br>
                            @endforeach
                        </div>
                        @endif
                        <div class="panel-body" style="background: #428bca; color: white">
                            <form method="POST" class="form-horizontal" action="{{ url('contactStore') }}">
                                {{ csrf_field() }}
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
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Your Name</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="contact_name" id="contact_name" value="{{ old('contact_name') }}" style="width :100%; color:black">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="contact_email" id="contact_email" value="{{ old('contact_email') }}" style="width :100%; color:black">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Your Phone No</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone') }}" style="width :100%; color:black">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Subject</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="contact_subject" id="contact_subject" value="{{ old('contact_subject') }}" style="width :100%; color:black">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Message</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" name="contact_message" id="contact_message" style="width :100%; height: 100px; color:black">{{ old('contact_message') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
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
    </body>

</html>