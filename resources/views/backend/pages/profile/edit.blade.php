@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">        
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style"> Update Profile</div>
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
                                <!--route for showing edit form of profile-->
                                <form method="POST" action="{{ url('portal/profile/update') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="users_name">Name&nbsp;<span id="mark">*</span></label>
                                        <input type="text" id="users_name" name="users_name" value="{{ $dataList->users_name }}" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="users_username">Username&nbsp;<span id="mark">*</span></label>
                                        <input type="text" id="users_username" name="users_username" value="{{ $dataList->users_username }}" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="users_email">Email</label>
                                        <input type="email" id="users_email" name="users_email" value="{{ $dataList->users_email }}" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="users_mobile">Mobile No&nbsp;<span id="mark">*</span></label>
                                        <input type="text" id="users_mobile" name="users_mobile" value="{{ $dataList->users_mobile }}" maxlength="11" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="users_image">Image&nbsp;<small style="color: red"><i>[.jpg, .png, .jpeg image allowed]</i></small></label>
                                        <input class="form-control" type="file" id="users_image" name="users_image" />                                             
                                    </div>
                                    <div class="form-group">
                                        @if($dataList->users_image != '')
                                        <img id="users_image" style="height: 100px;width: 100px;margin-top: 15px;" class="thumbnail img-responsive" src="{{ asset('upload/frontend/users_image/'. $dataList->users_image ) }}"/>
                                        @else
                                        <span class="label label-danger">No image submitted</span><br>
                                        @endif
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