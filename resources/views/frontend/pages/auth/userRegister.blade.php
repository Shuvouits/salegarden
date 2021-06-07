<!doctype html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Tree plant</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="application/x-javascript"> 
            addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
            function hideURLbar(){ window.scrollTo(0,1); } 
        </script>
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
        @include('frontend/layouts/menuBar')

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default" style="margin-top:20px">

                        <div class="facebook-area">
                            <a href="{{ url('social/facebook') }}" target="blank" class="fb-link">sign up with facebook</a>
                            <h3>Or</h3>
                        </div>
                        <div class="panel-heading" style="font-size: 20px;text-align: center;">Register</div>
                        @if (session('errorArray'))
                        <div class="alert alert-danger">
                            @foreach($errors->all() AS $key => $value)
                            <strong><i class="fa fa-warning"></i> {{ $value }}</strong><br>
                            @endforeach
                        </div>
                        @endif
                        <div class="panel-body" style="background: #428bca; color: white">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/createUser') }}">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="users_name" class="col-md-4 control-label">Name</label>

                                    <div class="col-md-6">
                                        <input id="users_name" type="text" class="form-control" name="users_name" value="{{ old('users_name') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="users_email" class="col-md-4 control-label">E-Mail</label>

                                    <div class="col-md-6">
                                        <input id="users_email" type="email" class="form-control" name="users_email" value="{{ old('users_email') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="users_mobile" class="col-md-4 control-label">Mobile</label>

                                    <div class="col-md-6">
                                        <input id="users_mobile" maxlength="11" type="text" class="form-control" name="users_mobile" value="{{ old('users_mobile') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="users_type" class="col-md-4 control-label">User Type</label>

                                    <div class="col-md-6">
                                        <label class="radio-inline"><input type="radio" name="users_type" value="User" checked>Individual</label>
                                        <label class="radio-inline"><input type="radio" name="users_type" value="Company">Company</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="users_username" class="col-md-4 control-label">Username</label>

                                    <div class="col-md-6">
                                        <input id="users_username" type="text" class="form-control" name="users_username" value="{{ old('users_username') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="re_password" class="col-md-4 control-label">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="re_password" type="password" class="form-control" name="re_password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-user"></i> Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('frontend/layouts/footer')

        <!--===============================================================================-->
        <!--=== All JS ===-->
        <!--//Featured Products-->
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
        <script>
new UISearch(document.getElementById('sb-search'));
        </script>
    </body>

</html>