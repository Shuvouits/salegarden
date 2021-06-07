@extends('backend/layouts/index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-style">Image List 
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                @if (session('success'))
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{ session('success') }}</strong>
                                </div>
                                @endif
                                @if (session('error'))
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{ session('error') }}</strong>
                                </div>
                                @endif
                            </div>
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="item">
                                        <div class="row">
                                            @if(!empty($dataList))
                                            @foreach($dataList AS $data)
                                            <div class="col-xs-3" style="padding: 10px;">
                                                <img style="height: 200px;width: 100%" src="{{ asset('upload/frontend/product_image_file/'.$data->product_image_file ) }}" class="img-responsive"><br>
                                                <a href="{{ URL::to('portal/product/editImage/'.$data->product_image_id) }}">
                                                    <button class="btn btn-default btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</button>
                                                </a>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#deleteRow{{ $data->product_image_id }}"><button class="btn btn-default btn-sm">Delete</button></a>
                                                <div id="deleteRow{{ $data->product_image_id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ URL::to('portal/product/deleteImage') }}">
                                                                {{ csrf_field() }}
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h5 class="modal-title" style="color: red;">Are you sure you want to delete?</h5>
                                                                    <input type="hidden" id="product_image_id" name="product_image_id" value="{{ $data->product_image_id }}" />
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" id="btnDelete" name="btnDelete" class="btn btn-danger center-block"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach  
                                            @else
                                            No Image submitted Yet
                                            @endif   
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ URL::to('portal/product/addImage/' . $product_image_product_id) }}" style="float:right">
                                    <button class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('backend/layouts/footerScript')
@if(Auth::user()->users_type === 'Company')
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu8").addClass("active");
        $("#menu8").parent().parent().addClass("treeview active");
        $("#menu8").parent().addClass("in");
    });
</script>
@else
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu10").addClass("active");
        $("#menu10").parent().parent().addClass("treeview active");
        $("#menu10").parent().addClass("in");
    });
</script>
@endif
@stop