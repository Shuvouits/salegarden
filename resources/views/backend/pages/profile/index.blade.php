@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">        
        <div class="col">
            <div class="row">
                <div class="col-md-12">
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
                    <div class="panel-group">
                        <div class="panel panel-primary">
                            <div class="panel-heading panel-style">Profile Of {{ $dataList->users_name }}</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="well well-sm">
                                            <div class="row">
                                                <div class="col-md-3 text-center">
                                                    <img src="{{ isset($dataList->users_image) ? URL::to('upload/frontend/users_image/'.$dataList->users_image) : URL::to('backend/images/default.png') }}" class="avatar img-thumbnail" alt="avatar">
                                                </div>
                                                <div class="col-md-9">
                                                    <table style="width: 100%" class="table table-responsive">
                                                        <tr>
                                                            <th style="width: 50%;">Name</th>
                                                            <td style="width: 50%;">{{ $dataList->users_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 50%;">Username</th>
                                                            <td style="width: 50%;">{{ $dataList->users_username }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 50%;">Email</th>
                                                            <td style="width: 50%;">{{ $dataList->users_email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 50%;">Mobile No</th>
                                                            <td style="width: 50%;">{{ $dataList->users_mobile }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="{{ URL::to('portal/profile/edit') }}" class='btn btn-sm btn-success pull-left changeProfile'> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Change Profile</a>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="{{ URL::to('portal/profile/passwordEdit') }}" class='btn btn-sm btn-success pull-right changePassword'> <i class="fa fa-lock" aria-hidden="true"></i> Change Password</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    $("#menu2").addClass("active");
    $("#menu2").parent().parent().addClass("treeview active");
    $("#menu2").parent().addClass("in");
</script>
@stop