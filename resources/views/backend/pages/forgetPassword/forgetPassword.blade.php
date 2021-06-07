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

                    <div class="panel-heading" style="font-size: 20px;text-align: center;">Forgot Your Password</div>
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

                        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable" style="text-align: left;">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <i class="fa fa-warning"></i> {{$error}}
            </div>
            @endforeach
            @endif
            @if(Session::has('status'))
            <div class="alert alert-success alert-dismissable" style="text-align: left;">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <i class="fa fa-check"></i> {{session('status')}}
            </div>
            @endif
                        <form class="form-horizontal" method="POST" action="{{ route('admin.password.email') }}">
                            {{ csrf_field() }}
                            <div style="margin-top: 30px">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="users_email" name="users_email" value="{{ old('users_email') }}" placeholder="Enter email" required="required">
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-success" style="background-color: #1E4770;border-color: #1E4770;">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>