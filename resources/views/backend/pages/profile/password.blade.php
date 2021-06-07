@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">        
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style"> Change Password</div>
                        <div class="panel-body">                        
                            <div class="col-md-6">
                                @if (session('errorArray'))
                                <div class="alert alert-danger" id="error">
                                    @foreach($errors->all() AS $key => $value)
                                    <strong><i class="fa fa-warning"></i> {{ $value }}</strong><br>
                                    @endforeach
                                </div>
                                @endif
                                @if (session('success'))
                                <div class="alert alert-success" id="success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{ session('success') }}</strong>
                                </div>
                                @endif
                                @if (session('error'))
                                <div class="alert alert-danger" id="error">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{ session('error') }}</strong>
                                </div>
                                @endif
                                <form method="POST" action="{{ url('portal/profile/passwordUpdate') }}" >
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="old_password">Old Password&nbsp;<span id="mark">*</span></label>
                                        <input type="password" id="old_password" value="{{ old('old_password') }}" name="old_password" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New Password&nbsp;<span id="mark">*</span></label>
                                        <input type="password" id="password" name="password" value="{{ old('password') }}" class="form-control"  />
                                    </div>

                                    <div class="form-group">
                                        <label for="re_password">Retype Password&nbsp;<span id="mark">*</span></label>
                                        <input type="password" id="re_password" name="re_password" value="{{ old('re_password') }}" class="form-control"  />
                                    </div>

                                    <button type="submit" return="false" name="btnSaveClass" class="btn btn-primary pull-left editSubmitButton"><i class="fa fa-edit"></i> Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@include('backend/layouts/footerScript')
<script type="text/javascript">
    $("#menu2").addClass("active");
    $("#menu2").parent().parent().addClass("treeview active");
    $("#menu2").parent().addClass("in");
</script>
@stop