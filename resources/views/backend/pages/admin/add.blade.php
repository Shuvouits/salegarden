@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">Add new admin</div>
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
                                    <form method="POST" action="{{ url('portal/admin/store') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="users_type">Type&nbsp;<span id="mark">*</span></label>
                                            <select class="form-control" id="users_type" name="users_type" >
                                                <option value="">--</option>
                                                <option value="Super Admin"@if('Super Admin' == old('users_type')) selected="selected" @endif>Super Admin</option>
                                                <option value="Admin"@if('Admin' == old('users_type')) selected="selected" @endif>Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="users_name">Name&nbsp;<span id="mark">*</span></label>
                                            <input type="text" class="form-control" id="users_name" name="users_name" value="{{ old('users_name') }}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="users_username">Username&nbsp;<span id="mark">*</span></label>
                                            <input type="text" class="form-control" id="users_username" name="users_username" value="{{ old('users_username') }}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="users_email">Email&nbsp;<span id="mark">*</span></label>
                                            <input type="text" class="form-control" id="users_email" name="users_email" value="{{ old('users_email') }}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="users_mobile">Mobile No&nbsp;<span id="mark">*</span></label>
                                            <input type="text" class="form-control" maxlength="11" id="users_mobile" name="users_mobile" value="{{ old('users_mobile') }}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password&nbsp;<span id="mark">*</span></label>
                                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="re_password">Retype Password&nbsp;<span id="mark">*</span></label>
                                            <input type="password" class="form-control" id="re_password" name="re_password" value="{{ old('re_password') }}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="users_status">Status&nbsp;<span id="mark">*</span></label>
                                            <select class="form-control" id="users_status" name="users_status" >
                                                <option value="">--</option>
                                                <option value="Active"@if('Active' == old('users_status')) selected="selected" @endif>Active</option>
                                                <option value="Inactive"@if('Inactive' == old('users_status')) selected="selected" @endif>Inactive</option>
                                            </select>
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