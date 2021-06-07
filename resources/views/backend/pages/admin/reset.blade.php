@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">Reset Password</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if (session('errorArray'))
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() AS $key => $value)
                                        <strong><i class="fa fa-warning"></i> {{ $value }}</strong><br>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if (session('error'))
                                    <div class="alert alert-danger"  id="error">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>{{ session('error') }}</strong>
                                    </div>
                                    @endif

                                    @if (session('success'))
		                            <div class="alert alert-success"  id="success">
		                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                                <strong>{{ session('success') }}</strong>
		                            </div>
		                            @endif
                                    <form method="POST" action="{{ url('portal/admin/resetstore') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="users_track_id" id="users_track_id" value="{{ $dataList->users_track_id }}" />
                                        <div class="form-group">
                                            <label for="name">Name&nbsp;<span id="mark">*</span></label>
                                            <input type="text" class="form-control" id="users_name"value= "{{ $dataList->users_name }}" disabled="disabled">
                                        </div>

                                        <div class="form-group">
                                            <label for="password">New Password&nbsp;<span id="mark">*</span></label>
                                            <input type="password" class="form-control" id="password" name="password" value="" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password&nbsp;<span id="mark">*</span></label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;Submit</button>
                                    </form>
                                </div>
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
    $("#menu3").addClass("active");
    $("#menu3").parent().parent().addClass("treeview active");
    $("#menu3").parent().addClass("in");
</script>
@stop