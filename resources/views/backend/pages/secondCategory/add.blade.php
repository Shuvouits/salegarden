@extends('backend/layouts/index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">Add New Second Sub Category</div>
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
                                    <form method="POST" action="{{ url('portal/secondCategory/store') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="second_category_category_id">Category&nbsp;<span id="mark">*</span></label>
                                            <select onchange="javascript:getSub(this.value);" class="form-control" id="second_category_category_id" name="second_category_category_id" required>
                                                <option value=""> -- </option>
                                                @if(!empty($categoryList))
                                                @foreach($categoryList AS $category)
                                                <option value="{{ $category->category_track_id }}"@if($category->category_track_id == old('second_category_category_id')) selected="selected" @endif> {{ $category->category_name }} </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="second_category_sub_id">Sub Category&nbsp;<span id="mark">*</span></label>
                                            <span id="subCategoryDiv">
                                                <select onchange="javascript:getSecondCategory(this.value);" class="form-control" id="second_category_sub_id" name="second_category_sub_id">
                                                    <option value="">--</option>
                                                </select>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label for="second_category_name">Name&nbsp;<span id="mark">*</span></label>
                                            <input type="text" class="form-control" id="second_category_name" name="second_category_name" value="{{ old('second_category_name') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="second_category_status">Status&nbsp;<span id="mark">*</span></label>
                                            <select class="form-control" id="second_category_status" name="second_category_status" required>
                                                <option value="">--</option>
                                                <option value="Active"@if('Active' == old('second_category_status')) selected="selected" @endif>Active</option>
                                                <option value="Inactive"@if('Inactive' == old('second_category_status')) selected="selected" @endif>Inactive</option>
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
    $("#menu6").addClass("active");
    $("#menu6").parent().parent().addClass("treeview active");
    $("#menu6").parent().addClass("in");
</script>
@stop