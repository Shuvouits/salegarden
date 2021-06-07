@extends('backend/layouts/index')
@section('content')
<style type="text/css">
    .appendElement {
        margin-top: 15px;
    }
    .deleteAttachment {
        margin-top: 22px;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">Update Product
                        </div>
                        <div class="clearfix"></div>
                        <form id="target" method="POST" enctype="multipart/form-data" action="{{ URL::to('portal/product/userUpdate') }}">
                            {{ csrf_field() }}
                            <input type="hidden" id="product_track_id" name="product_track_id" value="{{ $dataList->product_track_id }}">
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        @if (session('errorArray'))
                                        <div class="alert alert-danger">
                                            @foreach($errors->all() AS $key => $value)
                                            <strong><i class="fa fa-warning"></i> {{ $value }}</strong><br>
                                            @endforeach
                                        </div>
                                        @endif
                                        @if (session('error'))
                                        <div class="alert alert-danger"  id="error">
                                            <strong><i class="fa fa-warning"></i> {{ session('error') }}</strong>
                                        </div>
                                        @endif
                                        @if (session('success'))
                                        <div class="alert alert-success"  id="success">
                                            <strong><i class="fa fa-check"></i> {{ session('success') }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="panel panel-success" id="applicationHealthInf">
                                    <div class="panel-heading ucasSubPanelHeading" style="text-align: center;">Add New Product</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="product_category_id">Category&nbsp;<span id="mark">*</span></label>
                                                        <select onchange="javascript:getSubCategory(this.value);" class="form-control" name="product_category_id" id="product_category_id" >
                                                            <option value="">--</option>
                                                            @foreach($categoryList AS $category)
                                                            <option value="{{ $category->category_track_id }}"@if($category->category_track_id == $dataList->product_category_id) selected="selected" @endif>{{ $category->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_sub_category_id">Sub Category&nbsp;<span id="mark">*</span></label>
                                                        <span id="subCategoryDiv">
                                                            <select class="form-control" id="product_sub_category_id" name="product_sub_category_id">
                                                                <option value="">--</option>
                                                                @foreach($subCategoryList as $subCategory)
                                                                <option value="{{ $subCategory->sub_category_track_id }}"@if($subCategory->sub_category_track_id == $dataList->product_sub_category_id) selected="selected" @endif>{{ $subCategory->sub_category_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_brand_id">Brand&nbsp;<span id="mark">*</span></label>
                                                        <select class="form-control" name="product_brand_id" id="product_brand_id" >
                                                            <option value="">--</option>
                                                            @foreach($brandList AS $brand)
                                                            <option value="{{ $brand->brand_track_id }}"@if($brand->brand_track_id == $dataList->product_brand_id) selected="selected" @endif>{{ $brand->brand_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_country">Product Country&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="product_country" name="product_country" value="{{ $dataList->product_country }}" class="form-control"  />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_title">Product Title&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="product_title" name="product_title" value="{{ $dataList->product_title }}" class="form-control"  />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_price">Price</label>
                                                        <input type="number" id="product_price" name="product_price" value="{{ $dataList->product_price }}" min="0" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_discount">Discount</label>
                                                        <select class="form-control" id="product_discount" name="product_discount">
                                                            <option value="No"@if("No" == $dataList->product_discount) selected="selected" @endif>No</option>
                                                            <option value="Yes"@if("Yes" == $dataList->product_discount) selected="selected" @endif>Yes</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_discount_price">Discount Price</label>
                                                        <input type="text" id="product_discount_price" name="product_discount_price" value="{{ $dataList->product_discount_price }}" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_negotiable">Negotiable</label>
                                                        <select class="form-control" id="product_negotiable" name="product_negotiable">
                                                            <option value="Not Negotiable"@if("Not Negotiable" == $dataList->product_negotiable) selected="selected" @endif>Not Negotiable</option>
                                                            <option value="Negotiable"@if("Negotiable" == $dataList->product_negotiable) selected="selected" @endif>Negotiable</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_mobile">Would you like to show your Mobile No</label>
                                                        <select class="form-control" id="product_mobile" name="product_mobile">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_description">Description</label>
                                                        <textarea class="textarea" name="product_description" id="product_description" style="width: 100%; height: 200px; font-size: 14px; line-height: 15px; border: 1px solid #dddddd; padding: 10px;">{!! $dataList->product_description !!}</textarea>                                           
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" return='false' id="btnSubmit" name="btnSubmit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;Update</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('backend/layouts/footerScript')
<script type="text/javascript">
    $("#menu10").addClass("active");
    $("#menu10").parent().parent().addClass("treeview active");
    $("#menu10").parent().addClass("in");
</script>
<script type="text/javascript">
    $(document).on("keypress", "form", function (event) {
        return event.keyCode != 13;
    });
</script>
@stop