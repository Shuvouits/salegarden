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
                        <div class="panel-heading panel-style">Add New Product
                        </div>
                        <div class="clearfix"></div>
                        <form method="POST" enctype="multipart/form-data" action="{{ URL::to('portal/product/companyStore') }}">
                            {{ csrf_field() }}
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
                                                        
                                                        <select class="form-control" name="product_category_id" id="product_category_id" >
                                                            <option value="">--</option>
                                                            @foreach($categoryList AS $category)
                                                            <option value="{{ $category->category_track_id }}"@if($category->category_track_id == old('product_category_id')) selected="selected" @endif>{{ $category->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_sub_category_id">Sub Category&nbsp;<span id="mark">*</span></label>
                                                        
                                                            <select class="form-control"  name="product_sub_category_id">
                                                                <option value="">--</option>
                                                                
                                                                @foreach($subCategoryList as $item)
                                                                
                                                                   <option value="{{$item->sub_category_track_id}}">{{$item->sub_category_name}}</option>
                                                                @endforeach
                                                               
                                                            </select>
                                                        
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_brand_id">Brand&nbsp;<span id="mark">*</span></label>
                                                        <select class="form-control" name="product_brand_id" id="product_brand_id" >
                                                            <option value="">--</option>
                                                            @foreach($brandList AS $brand)
                                                            <option value="{{ $brand->brand_track_id }}"@if($brand->brand_track_id == old('product_brand_id')) selected="selected" @endif>{{ $brand->brand_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_country">Product Country&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="product_country" name="product_country" value="{{ old('product_country') }}" class="form-control"  />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_title">Product Title&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="product_title" name="product_title" value="{{ old('product_title') }}" class="form-control" ="" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_price">Price</label>
                                                        <input type="number" id="product_price" name="product_price" value="{{ old('product_price') }}" min="0" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_discount">Discount</label>
                                                        <select class="form-control" id="product_discount" name="product_discount">
                                                            <option value="No">No</option>
                                                            <option value="Yes">Yes</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_discount_price">Discount Price</label>
                                                        <input type="text" id="product_discount_price" name="product_discount_price" value="{{ old('product_discount_price') }}" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_negotiable">Negotiable</label>
                                                        <select class="form-control" id="product_negotiable" name="product_negotiable">
                                                            <option value="Not Negotiable">Not Negotiable</option>
                                                            <option value="Negotiable">Negotiable</option>
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
                                                        <textarea class="textarea" name="product_description" id="product_description" style="width: 100%; height: 200px; font-size: 14px; line-height: 15px; border: 1px solid #dddddd; padding: 10px;">{!! old('product_description') !!}</textarea>                                           
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-heading ucasSubPanelHeading" style="text-align: center;"></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="product_image_file" class="col-md-3 control-label">Product Image</label>
                                            <div class="col-md-7">
                                                <input id="product_image_file" type="file" class="form-control" name="product_image_file[]" value="">
                                            </div>
                                            <div class="col-md-1 text-center addButtonWrap">
                                                <button type="button" class="label label-success pictureAttachment">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" return='false' id="btnSubmit" name="btnSubmit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;Submit</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="pictureAttachElement hide">
                    <div class="col-md-7 col-md-offset-3 appendElement">
                        <input id="product_image_file" type="file" class="form-control" name="product_image_file[]" value="">
                    </div>
                    <div class="col-md-1 text-center deleteButtonWrap">
                        <button type="button" class="label label-danger deleteAttachment">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('backend/layouts/footerScript')
<script type="text/javascript">
    $("#menu7").addClass("active");
    $("#menu7").parent().parent().addClass("treeview active");
    $("#menu7").parent().addClass("in");
</script>
<script type="text/javascript">
    $(document).on("keypress", "form", function (event) {
        return event.keyCode != 13;
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".pictureAttachment").on("click", function () {
            var attachInput = $(this).parents(".addButtonWrap").siblings("div").find("input");
            if ($(this).hasClass("localAuthorityAttach")) {
                var appendHtml = $(".localAuthorityAttachElement").html();
            } else {
                appendHtml = $(".pictureAttachElement").html();
            }
            if (attachInput.val() == '') {
                attachInput.addClass("errorInput");
            } else {
                var appendElement = $(this).parents(".addButtonWrap").siblings(".appendElement:last");
                if (appendElement.length === 0) {
                    attachInput.removeClass('errorInput');
                    $(this).parents(".addButtonWrap").before(appendHtml);
                    $(this).parents(".addButtonWrap").css("margin-top", "15px");
                } else {
                    if (appendElement.find("input").val() == '') {
                        appendElement.find("input").addClass("errorInput");
                    } else {
                        appendElement.find("input").removeClass("errorInput");
                        appendElement.siblings(".addButtonWrap").before(appendHtml);
                        appendElement.siblings(".addButtonWrap").css("margin-top", "15px");
                    }
                }

            }
        });
        $("#applicationHealthInf").on("click", ".deleteAttachment", function () {
            var appendElement = $(this).parents(".deleteButtonWrap").siblings(".appendElement").length;
            $(this).parents(".deleteButtonWrap").prev(".appendElement").remove();
            $(this).parents(".deleteButtonWrap").remove();
            if (appendElement === 1) {
                $(".pictureAttachment").parents(".addButtonWrap").css("margin-top", "0px");
            }
        });
    });
</script>
@stop