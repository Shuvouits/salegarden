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
                            <form method="POST" action="{{ url('portal/profile/companyUpdate') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="users_name">Company Name&nbsp;<span id="mark">*</span></label>
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
                                    <div class="form-group">
                                        <label for="company_info_description">About Company</label>
                                        <textarea class="textarea" name="company_info_description" id="company_info_description" style="width: 100%; height: 200px; font-size: 14px; line-height: 15px; border: 1px solid #dddddd; padding: 10px;"></textarea>                                           
                                    </div>                              
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_info_website">Company Website&nbsp;<span id="mark">*</span></label>
                                        <input type="text" id="company_info_website" name="company_info_website" value="{{ $companyInfo->company_info_website }}" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="company_info_phone">Phone No&nbsp;<span id="mark">*</span></label>
                                        <input type="text" id="company_info_phone" name="company_info_phone" value="{{ $companyInfo->company_info_phone }}" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="company_info_contact_person">Contact Person</label>
                                        <input type="email" id="company_info_contact_person" name="company_info_contact_person" value="{{ $companyInfo->company_info_contact_person }}" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="company_info_contact_person_mobile">Contact Person Mobile No&nbsp;<span id="mark">*</span></label>
                                        <input type="text" id="company_info_contact_person_mobile" name="company_info_contact_person_mobile" value="{{ $companyInfo->company_info_contact_person_mobile }}" maxlength="11" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="company_info_contact_person_position">Contact Person Position&nbsp;<span id="mark">*</span></label>
                                        <input type="text" id="company_info_contact_person_position" name="company_info_contact_person_position" value="{{ $companyInfo->company_info_contact_person_position }}" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="company_info_contact_person_position">Contact Person Email&nbsp;<span id="mark">*</span></label>
                                        <input type="text" id="company_info_contact_person_position" name="company_info_contact_person_position" value="{{ $companyInfo->company_info_contact_person_position }}" maxlength="11" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="company_info_logo">Company Logo&nbsp;<small style="color: red"><i>[.jpg, .png, .jpeg image allowed]</i></small></label>
                                        <input class="form-control" type="file" id="company_info_logo" name="company_info_logo" />                                             
                                    </div>
                                    <div class="form-group">
                                        @if($companyInfo->company_info_logo != '')
                                        <img id="company_info_logo" style="height: 100px;width: 100px;margin-top: 15px;" class="thumbnail img-responsive" src="{{ asset('upload/frontend/company_info_logo/'. $companyInfo->company_info_logo ) }}"/>
                                        @else
                                        <span class="label label-danger">No image submitted</span><br>
                                        @endif
                                    </div>

                                    <button type="submit" return="false" name="btnSaveClass" class="btn btn-primary pull-left editSubmitButton"><i class="fa fa-edit"></i> Update</button>

                                </div>
                            </form>
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