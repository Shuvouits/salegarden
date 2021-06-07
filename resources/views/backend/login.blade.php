<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ecommerce| Login Panel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('backend/css/bootstrapMin.css') }}" />
        <script src="{{ asset('backend/js/jquery.js') }}"></script>
        <script src="{{ asset('backend/js/bootstrapMin.js') }}"></script>
        <style>
            label{
                color: white;
                font-size: 13px;
                padding-top: 1px !important;
                font-weight: 900;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="col-md-6 col-md-offset-3" style="margin-top: 25vh;">
                <div class="panel panel-default">

                    <div class="panel-heading" style="font-size: 20px;text-align: center;">Tree Plant | Login</div>
                    <div class="panel-body" style="background: #428bca; color: white">
                        @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{!!Session::get('error') !!}</strong>
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success"  id="success">
                            <strong><i class="fa fa-check"></i> {{ session('success') }}</strong>
                        </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ URL::to('/login') }}">
                            {{ csrf_field() }}
                            <div style="margin-top: 30px">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">Mobile No</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Enter email" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="password">Password</label>
                                    <div class="col-sm-9"> 
                                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Enter password" required="required">
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-success" style="background-color: #1E4770;border-color: #1E4770;">Login</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('password.forget') }}">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
