@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">Update New Second Category</div>
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
                                    <form method="POST" action="{{ url('portal/secondCategory/update') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="second_category_track_id" id="second_category_track_id" value="{{ $dataList->second_category_track_id }}" />
                                        <div class="form-group">
                                            <label for="second_category_category_id">Category&nbsp;<span id="mark">*</span></label>
                                            <select class="form-control" id="second_category_category_id" name="second_category_category_id" required>
                                                <option value=""> -- </option>
                                                @if(!empty($categoryList))
                                                @foreach($categoryList AS $category)
                                                <option value="{{ $category->category_track_id }}"@if($category->category_track_id == $dataList->second_category_category_id ) selected="selected" @endif> {{ $category->category_name }} </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="second_category_sub_id">Sub Category&nbsp;<span id="mark">*</span></label>
                                            <select class="form-control" id="second_category_sub_id" name="second_category_sub_id" required>
                                                <option value=""> -- </option>
                                                @if(!empty($subCategoryList))
                                                @foreach($subCategoryList AS $subCategory)
                                                <option value="{{ $subCategory->sub_category_track_id }}"@if($subCategory->sub_category_track_id == $dataList->second_category_sub_id) selected="selected" @endif> {{ $subCategory->sub_category_name }} </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="second_category_name">Name&nbsp;<span id="mark">*</span></label>
                                            <input type="text" class="form-control" id="second_category_name" name="second_category_name" value="{{ $dataList->second_category_name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="second_category_status">Status&nbsp;<span id="mark">*</span></label>
                                            <select class="form-control" id="second_category_status" name="second_category_status" required>
                                                <option value="">--</option>
                                                <option value="Active"@if('Active' == $dataList->second_category_status) selected="selected" @endif>Active</option>
                                                <option value="Inactive"@if('Inactive' == $dataList->second_category_status) selected="selected" @endif>Inactive</option>
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